<?php

class Reminder {

    public function __construct() {}


    public function all_reminders() {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT ID AS id, user_id, subject, created_at, completed
            FROM Reminders
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ");
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function user_with_most_reminders() {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT username, COUNT(*) as total 
            FROM Reminders 
            JOIN users ON Reminders.user_id = users.ID 
            GROUP BY user_id 
            ORDER BY total DESC 
            LIMIT 1;
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function user_id_with_most_reminders() {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT user_id, COUNT(*) as total 
            FROM Reminders 
            JOIN users ON Reminders.user_id = users.ID 
            GROUP BY user_id 
            ORDER BY total DESC 
            LIMIT 1;
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create_reminder($subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO Reminders (user_id, subject, created_at) VALUES (:user_id, :subject, NOW())");
         $stmt->bindValue(':user_id', $_SESSION['user_id']); 
        $stmt->bindValue(':subject', $subject);
        return $stmt->execute();
    }
    public function reminder_by_id($id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM Reminders WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user_id', $_SESSION['user_id']); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update_reminder($id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE Reminders SET subject = :subject WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':subject', $subject);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user_id', $_SESSION['user_id']); 
        return $stmt->execute();
    }
    public function delete_reminder($id) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM Reminders WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user_id', $_SESSION['user_id']); 
        return $stmt->execute();
    }
}