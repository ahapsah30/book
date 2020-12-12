<?php
session_start();

include('connection.php');

    if($_POST)
    {
      $pass = $_POST['pass'];

      $update = "update admin set password = '$pass' where id = '".$_SESSION['uid']."'";
      $res = mysql_query($update);

        if(!$res)
        {
          echo mysql_error();
        }
        else
        {
          session_start();
          $_SESSION['success'] = 'success';
          header("location:admin-profile.php");
        }
    }