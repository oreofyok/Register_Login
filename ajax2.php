 

<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","businessdb");
    
    
    if(empty($_SESSION["usernameSearch"])){
        $sql = "SELECT * FROM users";
    }
    elseif(!empty($_SESSION["usernameSearch"])){
        $user = $_SESSION["usernameSearch"];
        $sql = "SELECT * FROM users WHERE user LIKE '%$user%'";
    }
    
    $query_run = mysqli_query($conn,$sql);

    $result_array = [];
    
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            array_push($result_array,$row);
        }
        header('Content-type:application/json');
        echo json_encode($result_array);
    }
    else{
       echo "<h4>no record found</h4>"; 
    }
?>