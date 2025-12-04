<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>

    <style>
        body{
            --bg: #f5d5f8ff;
            font-family: Georgia;
            display: flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .box{
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            text-align:center;
            width:300px;
        }
        h2{ margin:0 0 20px 0; }
        .btn{
            padding:10px 20px;
            margin:10px;
            border:0;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }
        .yes{ background: #df7875ff; color:white; }
        .no{ background: #7bbdd1ff; color:white; }
    </style>

</head>
<body>

<div class="box">
    <h2>Are you sure you want to logout?</h2>

    <form method="post">
        <button type="submit" name="yes" class="btn yes">Yes</button>
        <button type="submit" name="no" class="btn no">No</button>
    </form>
</div>

</body>
</html>

<?php
if (isset($_POST['yes'])) {
    session_unset();      
    session_destroy();   

    header("Location: login.php");
    exit;
}

if (isset($_POST['no'])) {
    header("Location: dashboard.php");
    exit;
}
?>
