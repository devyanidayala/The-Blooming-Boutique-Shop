<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = [
        "name" => "",
        "email" => "",
        "phone" => "",
        "image" => "default.png"
    ];
}

$success = "";

if (isset($_POST['update'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $imageName = $_SESSION['admin']['image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $target = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }
    
    $_SESSION['admin'] = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "image" => $imageName
    ];

    $success = "Profile Updated Successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>

<style>
:root {
    --bg: #f5d5f8ff;
    --card:#fff;
}

body{
    margin:0;
    background:var(--bg);
    font-family: Georgia;
}

.wrapper{
    width:100%;
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

.card{
    width:100%;
    max-width:480px;
    min-height:520px;
    background:var(--card);
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    text-align:center;
}

.card-avatar{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #e3e3e3;
    margin-bottom:15px;
}

input[type="text"],
input[type="email"],
input[type="file"]{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    margin-top:5px;
    margin-bottom:12px;
}

.lbl{
    font-weight:600;
    margin-bottom:3px;
    display:block;
    text-align:left;
}

button{
    background:#b37fb6ff;
    color:white;
    padding:10px 18px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    width:100%;
    margin-top:10px;
}
button:hover{ background:#875c77ff; }

.success{
    color:green;
    font-weight:700;
    padding:8px;
    margin-bottom:15px;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="wrapper">
    <h1>Admin Profile</h1>

    <div class="card">

        <img src="uploads/<?php echo $_SESSION['admin']['image']; ?>" 
             class="card-avatar"
             id="profilePreview">

        <?php if ($success): ?>
            <div class="success" id="msg"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <label class="lbl">Profile Image</label>
            <input type="file" name="image" accept="image/*" onchange="previewImage(event)">

            <label class="lbl">Full Name</label>
            <input type="text" name="name" 
                   value="<?php echo $_SESSION['admin']['name']; ?>" required>

            <label class="lbl">Email</label>
            <input type="email" name="email" 
                   value="<?php echo $_SESSION['admin']['email']; ?>" required>

            <label class="lbl">Phone</label>
            <input type="text" name="phone" 
                   value="<?php echo $_SESSION['admin']['phone']; ?>" required>

            <button type="submit" name="update">Save Profile</button>
        </form>

    </div>
</div>

<script>
function previewImage(event){
    const fileURL = URL.createObjectURL(event.target.files[0]);
    document.getElementById("profilePreview").src = fileURL;

    const headerAvatar = document.querySelector("#headerAvatar img");
    if(headerAvatar){
        headerAvatar.src = fileURL;
    }
}

setTimeout(() => {
    let msg = document.getElementById("msg");
    if (msg) msg.style.display = "none";
}, 2000);
</script>

</body>
</html>
