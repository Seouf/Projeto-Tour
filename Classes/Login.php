<?php

class User {
  private $username;


  public function __construct($username) {
    $this->username = $username;

  }

  public function login() {
    session_start();
    $_SESSION['username'] = $this->username;
  }

  public static function isLoggedIn() {
    session_start();
    return isset($_SESSION['username']);
  }

  public static function logout() {
    session_start();
    session_unset();
    session_destroy();
  }
  public static function DbByUsername($username) {
    $db = New Database("localhost", "projetotour", "root", "");
    $query = $db->instance->prepare('SELECT user_password_digest FROM users WHERE user_name = :username');
    $query->execute([':username' => $username]);
    $DbHash = $query->fetch(PDO::FETCH_ASSOC);

    if ($DbHash) {
      return $DbHash;
    } else {
      return null; // User not found
    }
  }
}
?>