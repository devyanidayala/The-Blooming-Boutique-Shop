<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$admin = $_SESSION['admin'] ?? [
    "name" => "Admin",
    "email" => "",
    "phone" => "",
    "image" => ""   
];

$profileImg = $admin['image'] ?? "";

$firstLetter = strtoupper(substr($admin['name'], 0, 1));

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>

<style>
:root{
  --bg:#dccedeff;
  --card:#fff;
  --border:#e6e9ef;
  --muted:#6b7280;
  --accent:#b37fb6;
  font-family:Georgia;
}

*{box-sizing:border-box;}
body{
  margin:0;
  background:linear-gradient(180deg,#f4ecff 0%,var(--bg) 100%);
  min-height:100vh;
  color:#111;
}

header{
  background:var(--card);
  padding:14px 22px;
  border-bottom:1px solid var(--border);
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:18px;
  box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.profile{
  display:flex;
  align-items:center;
  gap:14px;
}

.avatar{
  width:42px;
  height:42px;
  border-radius:50%;
  overflow:hidden;
  background:linear-gradient(135deg,#f97316,#f43f5e);
  display:flex;
  justify-content:center;
  align-items:center;
  font-size:18px;
  font-weight:bold;
  color:white;
}

#headerAvatar img{
  width:100%;
  height:100%;
  object-fit:cover;
  border-radius:50%;
}

.profile-title{
  font-size:18px;
  font-weight:700;
}

nav{
  display:flex;
  align-items:center;
  gap:20px;
  font-size:17px;
  font-weight:600;
}

nav a{
  text-decoration:none;
  color:var(--muted);
  padding:6px 10px;
  border-radius:8px;
  transition:0.2s ease;
}

nav a:hover{
  color:var(--accent);
}

nav a.active{
  color:white;
  background: #d1aae1ff;
}

@media (max-width:650px){
  header{
    flex-direction:column;
    align-items:flex-start;
    padding:15px;
  }
  nav{
    flex-wrap:wrap;
    gap:10px;
  }
}
</style>
</head>

<body>

<header>
  <div class="profile">

      <div class="avatar" id="headerAvatar">
          <?php if(!empty($profileImg)): ?>
              <img src="uploads/<?= $profileImg ?>">
          <?php else: ?>
              <?= $firstLetter ?>
          <?php endif; ?>
      </div>

      <div class="profile-title">
          The Blooming Boutique Shop Admin
      </div>

  </div>

  <nav>
      <a href="dashboard.php" class="<?= $currentPage=='dashboard.php'?'active':'' ?>">Dashboard</a>
      <a href="admins.php" class="<?= $currentPage=='admins.php'?'active':'' ?>">Admin</a>
      <a href="products.php" class="<?= $currentPage=='products.php'?'active':'' ?>">Products</a>
      <a href="orders.php" class="<?= $currentPage=='orders.php'?'active':'' ?>">Orders</a>
      <a href="messages.php" class="<?= $currentPage=='messages.php'?'active':'' ?>">Messages</a>
      <a href="logout.php">Logout</a>
  </nav>

</header>
