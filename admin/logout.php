<?php
error_reporting(0);
  include('includes/connection.php');
  session_start();
  unset($_SESSION['RULE']);
  unset($_SESSION['IS_LOGIN']);
  header('Location: login.php');


?>