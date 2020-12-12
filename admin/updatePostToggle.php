<?php 

include('connection.php');

$value = $_GET['var1'];
$id = $_GET['var2'];

if(isset($_GET['var3'])){
    $featured="featured";
}else{
    $featured="simple";
}

if ($value == 1) {  
    $value = 0;
}
else{
    $value = 1;
}

    if($featured=="featured"){
        
      $update = "update posts set isFeatured = '" .$value. "' where id = '".$id."'"; 
           
    }else{
        
       $update = "update posts set isEnable = '" .$value. "' where id = '".$id."'";    
       
    }
      
      //echo $update; 
      $res = mysql_query($update);

        if(!$res)
        {
          echo mysql_error();
        }
        else
        {
          session_start();
          $_SESSION['success-edit'] = 'success';
          echo $value;
           //echo "<script>window.location.reload();</script>";
          
            //header("location:posts.php");
            
        }

?>