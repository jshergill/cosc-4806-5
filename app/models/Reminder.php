<?php

class Reminder {

    public function __construct() {}


    public function all_reminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM Reminders;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function create_reminder($subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO Reminders (user_id, subject, created_at) VALUES (27, :subject, NOW())");
        $stmt->bindValue(':subject', $subject);
        return $stmt->execute();
    }
    public function reminder_by_id($ID) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM Reminders WHERE ID = :ID AND user_id = 27");
        $stmt->bindValue(':ID', $ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update_reminder($ID, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE Reminders SET subject = :subject WHERE ID = :ID AND user_id = 27");
        $stmt->bindValue(':subject', $subject);
        $stmt->bindValue(':ID', $ID);
        return $stmt->execute();
    }
    public function delete_reminder($ID) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM Reminders WHERE ID = :ID AND user_id = 27");
        $stmt->bindValue(':ID', $ID);
        return $stmt->execute();
    }
}