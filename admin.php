<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard - LogoVerse</title>

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
            width: 90%;
            max-width: 900px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .cards {
            display: flex;
            gap: 25px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            width: 280px;
            padding: 30px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .button {
            display: block;
            margin-top: 20px;
            padding: 12px;
            background-color: #6c63ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

    </style>

    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<header>

    <div class="logo">LogoVerse Admin</div>

    <a href="logout.php" class="logout">Logout</a>

</header>

<div class="content">

    <div class="admin-hero">
        <h2>LogoVerse Control Center</h2>
        <p>Manage registered users and saved branding projects from one secure workspace.</p>
    </div>

    <h1>Welcome, Admin!</h1>

    <div class="cards">

        <div class="card">

            <div class="feature-icon">👥</div><h2>Manage Users</h2>

            <p>View registered users.</p>

            <a href="admin_users.php" class="button">
                View Users
            </a>

        </div>

        <div class="card">

            <div class="feature-icon">📁</div><h2>Manage Projects</h2>

            <p>View saved branding projects.</p>

            <a href="admin_projects.php" class="button">
                View Projects
            </a>

        </div>

    </div>

</div>

</body>

</html>