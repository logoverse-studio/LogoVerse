<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM branding_projects WHERE user_id = ? ORDER BY project_id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Projects - LogoVerse</title>

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

        .projects {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: white;
            width: 260px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin-top: 0;
        }

        .card p {
            color: #555;
        }

        .empty {
            text-align: center;
            color: #666;
        }

    </style>

    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<header>

    <div class="logo">LogoVerse</div>

    <a href="dashboard.php" class="back">Dashboard</a>

</header>

<div class="container">

   <h1>
    My Saved Projects
    (<?php echo $result->num_rows; ?>)
</h1>

    <div class="projects">

        <?php

        if ($result->num_rows > 0) {

            while ($project = $result->fetch_assoc()) {

                echo "<div class='card'>";

                echo "<h2>" . htmlspecialchars($project["project_name"]) . "</h2>";

                echo "<p><b>Business:</b> " .
                     htmlspecialchars($project["business_name"]) .
                     "</p>";

                echo "<p><b>Industry:</b> " .
                     htmlspecialchars($project["industry"]) .
                     "</p>";

                echo "<p><b>Style:</b> " .
                     htmlspecialchars($project["style"]) .
                     "</p>";

                echo "<p><b>Color:</b> " .
                     htmlspecialchars($project["color_preference"]) .
                     "</p>";
echo "<p><b>Created:</b> " .
     htmlspecialchars($project["created_at"]) .
     "</p>";
echo "<a href='edit_project.php?id=" . $project["project_id"] . "'
      style='
          display:block;
          margin-top:15px;
          padding:10px;
          background:#6c63ff;
          color:white;
          text-decoration:none;
          border-radius:6px;
      '>
      Edit Project
      </a>";
echo "<a href='delete_project.php?id=" . $project["project_id"] . "'
      style='
          display:block;
          margin-top:15px;
          padding:10px;
          background:#e74c3c;
          color:white;
          text-decoration:none;
          border-radius:6px;
      '>
      Delete Project
      </a>";
               
                    

                echo "</div>";
            }

        } else {

            echo "<p class='empty'>No saved projects yet.</p>";

        }

        ?>

    </div>

</div>

</body>

</html>