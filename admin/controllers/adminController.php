<?php
  session_start();
  // require_once('../../models/database.php');
  // require_once('../models/admin_db.php');
  // require_once('../util/valid_register.php');
  $success = false;
  $action = filter_input(INPUT_POST, 'action');
  if($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if($action == NULL) {
      $action = 'show_login';
    }
  }
  

  switch($action) {
    case 'login':
      $username = filter_input(INPUT_POST, 'username');
      $password = filter_input(INPUT_POST, 'password');

      $loggedIn = is_valid_admin_login($username, $password);
      if($loggedIn) {
        print("this");
        $_SESSION['is_valid_admin'] = true;
        header("Location: .?action=view_page");
        
      }else {
        $login_message = "The username or password provided is incorrect. \nPlease try again.";
        // header('Location: .?action=show_login');
        include('./views/login.php');
        // $action = 'show_login';
      }
      break;
    case 'show_login':
      include('./views/login.php');
      break;
    case 'register':
      $username = filter_input(INPUT_POST, 'username');
      $password = filter_input(INPUT_POST, 'password');
      $confirmPW = filter_input(INPUT_POST, 'confirm_pwd');

      $errors = valid_registration($username, $password, $confirmPW);
      if (username_exists($username)) {
        array_push($errors, "The username you entered is already taken.");
      }
      if(!empty($errors)) {
        add_admin($username, $password);
      }
      include('./views/register.php');
      break;
    case 'show_register':
      include('./views/register.php');
      break;
    case 'logout':
      $firstName = $_SESSION['userid'];
      unset($_SESSION['is_valid_admin']);
      session_destroy();
      $name = session_name();
      $expire = strtotime('-1 year');
      $params = session_get_cookie_params();
      $path = $params['path'];
      $domain = $params['domain'];
      $secure = $params['secure'];
      $httponly = $params['httponly'];
      setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
      header('Location: .?action=show_login');
      break;
    default:
    break;
  }
?>