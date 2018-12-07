
@extends('layouts.template_dashboard')

@section('content')
    <div class="container">
		<div class="container-search">
			<input class="container-search-input" type="text" name="q" placeholder="Search Agent"/>
		</div>
		<div class="container-list">
            @foreach($agents as $agent)

        <li class="container-list-item" data_firstname="{{$agent->firstname}}" data_lastname="{{$agent->lastname}}" 
            data_email="{{$agent->email}}" data_phone_number="{{$agent->phone_number}}"  data-pos="{{$loop->iteration}}">
                <h3 class="container-list-item-title"> {{$agent->name }}</h3>
                <a class="container-list-item-button" href="#">Edit</a>
                </li>

            @endforeach
		</div>

		<div class="container-select_modal">
            <div class="container-select_modal_info">
            </div>    
            <img class="container-select_modal-cross" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDIxLjkgMjEuOSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjEuOSAyMS45IiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KICA8cGF0aCBkPSJNMTQuMSwxMS4zYy0wLjItMC4yLTAuMi0wLjUsMC0wLjdsNy41LTcuNWMwLjItMC4yLDAuMy0wLjUsMC4zLTAuN3MtMC4xLTAuNS0wLjMtMC43bC0xLjQtMS40QzIwLDAuMSwxOS43LDAsMTkuNSwwICBjLTAuMywwLTAuNSwwLjEtMC43LDAuM2wtNy41LDcuNWMtMC4yLDAuMi0wLjUsMC4yLTAuNywwTDMuMSwwLjNDMi45LDAuMSwyLjYsMCwyLjQsMFMxLjksMC4xLDEuNywwLjNMMC4zLDEuN0MwLjEsMS45LDAsMi4yLDAsMi40ICBzMC4xLDAuNSwwLjMsMC43bDcuNSw3LjVjMC4yLDAuMiwwLjIsMC41LDAsMC43bC03LjUsNy41QzAuMSwxOSwwLDE5LjMsMCwxOS41czAuMSwwLjUsMC4zLDAuN2wxLjQsMS40YzAuMiwwLjIsMC41LDAuMywwLjcsMC4zICBzMC41LTAuMSwwLjctMC4zbDcuNS03LjVjMC4yLTAuMiwwLjUtMC4yLDAuNywwbDcuNSw3LjVjMC4yLDAuMiwwLjUsMC4zLDAuNywwLjNzMC41LTAuMSwwLjctMC4zbDEuNC0xLjRjMC4yLTAuMiwwLjMtMC41LDAuMy0wLjcgIHMtMC4xLTAuNS0wLjMtMC43TDE0LjEsMTEuM3oiIGZpbGw9IiMwMDAwMDAiLz4KPC9zdmc+Cg=="/>

        </div>

        <div class="container-canvas" id="viewer_zone">

        </div>
	</div>

    <script type="text/javascript" src="{{asset('js/agent.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/99/three.js"></script>
    <script src="{{asset('js/CopyShader.js')}}"></script>
    <script src="{{asset('js/DDSLoader.js')}}"></script>
    <script src="{{asset('js/Detector.js')}}"></script>
    <script src="{{asset('js/EffectComposer.js')}}"></script>
    <script src="{{asset('js/FXAAShader.js')}}"></script>
    <script src="{{asset('js/OrbitControls.js')}}"></script>
    <script src="{{asset('js/OutlinePass.js')}}"></script>
    <script src="{{asset('js/Reflector.js')}}"></script>
    <script src="{{asset('js/RenderPass.js')}}"></script>
    <script src="{{asset('js/ShaderPass.js')}}"></script>
    <script src="{{asset('js/GLTFLoader.js')}}"></script>
    <script src="{{asset('js/ImprovedNoise.js')}}"></script>


    <script>
            if (!Detector.webgl) Detector.addGetWebGLMessage();
        
            var container, camera, scene, renderer, size, table_size, terrain, load_timeout, model_timeout, planeTop, planeBottom, planeRight, planeLeft, verticalMirror, table_model, outlinePass, composer;
        
            var full_screen_enabled = false;
            var click_level = 0;
            var selectedObject;
            var raycaster = new THREE.Raycaster();
            var mouse = new THREE.Vector2();
            var pointed = new THREE.Vector3();
        
            var materialBlue = new THREE.LineBasicMaterial({
                color: 0x0000ff
            });
            var materialRed = new THREE.LineBasicMaterial({
                color: 0xff0000
            }); 
            
        
            init();
        
            function init() {
        
                container = document.getElementById('viewer_zone');
        
                scene = new THREE.Scene();
                camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.001, 100000);
                camera.up.set(0, 1, 0);
                renderer = new THREE.WebGLRenderer({ antialias: true });
        
                //==============================================================
                //Lights
                var ambientLight = new THREE.AmbientLight(0xffffff, 1);
                scene.add(ambientLight);
                scene.add(camera);       
        
                scene.fog = new THREE.FogExp2( 0xefd1b5, 0.0025 );
        
                //==============================================================
                //Loader
                function load_object(url) {
                    return new Promise(function (resolve, reject) {
                        new THREE.GLTFLoader().load(
                            url,
                            function (gltf) {
                                resolve(gltf);
                            },
                            function (xhr) {
                                console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                            },
                            function (error) {
                                console.log('An error happened');
                            }
                        );
                    });
                }
                //==============================================================
                // Place the base after clicked on point
                function placeObjects() {
                    var point = new THREE.Vector3(0.06841409007088721, 0.11014283240951989, 0.30837955106009607);
        
                    // modele non aojoute car trop lourd
                    /*load_object('http://127.0.0.1:8000/models/lunar/scene.gltf').then(function (object) {
                        object.scene.scale.set(1 / 1000, 1 / 1000, 1 / 1000);
            
                        tempSize = new THREE.Vector3();
                        var box = new THREE.Box3().setFromObject(object.scene);
                        box.getSize(tempSize);
            
                        object.scene.position.set(point.x, point.y + tempSize.y/2, point.z);
                        scene.add(object.scene);
                    });*/
        
                    load_object('{{ asset("models/base2/scene.gltf") }}').then(function (object) {
                        
                        object.scene.scale.set(1 / 1000, 1 / 1000, 1 / 1000);
        
                        tempSize1 = new THREE.Vector3();
                        var box = new THREE.Box3().setFromObject(object.scene);
                        box.getSize(tempSize1);
        
                        object.scene.position.set(point.x, point.y, point.z);
                        var geometry = new THREE.Geometry();
                        var line = new THREE.Line(geometry, materialRed);
                        geometry.vertices.push(
                            object.scene.position,
                            new THREE.Vector3(object.scene.position.x, size.y * 2, object.scene.position.z)
                        );
                        scene.add(line);
                        scene.add(object.scene);
        
                        load_object('{{ asset("models/base1/scene.gltf") }}').then(function (object) {
                            object.scene.scale.set(1 / 500, 1 / 500, 1 / 500);
        
                            tempSize2 = new THREE.Vector3();
                            var box = new THREE.Box3().setFromObject(object.scene);
                            box.getSize(tempSize2);
        
                            object.scene.position.set(point.x - tempSize1.x, point.y, point.z - tempSize1.z);
                            scene.add(object.scene);
        
                            load_object('{{ asset("models/antenna/scene.gltf") }}').then(function (object) {
                                object.scene.scale.set(1 / 5000, 1 / 5000, 1 / 5000);
        
                                tempSize3 = new THREE.Vector3();
                                var box = new THREE.Box3().setFromObject(object.scene);
                                box.getSize(tempSize3);
        
                                object.scene.position.set(point.x - tempSize2.x, point.y, point.z - tempSize2.z);
                                scene.add(object.scene);
        
                                load_object('{{ asset("models/rover/scene.gltf") }}').then(function (object) {
                                    object.scene.scale.set(1 / 30000, 1 / 30000, 1 / 30000);
        
                                    tempSize4 = new THREE.Vector3();
                                    var box = new THREE.Box3().setFromObject(object.scene);
                                    box.getSize(tempSize4);
        
                                    object.scene.position.set(point.x + tempSize1.x, point.y + tempSize4.y, point.z);
                                    scene.add(object.scene);
                                });
                            });
                        });
                    });
                }
                //==============================================================
                // Place Human
                function placeHUman(x, z){
                    var raycasterHuman = new THREE.Raycaster();
                    var directionHuman = new THREE.Vector3(0, -1, 0);
                    var positionHuman = new THREE.Vector3(x, size.y * 3, z);
                    raycasterHuman.set(positionHuman, directionHuman);
                    intersectHuman = raycasterHuman.intersectObjects([terrain], true);
                    var humanPos = intersectHuman[0].point;
                    var geometry = new THREE.Geometry();
                    var line = new THREE.Line(geometry, materialBlue);
                    geometry.vertices.push(
                        humanPos,
                        new THREE.Vector3(humanPos.x, size.y*2, humanPos.z)
                    );
                    scene.add(line);
        
                    load_object('{{ asset("models/human/scene.gltf") }}').then(function (object) {
                        object.scene.scale.set(1 / 500000, 1 / 500000, 1 / 500000);
                        object.scene.position.set(humanPos.x, humanPos.y, humanPos.z);
                        scene.add(object.scene);
                    });
                }
        
                //==============================================================
                // Detect click on elements
                function checkIfClicked(event) {
                    mouse.x = (event.offsetX / renderer.domElement.clientWidth) * 2 - 1;
                    mouse.y = - (event.offsetY / renderer.domElement.clientHeight) * 2 + 1;
                    raycaster.setFromCamera(mouse, camera);
                    var intersects = raycaster.intersectObjects([terrain], true);
                    if (intersects.length > 0) {
                        selectedObject = intersects[0].object;
                        outlinePass.selectedObjects = [selectedObject];
        
                        pointed = intersects[0].point;
        
                        if (click_level == 0) {
                            click_level++;
                        }
        
                    }
                }
        
                load_object('{{ asset("models/terrain/scene.gltf") }}').then(function (object) {
                    terrain = object.scene;
                    scene.add(object.scene);
                    placeObjects();
                    size = new THREE.Vector3();
                    var box = new THREE.Box3().setFromObject(object.scene);
        
                    box.getSize(size);
                    var spotLight = new THREE.SpotLight(0xffffff);
                    spotLight.position.set(size.x, size.y * 3, size.z);
                    camera.position.set(0, size.y / 2, 2 * size.y);
        
                    placeHUman((Math.random() * size.x) - size.x / 2, (Math.random() * size.z) - size.z / 2);
                    placeHUman((Math.random() * size.x) - size.x / 2, (Math.random() * size.z) - size.z / 2);
                    placeHUman((Math.random() * size.x) - size.x / 2, (Math.random() * size.z) - size.z / 2);
        
                });
        
                controls = new THREE.OrbitControls(camera, renderer.domElement);
                controls.panSpeed = 0.05;
                controls.enableDamping = true;
                controls.dampingFactor = 0.05;
                controls.rotateSpeed = 0.03;
                controls.autoRotateSpeed = 0.5;
                controls.autoRotate = false;
                controls.domElement.addEventListener('mousedown', checkIfClicked, false);
                window.addEventListener('resize', onWindowResize, false);
        
                renderer.setSize(container.clientWidth, container.clientHeight);
                renderer.setClearColor(0xcccccc);
                container.appendChild(renderer.domElement);
        
                composer = new THREE.EffectComposer(renderer);
                var renderPass = new THREE.RenderPass(scene, camera);
                composer.addPass(renderPass);
                outlinePass = new THREE.OutlinePass(new THREE.Vector2(renderer.domElement.clientWidth, renderer.domElement.clientHeight), scene, camera);
                composer.addPass(outlinePass);
                var copyPass = new THREE.ShaderPass(THREE.CopyShader);
                copyPass.renderToScreen = true;
                composer.addPass(copyPass);
        
                animate();
            }
        
            function onWindowResize() {
                if (document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.mozFullScreenElement ||
                    document.msFullscreenElement) {
        
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
        
                    renderer.setSize(window.innerWidth, window.innerHeight);
                    composer.setSize(window.innerWidth, window.innerHeight);
                } else {
        
                    camera.aspect = container.clientWidth / container.clientHeight;
                    camera.updateProjectionMatrix();
        
                    renderer.setSize(container.clientWidth, container.clientHeight);
                    composer.setSize(container.clientWidth, container.clientHeight);
                }
        
        
            }
        
            function animate() {
        
                requestAnimationFrame(animate);
                controls.update();
                composer.render();
        
            }
        </script>
        
@endsection