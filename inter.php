<?php
    session_start();
    include("head.php");
    if(!empty($_SESSION["username"])){
        $username = "WELCOME ". $_SESSION["username"];
    }
    else{
        $username = "No username";
    }
    
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
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="homediv">
            <h1>INTER PAGE</h1>

            <h4><?php echo $username?></h4><br>
            
            <input type="submit" name="INDEX" value="Log out"><br><br>
            <div class="content">
                <button id="addmorecontent">Add more content</button><br>
                <button id="clearcontent">Clear</button>
            </div>
        </div>
        
    </form>

    <div class="container">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $("#addmorecontent").click(function(e){
                    e.preventDefault();
                    //session storage
                    var count = sessionStorage.getItem("count");
                    if(count == null){
                        count = 0;
                    }
                    else if(count >= 20){
                        count = 1;
                    }
                    //ajax
                    $.ajax({
                        type: "GET",
                        url: "ajax.php",
                        data: {
                            count
                        },
                        dataType: "json",
                        success: function (response) {
                            //update count
                            count = response.count;
                            //update session storage
                            sessionStorage.setItem("count",count);
                            //update content
                            $(".content").append(response.content);
                        }
                    });
                })
                $("#clearcontent").click(function(e){
                    
                    e.defaultPrevented();
                    sessionStorage.clear();
                })
            });
        </script>
    </div>
</body>
</html>

<?php
    
    
    if(isset($_POST["INDEX"])){
        session_destroy();
        header("Location:home.php");
    }
    
?>