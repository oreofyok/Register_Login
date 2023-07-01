<?php
    session_start();
    include("database.php");
    include("head.php");
    
    $sql = "SELECT * FROM users ";
    $result = mysqli_query($conn,$sql);
    // while($row = mysqli_fetch_assoc($result)){
    //     echo $row["user"] . "<br>";
    //     echo $row["password"] . "<br>";
    // }
    
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
    <form action="home.php" method="post">
        <div class="homediv">
            <h1>HOME</h1>
            
            username:<br>
            <input type="text" name="username"><br>
            password:<br>
            <input type="password" name="password"><br>

            <input type="submit" name="login" value="Log in">
            <!-- <input type="submit" name="logout" value="Log out"> -->
        </div>
    </form>
</body>
</html>

<?php
    include("foot.html");

    if(isset($_POST["login"])){
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            // $username = $_POST["username"];
            // $password = $_POST["password"];
            // $hash = password_hash($password,PASSWORD_DEFAULT);
            

            // $sql = "SELECT * FROM users WHERE user='$username' AND password='$password'";
            // $result = mysqli_query($conn,$sql);
            
            // $check = mysqli_fetch_assoc($result);
            // if(isset($check)){
                
            //     $_SESSION["username"] = $username;
            //     header("Location:inter.php");
                
            // }
            // else{
            //     //echo $check["user"];
            //     echo "fail <br>";
            // }
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM users WHERE user='$username'";
            $result = mysqli_query($conn,$sql);
            
            $num = mysqli_num_rows($result);
            // $row=mysqli_fetch_assoc($result);
            if($num == 1){
                while($row=mysqli_fetch_assoc($result)){
                    if(password_verify($password,$row['password'])){
                        $_SESSION["username"] = $username;
                        
                        header("location:inter.php");
                    }
                    else{
                        echo "<script>alert('wrong password');</script>";
                    }
                }
            }
            else{
                echo "<script>alert('no user');</script>";
            }

            
        }
        elseif(empty($_POST["username"]) && empty($_POST["password"])){
            echo "<script>alert('enter user and password');</script>";
        }
        elseif(empty($_POST["username"])){
            echo "<script>alert('enter username');</script>";
        }
        elseif(empty($_POST["password"])){
            echo "<script>alert('enter password');</script>";
        }
    }
    // if(isset($_POST["logout"])){
    //     session_destroy();
    //     header("Location:index.php");
    // }
    
    // echo $_SESSION["username"] . "<br>";
    // echo $_SESSION["password"] . "<br>";
?>