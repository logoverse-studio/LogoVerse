<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM branding_projects ORDER BY project_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Projects - LogoVerse</title>

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

        .back {
            text-decoration: none;
            color: white;
            background-color: #6c63ff;
            padding: 10px 18px;
            border-radius: 6px;
        }

        .container {
            width: 95%;
            max-width: 1100px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #6c63ff;
            color: white;
        }

    </style>

    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<header>

    <div class="logo">LogoVerse Admin</div>

    <a href="admin.php" class="back">Admin Dashboard</a>

</header>

<div class="container">

    <h1>Manage Projects</h1>

    <table>

        <tr>
            <th>Project ID</th>
            <th>User ID</th>
            <th>Project Name</th>
            <th>Business Name</th>
            <th>Industry</th>
            <th>Style</th>
            <th>Color</th>
            <th>Created At</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($project = $result->fetch_assoc()) {

                echo "<tr>";

                echo "<td>" . htmlspecialchars($project["project_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["user_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["project_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["business_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["industry"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["style"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["color_preference"]) . "</td>";
                echo "<td>" . htmlspecialchars($project["created_at"]) . "</td>";

                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td colspan='8'>No projects found.</td>";
            echo "</tr>";

        }

        ?>

    </table>

</div>

</body>

</html>