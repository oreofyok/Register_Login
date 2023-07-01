<?php
    include("head.php");
    include("sidebar.html");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <p>1</p>
    <input type="submit" value="add" id="add">






    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#add').click(function(){
                $('p').append('asdsas');
                $('p').css("font-size","50px");
            })
        });
    </script>
</body>
</html>

<?php
    include("foot.html");
    
?>