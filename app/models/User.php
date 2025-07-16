<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$username = strtolower($username);
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);
			header('Location: /reminders');
			die;
		} else {
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
			} else {
				$_SESSION['failedAuth'] = 1;
			}
			header('Location: /login');
			die;
		}
    }
  private function logAttempt($username, $status) {
  $db = db_connect();
  $stmt = $db->prepare("INSERT INTO logins (username, attempt) VALUES (:username, :attempt)");
  $stmt->bindValue(':username', $username);
  $stmt->bindValue(':attempt', $status === 'success' ? 1 : 0, PDO::PARAM_INT);
  $stmt->execute();
  }
  public function get_login_counts() {
          $db = db_connect();
          $stmt = $db->prepare("
              SELECT username, COUNT(*) AS total 
              FROM logins
              GROUP BY username;
          ");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

  }

