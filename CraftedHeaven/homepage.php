<?php
include("navbar.php");
session_start();
include("dbconn.php");

if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit();
}
?>





<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sketchfab Viewer API Example</title>
    <script type="text/javascript" src="https://static.sketchfab.com/api/sketchfab-viewer-1.0.0.js"></script>
    <link rel="stylesheet" href="homepage.css">

</head>

<body>
        <div class="container">
            <div class="left-container">
                <!-- Sketchfab iframe -->
                <iframe class="sketchfab" src="" id="api-frame" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
                <!-- Images to change between Sketchfab models -->
                <img id="model1-btn" class="image-button2" src="6.png" alt="Model 1">
                <img id="model2-btn" class="image-button2" src="6.png" alt="Model 2">
            </div>

        <div class="right-container"> 
            <!-- Image button container for Model 1 -->
            <div id="image-button-container-1" class="image-button-container">
                <img id="toggle-cube-2" class="image-button" src="5.png" alt="Show Cube 2">
                <img id="toggle-cube-5" class="image-button" src="3.png" alt="Show Cube 5">
                <img id="toggle-cube-6" class="image-button" src="4.png" alt="Show Cube 6">
            </div>

            <div id="image-button-container-1" class="image-button-container">
                <img id="leg1-btn" class="image-button" src="leg1.png" alt="Leg 1">
                <img id="leg2-btn" class="image-button" src="leg2.png" alt="Leg 2">
                <img id="leg3-btn" class="image-button" src="leg3.png" alt="Leg 3">
            </div>

            <div id="image-button-container-1" class="image-button-container">
                <img id="mat1-btn" class="image-button" src="mat1.png" alt="Mat 1">
                <img id="mat2-btn" class="image-button" src="mat2.png" alt="Mat 2">
                
            </div>

            <div id="image-button-container-1" class="image-button-container">
                <img id="frame1-btn" class="image-button" src="frame1.png" alt="Frame 1">
                <img id="frame2-btn" class="image-button" src="frame2.png" alt="Frame 2">
                
            </div>
            <div id="image-button-container-1" class="image-button-container">
                <img id="pillow1-btn" class="image-button" src="pillow1.png" alt="Pillow 1">
                <img id="pillow2-btn" class="image-button" src="pillow2.png" alt="Pillow 2">
                
            </div>
            
            <!-- Image button container for Model 2 (hidden by default) -->
            <div id="image-button-container-2" class="image-button-container hidden">
                <img id="toggle-model2-btn1" class="image-button" src="8.png" alt="Show Element 1">
                <img id="toggle-model2-btn2" class="image-button" src="9.png" alt="Show Element 2">
                <img id="toggle-model2-btn3" class="image-button" src="10.png" alt="Show Element 3">
            </div>
            <div class="button-container">
            <button onclick="saveDraft()" id="saveDraft" class="save-draft-btn">Save Draft</button>

            <button class="save-draft-btn" onclick="window.location.href='cutomizedproducts.php'">Go to Drafts</button>

           
            </div>
        </div>
    </div>


       


    <script type="text/javascript">




    // Function to toggle visibility between containers
    const toggleContainers = (showContainer1) => {
        const container1 = document.getElementById('image-button-container-1');
        const container2 = document.getElementById('image-button-container-2');
        
        if (showContainer1) {
            container1.classList.remove('hidden');
            container2.classList.add('hidden');
        } else {
            container1.classList.add('hidden');
            container2.classList.remove('hidden');
        }
    };
// Function to get a specific node by name
const getNodeByName = (nodemap, nodename) => {
    return Object.values(nodemap).find((node) => {
        if (node.type === "MatrixTransform" && node.name === nodename) {
            return node;
        }
    });
};

// Function to show one object and hide the others
const showOnlyOne = (api, visibleInstanceID, hiddenInstanceIDs) => {
    api.show(visibleInstanceID);
    hiddenInstanceIDs.forEach(id => {
        api.hide(id);
    });
};



