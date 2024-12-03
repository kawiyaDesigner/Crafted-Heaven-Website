<?php
include("dbconn.php");

// Fetch the node names from the database
$query = "SELECT sitting, leg, frame, mat, pillow FROM drafts";
$result = mysqli_query($conn, $query);

$nodesFromDB = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $nodesFromDB[] = [
            'sitting' => $row['sitting'],
            'leg' => $row['leg'],
            'frame' => $row['frame'],
            'mat' => $row['mat'],
            'pillow' => $row['pillow']
        ];
    }
} else {
    // Handle query error
    echo "<script>console.error('Database query failed: " . mysqli_error($conn) . "');</script>";
}

// Encode the PHP array as a JSON object and embed it into the page as a JavaScript variable
echo "<script>var nodesFromDB = " . json_encode($nodesFromDB, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ";</script>";
?>
