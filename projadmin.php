<?php
ALTER TABLE profiles ADD COLUMN role ENUM('user1', 'admin', 'manager', 'moderator') DEFAULT 'user';

$_SESSION['username'] = $username;
$_SESSION['role'] = $role; // 'admin' or 'user'

if ($_SESSION['role'] == 'admin') {
    // Show delete button
    print("<form method='POST' action='deleteProfile.php'>");
    print("<input type='hidden' name='profile_id' value='" . $profile['id'] . "' />");
    print("<button type='submit' name='delete_profile'>Delete Profile</button>");
    print("</form>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_profile'])) {
    if ($_SESSION['role'] == 'admin') {
        $profileId = $_POST['profile_id'];
        $sql = "DELETE FROM profiles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $profileId);
        if ($stmt->execute()) {
            print("Profilborttagning lyckades!");
        } else {
            print("Profilborttagning misslyckades.");
        }
    } else {
        print("You are not authorized to delete profiles.");
    }
}

if ($_SESSION['role'] == 'admin') {
    // Visa, acceptera eller ta bort kommentarer
    print("<form method='POST' action='moderateComment.php'>");
    print("<input type='hidden' name='comment_id' value='" . $comment['id'] . "' />");
    print("<button type='submit' name='action' value='approve'>Approve</button>");
    print("<button type='submit' name='action' value='delete'>Delete</button>");
    print("</form>");
}

//Admin dashboard
if ($_SESSION['role'] == 'admin') {
    print("<h1>Admin Dashboard</h1>");
    print("<h2>Hantera profiler</h2>");
    // Visa en lista av profiler med möjlighet att hantera eller ta bort
    print("<h2>Hantera kommentarer</h2>");
    // Visa en lista av kommentarer med möjlighet att hantera eller ta bort
} else {
    print("<p>Du har inte tillgång till denna sida.</p>");
}
?>
