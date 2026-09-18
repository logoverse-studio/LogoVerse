<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if (!isset($_GET["id"])) {
    header("Location: my_projects.php");
    exit();
}

$project_id = $_GET["id"];

$sql = "SELECT * FROM branding_projects
        WHERE project_id = ? AND user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $project_id, $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: my_projects.php");
    exit();
}

$project = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $business = trim($_POST["business_name"]);
    $industry = trim($_POST["industry"]);
    $style = trim($_POST["style"]);
    $color = trim($_POST["color"]);

    $project_name = $business . " Branding";

    $sql = "UPDATE branding_projects
            SET project_name = ?,
                business_name = ?,
                industry = ?,
                style = ?,
                color_preference = ?
            WHERE project_id = ? AND user_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssii",
        $project_name,
        $business,
        $industry,
        $style,
        $color,
        $project_id,
        $user_id
    );

    if ($stmt->execute()) {
        header("Location: my_projects.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Project - LogoVerse</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f7ff;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 6px;
            background-color: #6c63ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #6c63ff;
        }

    </style>

    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<div class="container">

    <h1>Edit Project</h1>

    <form method="POST">

        <label>Business Name</label>

        <input
            type="text"
            name="business_name"
            value="<?php echo htmlspecialchars($project["business_name"]); ?>"
            required
        >

        <label>Industry</label>

        <input
            type="text"
            name="industry"
            value="<?php echo htmlspecialchars($project["industry"]); ?>"
            required
        >

        <label>Preferred Style</label>

        <select name="style" required>

            <option value="Modern"
                <?php if ($project["style"] == "Modern") echo "selected"; ?>>
                Modern
            </option>

            <option value="Minimal"
                <?php if ($project["style"] == "Minimal") echo "selected"; ?>>
                Minimal
            </option>

            <option value="Professional"
                <?php if ($project["style"] == "Professional") echo "selected"; ?>>
                Professional
            </option>

            <option value="Creative"
                <?php if ($project["style"] == "Creative") echo "selected"; ?>>
                Creative
            </option>

        </select>

        <label>Color Preference</label>

        <input
            type="text"
            name="color"
            value="<?php echo htmlspecialchars($project["color_preference"]); ?>"
        >

        <button type="submit">
            Update Project
        </button>

    </form>

    <a href="my_projects.php" class="back">
        Back to My Projects
    </a>

</div>

</body>

</html>