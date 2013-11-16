//------------------ WebGL renderer for use with THREE.js and the Occulus Rift -------------------\\

// Hardware configuration for the Oculus Rift Kickstarter dev kit. This is from the SDK docs.
// TF2 IPD = 67.5mm, 504px
var HMDInfo_DevKit = {
  HScreenSize: .14976,
  VScreenSize: .0935,
  VScreenCenter: .0935 / 2,
  EyeToScreenDistance: .041,
  LensSeperationDistance: .067,
  InterpupillaryDistance: .0675,
  HResolution: 1280,
  VResolution: 800,
  Distortion: [1, .22, .24, 0]
};

function RiftCamera (hmd, pixelScale, flipEyes) {
THREE.Camera.call(this);
// define shaders
var VERTEX_SHADER = "\
varying vec2 vUv;\
\
void main(void){\
  gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);\
  vUv=uv;\
}";

// From the 5.5:Rendering Configuration section of the Oculus_SDK_Overview.pdf
var FRAGMENT_SHADER = "\
varying vec2 vUv;\
uniform sampler2D tex;\
\
uniform vec2 lensCenter;\
uniform vec2 screenCenter;\
uniform vec2 scale;\
uniform vec2 scaleIn;\
uniform vec4 hmdWarpParam;\
\
vec2 warp(vec2 uv) {\
  vec2 theta = (uv - lensCenter - .5) * scaleIn;\
  float rSq = theta.x * theta.x + theta.y * theta.y;\
  vec2 rVector = theta * (hmdWarpParam.x + hmdWarpParam.y * rSq + hmdWarpParam.z * rSq * rSq +\
      hmdWarpParam.w * rSq * rSq * rSq);\
  return .5 + rVector * scale;\
}\
\
void main() {\
  vec2 uv = warp(vUv);\
  if (uv.x < 0.0 || uv.x > 1.0 || uv.y < 0.0 || uv.y > 1.0) {\
    gl_FragColor = vec4(1.0, 0.0, 0.0, 1.0);\
  } else {\
    gl_FragColor = texture2D(tex, uv);\
  }\
}";

// define hardcoded values
var DISPLAY_WIDTH = hmd.HResolution / 2;
var DISPLAY_HEIGHT = hmd.VResolution;
var SCENE_FOV = 360 * Math.atan(.5 * hmd.VScreenSize / hmd.EyeToScreenDistance) / Math.PI;

// initialize the "display" which is the pair of quads that show the rendered scene
var displayCamera = new THREE.OrthographicCamera(
    -DISPLAY_WIDTH, DISPLAY_WIDTH, DISPLAY_HEIGHT / 2, -DISPLAY_HEIGHT / 2, -10000, 10000);
displayCamera.position.z = 100;

// these are the render targets for each eye
var leftTex = new THREE.WebGLRenderTarget(pixelScale * DISPLAY_WIDTH, pixelScale * DISPLAY_HEIGHT,
    {minFilter: THREE.LinearFilter, magFilter: THREE.LinearFilter, format: THREE.RGBAFormat});
var rightTex = new THREE.WebGLRenderTarget(pixelScale * DISPLAY_WIDTH, pixelScale * DISPLAY_HEIGHT,
    {minFilter: THREE.LinearFilter, magFilter: THREE.LinearFilter, format: THREE.RGBAFormat});

// Warp configuration
var lensCenterOffset =
    4 * (.25 * hmd.HScreenSize - .5 * hmd.LensSeperationDistance) / hmd.HScreenSize;
var leftLensCenter = new THREE.Vector2(lensCenterOffset, 0);
var rightLensCenter = new THREE.Vector2(-lensCenterOffset, 0);
var screenCenter = new THREE.Vector2(.5, .5);
var scale = 2;
var scale2 = 1/1.6;
var ar = DISPLAY_WIDTH / DISPLAY_HEIGHT;
var scaleIn = new THREE.Vector2(scale, scale);
var scale = new THREE.Vector2(scale2 / scale, scale2 / scale);
var hmdWarpParam = new THREE.Vector4(
        hmd.Distortion[0], hmd.Distortion[1], hmd.Distortion[2], hmd.Distortion[3]);

// Create the quads for each eye
var leftQuad = new THREE.Mesh(
    new THREE.PlaneGeometry(DISPLAY_WIDTH, DISPLAY_HEIGHT),
    new THREE.ShaderMaterial({
        uniforms: {
            tex: {type: "t", value: leftTex},
            lensCenter: {type: "v2", value: leftLensCenter},
            screenCenter: {type: "v2", value: screenCenter},
            scale: {type: "v2", value: scale},
            scaleIn: {type: "v2", value: scaleIn},
            hmdWarpParam: {type: "v4", value: hmdWarpParam},
        },
        vertexShader: VERTEX_SHADER,
        fragmentShader: FRAGMENT_SHADER}));
var rightQuad = new THREE.Mesh(
    new THREE.PlaneGeometry(DISPLAY_WIDTH, DISPLAY_HEIGHT),
    new THREE.ShaderMaterial({
        uniforms: {
            tex: {type: "t", value: rightTex},
            lensCenter: {type: "v2", value: rightLensCenter},
            screenCenter: {type: "v2", value: screenCenter},
            scale: {type: "v2", value: scale},
            scaleIn: {type: "v2", value: scaleIn},
            hmdWarpParam: {type: "v4", value: hmdWarpParam},
        },
        vertexShader: VERTEX_SHADER,
        fragmentShader: FRAGMENT_SHADER}));

if (!flipEyes) {
  leftQuad.position.x = -DISPLAY_WIDTH / 2;
  rightQuad.position.x =  DISPLAY_WIDTH / 2;
} else {
  leftQuad.position.x =  DISPLAY_WIDTH / 2;
  rightQuad.position.x = -DISPLAY_WIDTH / 2;
}

var display = new THREE.Scene();
display.add(leftQuad);
display.add(rightQuad);

// setup the cameras used to render the actual scene
var ipdOffsetMeters = hmd.HScreenSize / 4 - hmd.InterpupillaryDistance / 2;
var leftCamera = new THREE.PerspectiveCamera(SCENE_FOV, DISPLAY_WIDTH / DISPLAY_HEIGHT);
leftCamera.projectionMatrix.elements[3] = ipdOffsetMeters;
leftCamera.position.x = -hmd.InterpupillaryDistance / 2;
var rightCamera = new THREE.PerspectiveCamera(SCENE_FOV, DISPLAY_WIDTH / DISPLAY_HEIGHT);
rightCamera.projectionMatrix.elements[3] = -ipdOffsetMeters;
rightCamera.position.x = hmd.InterpupillaryDistance / 2;
this.head = new THREE.Object3D();
this.head.add(leftCamera);
this.head.add(rightCamera);
this.add(this.head);

this.setRendererSize = function(renderer) {
  renderer.setSize(DISPLAY_WIDTH * 2, DISPLAY_HEIGHT);
}

this.render = function(renderer, scene) {
  // render the scene with each camera and then render the final display
  this.updateMatrixWorld();
  renderer.render(scene, leftCamera, leftTex, true);
  renderer.render(scene, rightCamera, rightTex, true);
  renderer.render(display, displayCamera);
}

this.setupMouseLook =function(element) {
  var hmd = this;
  element.addEventListener('mousemove',
    function(event) {
      if (event.buttons !== undefined && event.buttons != 1) {return false;} // Firefox
      if (event.which != 1) {return false;} // Chrome check
      hmd.head.rotation.y = -(event.pageX - renderer.domElement.width  / 2) *
          (Math.PI / renderer.domElement.width);
      hmd.head.rotation.x = -(event.pageY - renderer.domElement.height / 2) *
          (Math.PI / renderer.domElement.height);
    }, false);
}

this.setupFpsControl = function(element, moveSpeed, rotateSpeed) {
  rotateSpeed *= Math.PI / 180;

  element.addEventListener('keypress',
    function(event) {
      switch(event.charCode) {
        case 119: // W
          hmd.translateZ(-moveSpeed);
          break;
        case 97: // A
          hmd.translateX(-moveSpeed);
          break;
        case 115: // S
          hmd.translateZ( moveSpeed);
          break;
        case 100: // D
          hmd.translateX( moveSpeed);
          break;
        case 113: // Q
          hmd.rotation.y += rotateSpeed;
          break;
        case 101: // E
          hmd.rotation.y -= rotateSpeed;
          break;
      }
    }, false);
}

this.lastGamepadTick = 0;
this.updateGamepad = function(moveSpeed, rotateSpeed) {
  if (navigator.webkitGamepads !== undefined) {navigator.gamepads = navigator.webkitGamepads;}
  if (navigator.mozGamepads !== undefined) {navigator.gamepads = navigator.mozGamepads;}
  if (navigator.webkitGetGamepads !== undefined) {navigator.gamepads = navigator.webkitGetGamepads();}
  if (navigator.mozGetGamepads !== undefined) {navigator.gamepads = navigator.mozGetGamepads();}
  if (navigator.GetGamepads !== undefined) {navigator.gamepads = navigator.GetGamepads();}
  if (!navigator.gamepads) {return;}
  var hmd = this;
  if (hmd.lastGamepadTick == 0) {
      hmd.lastGamepadTick = Date.now();
      return;
  }
  var now = Date.now();
  var delta = (now - hmd.lastGamepadTick) / 1000;
  hmd.lastGamepadTick = now;

  rotateSpeed *= Math.PI / 180;
  var pad = Gamepad.getStates()[0];
  if (!pad) {return;}
  // Left stick to slide around
  if (Math.abs(pad.leftStickX) > pad.deadZoneLeftStick) {
    hmd.translateX(moveSpeed * pad.leftStickX * delta);
  }
  if (Math.abs(pad.leftStickY) > pad.deadZoneLeftStick) {
    hmd.translateZ(moveSpeed * pad.leftStickY * delta);
  }
  // Right stick to drive around
  if (Math.abs(pad.rightStickX) > pad.deadZoneRightStick) {
    hmd.rotation.y -= rotateSpeed * pad.rightStickX * delta;
  }
  if (Math.abs(pad.rightStickY) > pad.deadZoneRightStick) {
    hmd.translateZ(moveSpeed * pad.rightStickY * delta);
  }
  // Shoulder buttons to turn
  if (Math.abs(pad.leftShoulder1) > pad.deadZoneShoulder1) {
    hmd.rotation.y += rotateSpeed * pad.leftShoulder1 * delta;
  }
  if (Math.abs(pad.rightShoulder1) > pad.deadZoneShoulder1) {
    hmd.rotation.y -= rotateSpeed * pad.rightShoulder1 * delta;
  }
}
}

RiftCamera.prototype = new THREE.Camera();
