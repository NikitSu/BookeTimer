<?php

$telegramId = filter_var($_POST['telegramId'], FILTER_VALIDATE_INT);
if ($telegramId === false) {
    die(json_encode(['error' => 'Invalid Telegram ID']));
}

$conn = new SQLite3("usersId.db");

if (!$conn) {
    die(json_encode(['error' => "Connection failed"]));
} else {
    $stmt = $conn->prepare("INSERT INTO Ids (telegramUserId) VALUES (:id)");
    $stmt->bindValue(':id', $telegramId, SQLITE3_INTEGER);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => 'User added successfully']);
    } else {
        echo json_encode(['error' => 'Failed to add user']);
    }
    
    $conn->close();
}
?>