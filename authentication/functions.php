<?php 


function isUserLoggedIn() {
  return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function redirectIfNotLoggedIn() {
    if (!isUserLoggedIn()) {
      header("Location: login.php");
      exit;
    }
  }
  


?>