const success = (api) => {
    api.start(function () {
        api.addEventListener("viewerready", function () {
            api.getNodeMap(function(err, nodes) {
                if (!err) {
                    console.log(nodes); // Log the nodes to inspect if necessary

                    // Get the nodes for sitting1, sitting2, sitting3
                    const sitting1 = getNodeByName(nodes, "sitting1");
                    const sitting2 = getNodeByName(nodes, "sitting3");
                    const sitting3 = getNodeByName(nodes, "sitting2");

                    // Get the nodes for leg1, leg2, leg3
                    const leg1 = getNodeByName(nodes, "leg1");
                    const leg2 = getNodeByName(nodes, "leg2");
                    const leg3 = getNodeByName(nodes, "leg3");

                    // Get the nodes for frame1, frame2
                    const frame1 = getNodeByName(nodes, "frame1");
                    const frame2 = getNodeByName(nodes, "frame2");

                    // Get the nodes for mat1, mat2
                    const mat1 = getNodeByName(nodes, "mat1");
                    const mat2 = getNodeByName(nodes, "mat2");

                    // Get the nodes for pillow1, pillow2
                    const pilow1 = getNodeByName(nodes, "pilow1");
                    const pillow2 = getNodeByName(nodes, "pillow2");

                    // Hide all nodes initially
                    if (sitting1) api.hide(sitting1.instanceID);
                    if (sitting2) api.hide(sitting2.instanceID);
                    if (sitting3) api.hide(sitting3.instanceID);

                    if (leg1) api.hide(leg1.instanceID);
                    if (leg2) api.hide(leg2.instanceID);
                    if (leg3) api.hide(leg3.instanceID);

                    if (frame1) api.hide(frame1.instanceID);
                    if (frame2) api.hide(frame2.instanceID);

                    if (mat1) api.hide(mat1.instanceID);
                    if (mat2) api.hide(mat2.instanceID);

                    if (pilow1) api.hide(pilow1.instanceID);
                    if (pillow2) api.hide(pillow2.instanceID);

                    // Show default objects
                    if (sitting1) api.show(sitting1.instanceID);
                    if (leg1) api.show(leg1.instanceID);
                    if (frame1) api.show(frame1.instanceID);
                    if (mat1) api.show(mat1.instanceID);
                    if (pilow1) api.show(pilow1.instanceID);

                    // Sitting image click events
                    if (sitting1) {
                        document.getElementById('toggle-cube-2').addEventListener('click', function () {
                            showOnlyOne(api, sitting1.instanceID, [sitting2.instanceID, sitting3.instanceID]);
                        });
                    }
                    if (sitting2) {
                        document.getElementById('toggle-cube-5').addEventListener('click', function () {
                            showOnlyOne(api, sitting2.instanceID, [sitting1.instanceID, sitting3.instanceID]);
                        });
                    }
                    if (sitting3) {
                        document.getElementById('toggle-cube-6').addEventListener('click', function () {
                            showOnlyOne(api, sitting3.instanceID, [sitting1.instanceID, sitting2.instanceID]);
                        });
                    }

                    // Leg image click events
                    if (leg1) {
                        document.getElementById('leg1-btn').addEventListener('click', function () {
                            showOnlyOne(api, leg1.instanceID, [leg2.instanceID, leg3.instanceID]);
                        });
                    }
                    if (leg2) {
                        document.getElementById('leg2-btn').addEventListener('click', function () {
                            showOnlyOne(api, leg2.instanceID, [leg1.instanceID, leg3.instanceID]);
                        });
                    }
                    if (leg3) {
                        document.getElementById('leg3-btn').addEventListener('click', function () {
                            showOnlyOne(api, leg3.instanceID, [leg1.instanceID, leg2.instanceID]);
                        });
                    }

                    // Frame image click events
                    if (frame1) {
                        document.getElementById('frame1-btn').addEventListener('click', function () {
                            showOnlyOne(api, frame1.instanceID, [frame2.instanceID]);
                        });
                    }
                    if (frame2) {
                        document.getElementById('frame2-btn').addEventListener('click', function () {
                            showOnlyOne(api, frame2.instanceID, [frame1.instanceID]);
                        });
                    }

                    // mat image click events
                    if (mat1) {
                        document.getElementById('mat1-btn').addEventListener('click', function () {
                            showOnlyOne(api, mat1.instanceID, [mat2.instanceID]);
                        });
                    }
                    if (mat2) {
                        document.getElementById('mat2-btn').addEventListener('click', function () {
                            showOnlyOne(api, mat2.instanceID, [mat1.instanceID]);
                        });
                    }
                    
                    // Pillow image click events
                    if (pilow1) {
                        document.getElementById('pillow1-btn').addEventListener('click', function () {
                            showOnlyOne(api, pilow1.instanceID, [pillow2.instanceID]);
                        });
                    }
                    if (pillow2) {
                        document.getElementById('pillow2-btn').addEventListener('click', function () {
                            showOnlyOne(api, pillow2.instanceID, [pilow1.instanceID]);
                        });
                    }
                }
            });
        });
    });
};



