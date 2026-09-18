<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$sql = "SELECT user_id, name, email, role FROM users ORDER BY user_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Users - LogoVerse</title>

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
            width: 90%;
            max-width: 1000px;
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
            padding: 15px;
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

    <h1>Manage Users</h1>

    <table>

        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($user = $result->fetch_assoc()) {

                echo "<tr>";

                echo "<td>" . htmlspecialchars($user["user_id"]) . "</td>";

                echo "<td>" . htmlspecialchars($user["name"]) . "</td>";

                echo "<td>" . htmlspecialchars($user["email"]) . "</td>";

                echo "<td>" . htmlspecialchars($user["role"]) . "</td>";

                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td colspan='4'>No users found.</td>";
            echo "</tr>";

        }

        ?>

    </table>

</div>

</body>

</html>