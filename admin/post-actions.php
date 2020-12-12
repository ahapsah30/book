<?php   

 session_start();
  if(empty($_SESSION['uid']))
  {
    header("location:login.php");
  }


include('connection.php');


    if(isset($_POST['post_insert']))
    {   
      
      $post_title = mysql_real_escape_string($_POST['post_title']);
      $post_desc  = mysql_real_escape_string($_POST['post_desc']);
      $catType    = $_POST['catType'];
      $postType   = $_POST['postType'];
      $artist = $_POST['artist'];
      $postTags = $_POST['post_tags'];
      $streamUrl = $_POST['file_link'];
     /*
      $webUrl = $_POST['web_url'];
      $fbUrl = $_POST['fb_url'];
      $twitterUrl = $_POST['twitter_url'];*/
      

      $filenameImg = $_FILES['postImgFile']['name'];
      $file = $_FILES['postImgFile']['tmp_name']; 
      $sourceProperties = getimagesize($file);
      $fileNewName = pathinfo($_FILES['postImgFile']['name'], PATHINFO_FILENAME);
      $folderPath = "uploads/image/";
      $ext = pathinfo($_FILES['postImgFile']['name'], PATHINFO_EXTENSION);
      $imageType = $sourceProperties[2];

            switch ($imageType) {
            
              case IMAGETYPE_PNG:
                  $imageResourceId = imagecreatefrompng($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              case IMAGETYPE_GIF:
                  $imageResourceId = imagecreatefromgif($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              case IMAGETYPE_JPEG:
                  $imageResourceId = imagecreatefromjpeg($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              default:
                  echo "Invalid Image type.";
                  exit;
                  break;
          }

      move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);



      $folderVideo = "uploads/video/";
      $filenameVideo = $_FILES['postVideoFile']['name'];
      $targetVideo = $folderVideo.$filenameVideo;
      move_uploaded_file($_FILES['postVideoFile']['tmp_name'] , $targetVideo);

      
      if (!empty($filenameImg) && empty($filenameVideo)) {

        //$query = "insert into posts (cat_id, title, description, postType, coverUrl, originalUrl,artist_id,tags,streamUrl,fbUrl,twitterUrl,webUrl) VALUES ('".$catType."', '".$post_title."', '".$post_desc."', '".$postType."', '".$fileNewName. "_thump.".$ext."', '".$filenameImg."' , '".$artist."' ,  '".$postTags."' ,  '".$streamUrl."' ,  '".$fbUrl."' ,  '".$twitterUrl."' ,  '".$webUrl."')";
        $query = "insert into posts (cat_id, title, description, postType, coverUrl, originalUrl,artist_id,tags,streamUrl) VALUES ('".$catType."', '".$post_title."', '".$post_desc."', '".$postType."', '".$fileNewName. "_thump.".$ext."', '".$filenameImg."' , '".$artist."' ,  '".$postTags."' ,  '".$streamUrl."')";
        $run = mysql_query($query) OR die(mysql_error());

          if ($run) {

            session_start();
            $_SESSION['success-insert'] = 'success';
            header("location:posts.php");

          }

      }
      else if (!empty($filenameVideo) && !empty($filenameImg)) {

         $query_insert = "insert into posts (cat_id, title, description, postType, coverUrl, originalUrl, streamUrl,artist_id,tags) VALUES ('".$catType."', '".$post_title."', '".$post_desc."', '".$postType."', '".$fileNewName. "_thump.".$ext."', '".$filenameImg."', '".$filenameVideo."', '".$artist."' ,  '".$postTags."' )";
         echo $query_insert;  
         $run_insert = mysql_query($query_insert) OR die(mysql_error()) ;

          if ($run_insert) {

            session_start();
            $_SESSION['success-insert'] = 'success';
            header("location:posts.php");

          }

      }


    }





    else if (isset($_POST['post_edit'])) {
     
      $post_title = mysql_real_escape_string($_POST['post_title']);
      $post_desc  = mysql_real_escape_string($_POST['post_desc']);
      $catType    = $_POST['catType'];
      $postType   = $_POST['postType'];
      $id         = $_GET['id'];
      $artist = $_POST['artist'];
      $postTags = $_POST['post_tags'];
       $streamUrl = $_POST['file_link'];
     /*
      $webUrl = $_POST['web_url'];
      $fbUrl = $_POST['fb_url'];
      $twitterUrl = $_POST['twitter_url'];*/

      $filenameImg = $_FILES['postImgFile']['name'];
    

      if (!empty($filenameImg)) {
      
        $file = $_FILES['postImgFile']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = pathinfo($_FILES['postImgFile']['name'], PATHINFO_FILENAME);
        $folderPath = "uploads/image/";
        $ext = pathinfo($_FILES['postImgFile']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];

            switch ($imageType) {
            
              case IMAGETYPE_PNG:
                  $imageResourceId = imagecreatefrompng($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              case IMAGETYPE_GIF:
                  $imageResourceId = imagecreatefromgif($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              case IMAGETYPE_JPEG:
                  $imageResourceId = imagecreatefromjpeg($file); 
                  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                  imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                  break;

              default:
                  echo "Invalid Image type.";
                  exit;
                  break;
          }

        move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);

      }



        $filenameVideo = $_FILES['postVideoFile']['name'];
        $folderVideo = "uploads/video/";        
        $targetVideo = $folderVideo.$filenameVideo;
        move_uploaded_file($_FILES['postVideoFile']['tmp_name'] , $targetVideo);
        
        
      


// **********----------------------------------------**********
// DIFFERENT CONDITONS 
// **********----------------------------------------**********


      if (empty($filenameImg) && empty($filenameVideo)) {

        //$update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."' ,  fbUrl = '".$fbUrl."' ,  twitterUrl = '".$twitterUrl."' ,  webUrl = '".$webUrl."' where id = '".$id."'";
        $update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."' , streamUrl = '".$streamUrl."' where id = '".$id."'";
        $run = mysql_query($update);

          if ($run) {

            session_start();
            $_SESSION['success-edit'] = 'success';
            header("location:posts.php");

          }

      }



      if (!empty($filenameImg) && empty($filenameVideo)) {

        //$update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."', coverUrl = '".$fileNewName. "_thump.".$ext."', originalUrl = '".$filenameImg."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."'  where id = '".$id."'";
        $update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."', coverUrl = '".$fileNewName. "_thump.".$ext."', originalUrl = '".$filenameImg."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."'  , streamUrl = '".$streamUrl."' where id = '".$id."'";

        $run = mysql_query($update);

          if ($run) {

            session_start();
            $_SESSION['success-insert'] = 'success';
            header("location:posts.php");

          }

      }




      if (!empty($filenameVideo) && empty($filenameImg)) {

        //$update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."', streamUrl = '".$filenameVideo."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."'  where id = '".$id."'";
        $update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."', streamUrl = '".$filenameVideo."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."'  where id = '".$id."'";
         $run = mysql_query($update);
         

          if ($run) {

            session_start();
            $_SESSION['success-insert'] = 'success';
            header("location:posts.php");

          }

      }
      



      if (!empty($filenameVideo) && !empty($filenameImg)) {

        $update = "update posts set title = '".$post_title."', description = '".$post_desc."', cat_id = '".$catType."', postType = '".$postType."', coverUrl = '".$fileNewName. "_thump.".$ext."', originalUrl = '".$filenameImg."', streamUrl = '".$filenameVideo."' ,  artist_id = '".$artist."' ,  tags = '".$postTags."'  where id = '".$id."'";
        //echo $update;
         $run = mysql_query($update);

          if ($run) {

            session_start();
            $_SESSION['success-insert'] = 'success';
            header("location:posts.php");

          }

      }



    }


    else{

      $id = $_GET['id'];
      
      $delete = "delete from posts where id = '".$id."'";
      $res = mysql_query($delete);

        if(!$res)
        {
          echo mysql_error();
        }
        else
        {
          session_start();
          $_SESSION['success-del'] = 'success';
          header("location:posts.php");
        }
    }









function imageResize($imageResourceId,$width,$height) {

  $targetWidth = $width * 0.4;
  $targetHeight = $height * 0.4;


  $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
  //$targetLayer=imagecropauto($targetLayer , IMG_CROP_DEFAULT);
  imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);

  return $targetLayer;
}