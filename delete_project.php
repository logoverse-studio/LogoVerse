<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {

    $project_id = $_GET["id"];
    $user_id = $_SESSION["user_id"];

    $sql = "DELETE FROM branding_projects
            WHERE project_id = ? AND user_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ii", $project_id, $user_id);

    $stmt->execute();
}

header("Location: my_projects.php");
exit();

?>