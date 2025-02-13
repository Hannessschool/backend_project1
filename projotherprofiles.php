<?php
session_start();
include 'projprofile.php';
include 'projdatabaseconnector.php';

//profiler från databasen
$sql = "SELECT id, username, bio from profiles";
$result = $conn->query($sql);

if (!$result)
{
    die("Error retrieving profiles: " . $conn->error);
}

//kolla om profilen existerar
if($result->num_rows > 0)
{
    $profiles = $result->fetch_all(MYSQLI_ASSOC);
}
else
{
    $profiles = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like']))
{
    $profileId = intval($_POST['like']);
    $sql = "UPDATE profiles SET like_count = like_count + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt = $bind_param("i", $profileId);
    
    if($stmt->execute())
    {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    else
    {
        print("Error updating like count");
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alla profiler</h1>
    <ul>
        <?php foreach ($profiles as $profile): ?>
        <li>
            <strong><?php print(htmlspecialchars($profile['username'])); ?></strong>
            <p><?php print(htmlspecialchars($profile['bio'])); ?></p>
            <button onclick="location.href='profile.php?id=<?php print($profile['id']); ?>'">Granska profilen</button>
        </li>
    <?php endforeach; ?>

    <?php if (empty($profiles)): ?>
        <p>Inga profiler hittades.</p>
    <?php endif; ?>
    </ul>
</body>
</html>


