import * as THREE from 'three';
import { OrbitControls } from 'three-stdlib';
import { OBJLoader } from 'three-stdlib';

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.querySelector('#tshirt-canvas');
    const scene = new THREE.Scene();

    const camera = new THREE.PerspectiveCamera(75, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
    renderer.setSize(canvas.clientWidth, canvas.clientHeight);
    renderer.setClearColor(0xffffff, 0);

    const light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(5, 5, 5);
    scene.add(light);

    // Ground light reflection
    const ambient = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambient);

    // Load OBJ model
    const loader = new THREE.OBJLoader();
    loader.load('build/assets/models/OBJ.obj', (object) => {
        object.scale.set(2, 2, 2);
        object.position.y = -1;
        scene.add(object);

        // Apply texture (optional)
        const texture = new THREE.TextureLoader().load('build/assets/textures/Nylon_Canvas_FCL2PSN003_test11_NRM.jpg');
        object.traverse((child) => {
            if (child.isMesh) child.material.map = texture;
        });
    });

    // Camera & Controls
    camera.position.z = 3;
    const controls = new OrbitControls(camera, renderer.domElement);

    // Render loop
    const animate = () => {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    };
    animate();
});