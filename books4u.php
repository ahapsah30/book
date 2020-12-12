<!DOCTYPE html>
<html>
    
    
    
    <?php
    
    include("config.php");
    $table_name_post="posts";
    $table_name_artist="artist";
    $status=false;
    $postParam=false;
    
    if (isset($_GET["post_id"])) {
        
        $postId=validate($_GET['post_id']);
        $postId=mysql_real_escape_string($postId);
        $status=true;
        
    }
    
     if (isset($_GET["post_type"])) {
        
        $postType=validate($_GET['post_type']);
        $postType=mysql_real_escape_string($postType);
        $postParam=true;
        
    }
    
     if (isset($_GET["play_store"])) {
        
        $playStore=validate($_GET['play_store']);
        $playStore=mysql_real_escape_string($playStore);
        //$postParam=true;
        
    }
    
    //echo "Url = ".$playStore;
    
    if(!$status || !$postParam)
    return;
    
  if($postType="author"){
        $sel_qur_posts   = "select * from $table_name_artist where id = '$postId' ";
    }
    
    //echo "Query = ".$sel_qur_posts;
    //$sel_qur_posts   = "select * from $table_name_post where id = '$postId' ";
    $sel_run_posts   =  mysql_query($sel_qur_posts) OR die(mysql_error());
    $count_post=mysql_num_rows($sel_run_posts);
    
    if(!$sel_run_posts){
        
        $status=false;
        
    }
    
    if($count_post<=0)
       $status=false;
    
     if(!$status)
      return;
        
      if(isset($_SERVER['HTTPS'])){
             $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
      }
       else{
             $protocol = 'http';
       }        
        
     while ($sel_data_post  = mysql_fetch_array($sel_run_posts)) {

       $title = $sel_data_post['title'];
       $description = $sel_data_post['description'];
       $image = $protocol."://".$_SERVER['SERVER_NAME']."/comnews/admin/uploads/image/".$sel_data_post['pictureUrl'];

     }
     
     
            
    function validate($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars(strip_tags($data, ENT_QUOTES));
      return $data;
    }

    
    ?>
    

   <head>
      <title><?php echo $title ?></title>
      <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
    <!--<link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">

    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-fileupload.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>-->
   </head>
	
	
	<style>
        .centered-wrapper {
            width: 100%;
            height: 100%;
            bottom: 0px;
            top: 0px;
            left: 0;
            position: absolute;
           
        }
        .centered-wrapper:before {
            content: "";
            position: relative;
            display: inline-block;
            width: 100% ; height: 100%;
            vertical-align: middle;
        }
        .centered-content {
             
              width: 700px;
              height: 350px;
              position: absolute;
              left: 50%;
              top: 40%;
              transform: translate(-50%, -50%);
        }
   </style>
   
   	
   <body> <!--class="centered-wrapper"-->
       <div class="container w-25 p-3">
        <!--<div class="centered-content">-->
       
      <img src="<?php echo $image ?>" class="img-responsive" style="height:100% ; max-height : 40%" alt="Image" />
     
      <div class="w-25 p-3">
      <h1><?php echo $title ?></h1>
      </div>
      
      <?php 
      
        $dom = new DOMDocument;
        $dom->loadHTML($description);
        
        $elements = $dom->getElementsByTagName("img");
        foreach ($elements as $div) {
        /*$nodeDiv = $dom->createElement("div");
        $nodeDiv->setAttribute('style', 'text-align: center');*/
        
        $div->setAttribute('class', 'img-responsive');
        $div->setAttribute('style', 'width:100% ; max-width :70% ');
        $div->setAttribute('align', 'middle');
        $div->setAttribute('style', 'display: block;
          margin-left: auto;
          margin-right: auto;
          z-index: 1;');
        }
        $html = $dom->saveHTML();

      ?>
      
      
        <?php 
      
        //$dom = new DOMDocument;
        $dom->loadHTML($html);
        
        $elements = $dom->getElementsByTagName("iframe");
        foreach ($elements as $div) {
        $nodeDiv = $dom->createElement("div");
        $nodeDiv->setAttribute('style', 'embed-responsive embed-responsive-16by9');
        $nodeDiv->setAttribute('align', 'middle');
         
        $div->removeAttribute('height');
        $div->removeAttribute('width');
        //$div->setAttribute('width','70%');
        $div->setAttribute('class', 'embed-responsive-item');
        $div->setAttribute('style', 'display: block;
          margin-left: auto;
          margin-right: auto;
          z-index: 1;');
          
        $nodeDiv->appendChild($div);
        $dom ->appendChild($nodeDiv);
        }
        $html = $dom->saveHTML();

      ?>


          <p><?php echo $html ?></p>
      
      <p>For reading the books of specific Author , kindly <a href= <?php echo $playStore ?> >Install it from Playstore</a> </p>


   <!-- </div>-->
    </div>
   </body>
   
   </div>
	
</html>