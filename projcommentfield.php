<?php
$commentFile = "comments.txt"; // Fil för att lagra kommentarer

// Kontrollera om kommentarsformuläret har skickats och om kommentaren inte är tom
if (isset($_POST['submit_comment']) && !empty($_POST['comment'])) {
    // Kontrollera om användaren är inloggad
    if (!isset($_SESSION['username'])) {
        print("Du måste vara inloggad för att kommentera."); // Meddelande om användaren inte är inloggad
    } else {
        $username = $_SESSION['username']; // Hämta användarnamnet från sessionen
        $timestamp = date("d-m-Y H:i:s"); // Hämta aktuell tid och datum
        $comment = trim($_POST['comment']); // Rensa kommentaren från onödiga mellanslag

        // Rensa bort farliga tecken
        $safeComment = htmlspecialchars($comment);

        // Skapa kommentarsinlägget
        $newEntry = "$username | $timestamp | $safeComment" . PHP_EOL;

        // Lägg till kommentaren överst i filen för att visa de senaste kommentarerna först
        if (file_exists($commentFile)) {
            $oldContent = file_get_contents($commentFile);
            file_put_contents($commentFile, $newEntry . $oldContent);
        } else {
            file_put_contents($commentFile, $newEntry);
        }

        print("Din kommentar har sparats!"); // Meddelande om kommentaren har sparats
    }
}

// Visa befintliga kommentarer
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
    print("<p>Inga kommentarer än.</p>"); // Meddelande om inga kommentarer finns
}
?>

