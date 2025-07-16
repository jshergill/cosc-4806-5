<?php
class Reports extends Controller {
    public function index() {
        if (!isset($_SESSION['auth'])) {
            $_SESSION['error'] = "Access denied.";
            header("Location: /home");
            exit;
        }
        $reminder = $this->model('Reminder');
        $user = $this->model('User');
    }
}