const loadSketchfab = (sceneuid, elementId) => {
    const iframe = document.getElementById(elementId);
    const client = new Sketchfab("1.12.1", iframe);

    client.init(sceneuid, {
        success: success,
        error: () => console.error("Sketchfab API error"),
        ui_stop: 0,
        preload: 1,
        camera: 0
    });
};

    // Load the first model by default
    loadSketchfab("69e1ec48e148497592bdad8aea80fdde", "api-frame");

    // Add event listeners for changing the Sketchfab model
    document.getElementById('model1-btn').addEventListener('click', function() {
        loadSketchfab("69e1ec48e148497592bdad8aea80fdde", "api-frame"); // First model
        toggleContainers(true); // Show container for Model 1
    });

    document.getElementById('model2-btn').addEventListener('click', function() {
        loadSketchfab("2a61dd227db34fa4b400fb6bccb34937", "api-frame"); // Second model
        toggleContainers(false); // Show container for Model 2
    });






let selectedLeg = ""; // To store the selected leg
let selectedSitting = ""; // To store the selected sitting
let selectedFrame = ""; // To store the selected frame
let selectedMat = ""; // To store the selected mat
let selectedPillow = ""; // To store the selected pillow

// Update these variables whenever the user clicks an element
document.getElementById('leg1-btn').addEventListener('click', function () {
    selectedLeg = "leg1"; // Update selected leg
    showOnlyOne(api, leg1.instanceID, [leg2.instanceID, leg3.instanceID]);
});

document.getElementById('leg2-btn').addEventListener('click', function () {
    selectedLeg = "leg2"; // Update selected leg
    showOnlyOne(api, leg2.instanceID, [leg1.instanceID, leg3.instanceID]);
});

document.getElementById('leg3-btn').addEventListener('click', function () {
    selectedLeg = "leg3"; // Update selected leg
    showOnlyOne(api, leg3.instanceID, [leg1.instanceID, leg2.instanceID]);
});



// For Sitting
document.getElementById('toggle-cube-2').addEventListener('click', function () {
    selectedSitting = "sitting1"; // Update selected sitting
    showOnlyOne(api, sitting1.instanceID, [sitting2.instanceID, sitting3.instanceID]);
});

document.getElementById('toggle-cube-5').addEventListener('click', function () {
    selectedSitting = "sitting2"; // Update selected sitting
    showOnlyOne(api, sitting2.instanceID, [sitting1.instanceID, sitting3.instanceID]);
});

document.getElementById('toggle-cube-6').addEventListener('click', function () {
    selectedSitting = "sitting3"; // Update selected sitting
    showOnlyOne(api, sitting3.instanceID, [sitting1.instanceID, sitting2.instanceID]);
});
// For Frame
document.getElementById('frame1-btn').addEventListener('click', function () {
    selectedFrame = "frame1"; // Update selected frame
    showOnlyOne(api, frame1.instanceID, [frame2.instanceID]);
});

document.getElementById('frame2-btn').addEventListener('click', function () {
    selectedFrame = "frame2"; // Update selected frame
    showOnlyOne(api, frame2.instanceID, [frame1.instanceID]);
});

// For Mat
document.getElementById('mat1-btn').addEventListener('click', function () {
    selectedMat = "mat1"; // Update selected mat
    showOnlyOne(api, mat1.instanceID, [mat2.instanceID]);
});

document.getElementById('mat2-btn').addEventListener('click', function () {
    selectedMat = "mat2"; // Update selected mat
    showOnlyOne(api, mat2.instanceID, [mat1.instanceID]);
});

// For Pillow
document.getElementById('pillow1-btn').addEventListener('click', function () {
    selectedPillow = "pillow1"; // Update selected pillow
    showOnlyOne(api, pillow1.instanceID, [pillow2.instanceID]);
});

document.getElementById('pillow2-btn').addEventListener('click', function () {
    selectedPillow = "pillow2"; // Update selected pillow
    showOnlyOne(api, pillow2.instanceID, [pillow1.instanceID]);
});


document.getElementById('saveDraft').addEventListener('click', function () {
    const dataToSave = {
        sitting: selectedSitting,
        leg: selectedLeg,
        frame: selectedFrame,
        mat: selectedMat,
        pillow: selectedPillow
    };

    // Send the data to PHP via AJAX
    fetch('save_draft.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dataToSave) // Convert to JSON and send
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Draft saved successfully!");
        } else {
            alert("Error saving draft: " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


    </script>

</body>
</html>
