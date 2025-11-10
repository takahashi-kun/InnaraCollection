import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

let scene, camera, renderer, controls, model;

function init() {
    const container = document.getElementById('configurator');

    if (!container) {
        console.error('❌ Container #configurator tidak ditemukan.');
        return;
    }

    // Ambil path model dari atribut HTML
    const modelUrl = container.getAttribute('data-model-url');
    if (!modelUrl) {
        console.error('❌ data-model-url tidak ditemukan di elemen #configurator');
        return;
    }

    // Setup scene
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf0f0f0);

    // Setup camera
    camera = new THREE.PerspectiveCamera(
        45,
        container.clientWidth / container.clientHeight,
        0.1,
        1000
    );
    camera.position.set(0, 1.5, 3);

    // Setup renderer
    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);

    // Setup orbit controls
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;

    // Setup lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 1);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(3, 5, 5);
    scene.add(directionalLight);

    // Load model .gltf
    const loader = new GLTFLoader();
    loader.load(
        modelUrl,
        (gltf) => {
            model = gltf.scene;

            // Center dan scale model
            const box = new THREE.Box3().setFromObject(model);
            const center = box.getCenter(new THREE.Vector3());
            const size = box.getSize(new THREE.Vector3()).length();

            model.position.sub(center);
            const scale = 1.5 / size;
            model.scale.setScalar(scale);

            scene.add(model);
            console.log('✅ Model loaded successfully:', gltf);
        },
        (xhr) => {
            console.log(`Loading model... ${(xhr.loaded / xhr.total * 100).toFixed(2)}%`);
        },
        (error) => {
            console.error('❌ Error loading model:', error);
            console.error('Path yang dicoba:', modelUrl);
        }
    );

    window.addEventListener('resize', onResize);
    animate();
}

function onResize() {
    const container = document.getElementById('configurator');
    if (!container) return;

    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
}

function animate() {
    requestAnimationFrame(animate);
    if (controls) controls.update();
    renderer.render(scene, camera);
}

document.addEventListener('DOMContentLoaded', init);