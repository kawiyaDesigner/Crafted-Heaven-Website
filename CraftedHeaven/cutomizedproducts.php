<?php 
include("dbconn.php");
include("navbar.php");

session_start(); // Start the session to access logged-in user's data

// Check if the user is logged in and get the user ID
if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
} else {
    // Redirect to login page if the user is not logged in
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
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
            color: #333;
        }

        /* Page header */
        .header {
            font-size: 36px;
            color: #073f7b; /* Text color */
            margin:75px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color:white;
            padding: 20px;
            text-align:center;
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            width: 100%; /* Full width */
            z-index: 999; /* Ensure it stays on top */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow to give it a modern feel */
            border-radius: 0 0 10px 10px; /* Rounded corners at the bottom */
            display: block; /* Ensure it spans the entire width */
        }

        .header h1 {
            margin: 0;
            font-size: 2.3rem;
        }

        /* Container styling */
        .container {
            
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Individual frame container */
        .draft-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top:180px;
        }

        .draft-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Sketchfab iframe styling */
        .sketchfab {
            width: 100%;
            height: 300px;
            border: none;
        }

        /* Card details section */
        .draft-details {
            padding: 15px;
            text-align: center;
        }

        .draft-details h3 {
            font-size: 1.2rem;
            margin: 0 0 10px;
        }

        .draft-details p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .draft-details .btn {
            margin-top: 10px;
            display: inline-block;
            background: #073f7b;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
            margin-right:20px
        }

        .draft-details .btn:hover {
            background: #073f7b;
        }
        .draft-details .btn-delete {
            margin-top: 10px;
            display: inline-block;
            background: #D91656;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
            margin-right:20px
        }

        .draft-details .btn-delete:hover {
            background: #D91656;
        }
    </style>
</head>
<body>
<?php
    // Fetch all rows from the drafts table
    $sql = "SELECT * FROM drafts WHERE userid = '$userId'"; // Filter by user_id
    $result = mysqli_query($conn, $sql);
    $designs = [];

    // Store all rows into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $designs[] = $row;
    }
?>

<div class="header">
        <h1>Saved Drafts</h1>
    </div>

    <div class="container">
        <?php foreach ($designs as $key => $design): ?>
        <div class="draft-card">
            <iframe 
                class="sketchfab" 
                src="" 
                id="api-frame<?php echo $key; ?>" 
                allowfullscreen 
                mozallowfullscreen="true" 
                webkitallowfullscreen="true">
            </iframe>
            <div class="draft-details">
                <h3>Design #<?php echo $design['id']; ?></h3>
                
                <a href="deletedraft.php?id=<?php echo $design['id']; ?>" class="btn-delete">Delete</a>

                <a href="javascript:void(0);" onclick="sendRequest(<?php echo $design['id']; ?>);" class="btn">Send Request</a>

            </div>
        </div>
        <?php endforeach; ?>
    </div>

<script type="text/javascript">
   
   function sendRequest(draftId) {
    // Prepare the data to be sent
    const requestData = {
        id: draftId // Only send the draft ID
    };

    // Send the data to the server
    fetch('save_request.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Request successfully sent!");
            } else {
                alert("Failed to send request: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An unexpected error occurred.");
        });
}


    const designs = <?php echo json_encode($designs, JSON_HEX_TAG); ?>;

    // Utility functions
    const getNodeByName = (nodemap, nodename) => {
        return Object.values(nodemap).find(node => {
            return node.type === "MatrixTransform" && node.name === nodename;
        });
    };

    const success = (api, design) => {
        api.start(function () {
            api.addEventListener("viewerready", function () {
                api.getNodeMap(function (err, nodes) {
                    if (!err) {
                        // Extract data from the current design
                        const { leg, mat, sitting, frame, pillow } = design;

                        // Fetch nodes
                        const leg1 = getNodeByName(nodes, "leg1");
                        const leg2 = getNodeByName(nodes, "leg2");
                        const leg3 = getNodeByName(nodes, "leg3");
                        const mat1 = getNodeByName(nodes, "mat1");
                        const mat2 = getNodeByName(nodes, "mat2");
                        const sitting1 = getNodeByName(nodes, "sitting1");
                        const sitting2 = getNodeByName(nodes, "sitting2");
                        const sitting3 = getNodeByName(nodes, "sitting3");
                        const frame1 = getNodeByName(nodes, "frame1");
                        const frame2 = getNodeByName(nodes, "frame2");
                        const pillow1 = getNodeByName(nodes, "pilow1");
                        const pillow2 = getNodeByName(nodes, "pillow2");

                        // Hide all parts initially
                        [leg1, leg2, leg3, mat1, mat2, sitting1, sitting2, sitting3, frame1, frame2, pillow1, pillow2].forEach(node => {
                            if (node) api.hide(node.instanceID);
                        });

                        // Show specific parts based on the design data
                        if (leg === "leg1" && leg1) api.show(leg1.instanceID);
                        if (leg === "leg2" && leg2) api.show(leg2.instanceID);
                        if (leg === "leg3" && leg3) api.show(leg3.instanceID);

                        if (mat === "mat1" && mat1) api.show(mat1.instanceID);
                        if (mat === "mat2" && mat2) api.show(mat2.instanceID);

                        if (sitting.includes("sitting1") && sitting1) api.show(sitting1.instanceID);
                        if (sitting.includes("sitting2") && sitting2) api.show(sitting2.instanceID);
                        if (sitting.includes("sitting3") && sitting3) api.show(sitting3.instanceID);

                        if (frame === "frame1" && frame1) api.show(frame1.instanceID);
                        if (frame === "frame2" && frame2) api.show(frame2.instanceID);

                        if (pillow.includes("pilow1") && pillow1) api.show(pillow1.instanceID);
                        if (pillow.includes("pillow2") && pillow2) api.show(pillow2.instanceID);
                    }
                });
            });
        });
    };

    const loadSketchfab = (sceneuid, elementId, design) => {
        const iframe = document.getElementById(elementId);
        const client = new Sketchfab("1.12.1", iframe);

        client.init(sceneuid, {
            success: (api) => success(api, design),
            error: () => console.error("Sketchfab API error"),
            ui_stop: 0,
            preload: 1,
            camera: 0
        });
    };

    // Load models for all designs
    designs.forEach((design, index) => {
        loadSketchfab("69e1ec48e148497592bdad8aea80fdde", `api-frame${index}`, design);
    });
</script>

</body>
</html>
