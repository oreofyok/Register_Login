<?php
    include("head.php");
    include("database.php");
    session_start();
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        h1{
            text-align: center;
            color: red;
        }
        .searchUser{
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <form action="view.php" method="post">
        <h1>View User</h1>
        <div class="searchUser">
            <div class="searchUser2">
                <p>username:</p>
                <input type="text" name="usernameInput">
                <input type="submit" name="userSearch" value="Search" id="searchsubmit">
                <input type="submit" name="all" value="All" id="searchAll">
                <h4 id="top"></h4>
            </div>
            <div class="searchUser2">
                <p>username:</p>
                <input type="text" name="usernameInputdelete">
                <input type="submit" name="userSearchdelete" value="Delete" id="searchsubmit">
                <input type="submit" name="alldelete" value="All" id="deleteAll">
                <h4 id="down"></h4>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-helder">
                            <h4>table</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>username</th>
                                        <th>password</th>
                                        <th>reg_date</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody class="users">
                                    <!-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="" >view</a>
                                            <a href="" >edit</a>
                                            <a href="" >delete</a>
                                        </td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </form>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            getdata();
            $('#searchAll').click(function(){
                $(this).css("font-size","50px");
            })
        });
        function getdata(){
            $.ajax({
                type: "GET",
                url: "ajax2.php",
                success: function (response) {
                    
                    $.each(response, function (key, value) { 
                         $('.users').append('<tr>'+
                                    '<td>'+value['id']+'</td>\
                                    <td>'+value['user']+'</td>\
                                    <td>'+value['password']+'</td>\
                                    <td>'+value['reg_date']+'</td>\
                                    <td>\
                                        <a href="" >view</a>\
                                        <a href="" >edit</a>\
                                        <a href="" >delete</a>\
                                    </td>\
                                </tr>');
                    });
                }
            });
        }
    </script>
</body>
</html>

<?php
    include("foot.html");
    if(isset($_POST["userSearch"])){
        if(!empty($_POST["usernameInput"])){
            $_SESSION["usernameSearch"] = $_POST["usernameInput"];
            
        }
        else{
            echo "<script>alert('enter word');</script>";
            
        }
       
    }


    if(isset($_POST["all"])){
        session_destroy();
    }
    
    if(isset($_POST["userSearchdelete"])){
        if(!empty($_POST["usernameInputdelete"])){
            $userdelete = $_POST["usernameInputdelete"];
            $sql = "DELETE FROM users WHERE user='$userdelete'";
            mysqli_query($conn,$sql);
            echo "<script>alert('$userdelete deleted');</script>";
        }
        else{
            echo "<script>alert('enter word to delete');</script>";
            
        }
    }
    if(isset($_POST["alldelete"])){
        $sql = "DELETE FROM users";
        
        mysqli_query($conn,$sql);
        echo "<script>alert('delete all');</script>";
    }
?>