<?php 

include('connection.php');

$value = $_GET['var1'];
$id = $_GET['var2'];

if ($value == 1) {
    $value = 0;
}
else{
    $value = 1;
}


      $update = "update comments set isEnable = '" .$value. "' where id = '".$id."'";
      $res = mysql_query($update);

        if(!$res)
        {
          echo mysql_error();
        }
        else
        {
          echo "<script>window.location.reload();</script>";
        }

?>

