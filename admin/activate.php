<?php
  session_start();
	include 'dbconnect.php';

  function activate($userId) {
    mysqli_query($conn, "UPDATE login SET requestpartner=0, role='Partner' WHERE userid={$userId}");
  }
?>