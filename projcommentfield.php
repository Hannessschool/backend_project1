<?php
$commentFile = "comments.txt";

if (isset($_POST['submit_comment']) && !empty($_POST['comment'])) {
    if (!isset($_SESSION['username'])) {
        print("Du måste vara inloggad för att kommentera.");
    } else {
        $username = $_SESSION['username'];
        $timestamp = date("d-m-Y H:i:s");
        $comment = trim($_POST['comment']);

        // Escape any dangerous characters
        $safeComment = htmlspecialchars($comment);

        // Create the comment entry
        $newEntry = "$username | $timestamp | $safeComment" . PHP_EOL;

        // Prepend to ensure newest comments come first
        if (file_exists($commentFile)) {
            $oldContent = file_get_contents($commentFile);
            file_put_contents($commentFile, $newEntry . $oldContent);
        } else {
            file_put_contents($commentFile, $newEntry);
        }

        print("Din kommentar har sparats!");
    }
}

// Display existing comments
if (file_exists($commentFile)) {
    $comments = file($commentFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    print("<h3>Tidigare kommentarer:</h3>");
    print("<ul>");
    foreach ($comments as $entry) {
        list($user, $time, $msg) = explode(" | ", $entry, 3);
        print("<li><strong>$user</strong> ($time): $msg</li>");
    }
    print("</ul>");
} else {
    print("<p>Inga kommentarer än.</p>");
}
?>
