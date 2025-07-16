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
        $data = [
            'all_reminders' => $reminder->all_reminders(),
            'user_with_most_reminders' => $reminder->user_with_most_reminders(),
            'get_login_counts' => $user->get_login_counts()
        ];

        $this->view('reports/index', $data);
    }
}