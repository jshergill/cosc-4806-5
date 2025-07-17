<?php
class Reminders extends Controller {

    public function index() {
        $model = $this->model('Reminder');
        $list  = $model->all_reminders(); 
        $this->view('reminders/index', ['reminders' => $list]);
    }

    public function create() {
        $model = $this->model('Reminder');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            if ($subject !== '') {
                $model->create_reminder($subject);
                $_SESSION['success'] = "Reminder created.";
            }
            header('Location: /reminders');
            exit;
        }
        $this->view('reminders/create');
    }

    public function update($id) {
        $model = $this->model('Reminder');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            if ($subject !== '') {
                $model->update_reminder($id, $subject);
                $_SESSION['success'] = "Reminder updated.";
            }
            header('Location: /reminders');
            exit;
        }
        $rec = $model->reminder_by_id($id);
        $this->view('reminders/update', ['reminder' => $rec]);
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->model('Reminder');
            $model->delete_reminder($id);
            $_SESSION['success'] = "Reminder deleted.";
            header('Location: /reminders');
            exit;
        }
        // If someone GETs /reminders/delete/ID, just bounce.
        header('Location: /reminders');
        exit;
    }
}
