<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
include "db.php";

$user_id = $_SESSION["user_id"];

$sql = "SELECT COUNT(*) AS total FROM branding_projects WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$total_projects = $row["total"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - LogoVerse</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f7ff;
        }

        header {
            background-color: white;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .logout {
            text-decoration: none;
            color: white;
            background-color: #6c63ff;
            padding: 10px 18px;
            border-radius: 6px;
        }

        .content {
            text-align: center;
            padding: 60px 20px;
        }

        h1 {
            font-size: 40px;
        }

        .card {
            background-color: white;
            width: 350px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .button {
            display: block;
            text-decoration: none;
            color: white;
            background-color: #6c63ff;
            padding: 13px;
            margin: 15px 0;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            opacity: 0.9;
        }
    </style>
    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<header>

    <div class="logo">LogoVerse</div>

    <a href="logout.php" class="logout">Logout</a>

</header>

<div class="content">

    <div class="studio-banner">
        <h2>Welcome to your Brand Studio</h2>
        <p>Create, save, refine and present your visual identity from one workspace.</p>
    </div>

    <div class="stat-grid">
        <div class="stat"><small>Saved Projects</small><strong><?php echo $total_projects; ?></strong></div>
        <div class="stat"><small>Brand Assets</small><strong>4+</strong></div>
        <div class="stat"><small>Workspace</small><strong>Ready</strong></div>
    </div>

    <h1>
        Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!
    </h1>

    <div class="card">

        <h2>Branding Dashboard</h2>

        <p>Create and manage your brand identity.</p>
        <p>
    You have
    <b><?php echo $total_projects; ?></b>
    saved project(s).
</p>

        <a href="generator.php" class="button">
            🎨 Create Branding
        </a>

        <a href="my_projects.php" class="button">
            📁 My Projects
        </a>

    </div>

</div>

</body>
</html>