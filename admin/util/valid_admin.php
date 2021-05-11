<?php
  function check_valid_admin() {
    return isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin'] == true;
  }
?>