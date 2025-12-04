<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "flower";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $FullName = trim($_POST['FullName']);
    $password = trim($_POST['password']);

    if ($FullName === "admin" && $password === "Test@gmail.com") {
        $_SESSION['FullName'] = $FullName;
        header("Location: dashboard.php");
        exit();
    }

    $sql = "SELECT * FROM login WHERE FullName=? AND password=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $FullName, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['FullName'] = $FullName;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }

        $stmt->close();
    } else {
        $error = "Query error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: "Inter", Arial, sans-serif;
             --bg: #f5d5f8ff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 720px;
            max-width: 95%;
            height:60%;
            background: white;
            display: flex;
            border-radius: 14px;
             background: #fad8f3ff;
            overflow: hidden;
            box-shadow: 0px 4px 18px rgba(0,0,0,0.15);
        }

        .left-side {
            width: 50%;
            min-height: 380px;
        }
        .left-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .right-side {
            width: 50%;
            padding: 30px;
            box-sizing: border-box;
        }

        h2 {
            margin-top: 60px;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
        }

        p {
            text-align: center;
            margin: 8px 0 18px;
            color: #444;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            font-size: 15px;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            background: #b468a2ff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #875c77ff;
        }

        .error-message {
            text-align: center;
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }

        @media (max-width: 720px) {
            .card { flex-direction: column; }
            .left-side, .right-side { width: 100%; }
            .left-side { min-height: 220px; }
        }
    </style>
</head>

<body>

<div class="card">
    <div class="left-side">
        <img src="https://tse3.mm.bing.net/th/id/OIP.jxZzOPd96uP69tDXhi39nAAAAA?pid=ImgDet&w=184&h=325&c=7&dpr=1.3&o=7&rm=3" alt="Flower">
    </div>

    <div class="right-side">
        <h2>Login</h2>
        <p>Admin Login Panel</p>

        <form method="POST">
            <input type="text" name="FullName" placeholder="Enter Name" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="Login">
        </form>

        <?php if (!empty($error)) { ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php } ?>
    </div>

</div>

</body>
</html>
