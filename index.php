<?php
    
    session_start();
    include("database.php");
    include("head.php");
    $password = 'pineapple';
    $hash = password_hash($password,PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
    // while($row = mysqli_fetch_assoc($result)){
    //     echo $row["id"] . "<br>";
    //     echo $row["user"] . "<br>";
    //     echo $row["password"] . "<br>";
    // }
    
    // $sql = "INSERT INTO users (user,password)
    //         VALUES ('Spongebob','$hash')";
   
    // mysqli_query($conn,$sql);

    
        
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div class="homediv">
            <h1>INDEX</h1><br>
            
            Login Page<br>
            <!-- <a href="home.php">HOME</a><br><br> -->
            username:<br>
            <input type="text" name="username"><br>
            password:<br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Register" name="register">
        </div>
    </form>
</body>
</html>


<?php
    include("foot.html");
    if(isset($_POST["view"])){
        header("location:view.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["register"])){
            $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

            if(empty($username) && empty($password)){
                echo "please enter a username and password";
            }
            elseif(empty($username)){
                echo "please enter a username";
            }
            elseif(empty($password)){
                echo "please enter a password";
            }
            else{
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (user,password)
                        VALUES ('$username','$hash')";
                try{
                    mysqli_query($conn,$sql);
                    echo "<script>alert('Registered');</script>";
                    
                }
                catch(mysqli_sql_exception){
                    echo "<script>alert('already have that user');</script>";
                }
        

        }
        }
        
        
    }

    mysqli_close($conn);
?>