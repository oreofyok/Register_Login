<?php
    header("Content-Type: application/json");
    if(isset($_GET["count"]) && $_GET["count"] != ""){
        $count = $_GET["count"];
        $count++;
        echo json_encode(["count" => $count,"content" =>
        "<h1>Content $count</h1>"]); 
    }
?>