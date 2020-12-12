<?php   

 session_start();
  if(empty($_SESSION['uid']))
  {
    header("location:login.php");
  }


include('connection.php');

    if(isset($_POST['cat_insert']))
    {   
      
      $cat_title = mysql_real_escape_string($_POST['cat_title']);
      $artist_bio = mysql_real_escape_string($_POST['artist_bio']);
      $filenameImg = $_FILES['catImgFile']['name'];
      $file = $_FILES['catImgFile']['tmp_name']; 
      $sourceProperties = getimagesize($file);
      $fileNewName = pathinfo($_FILES['catImgFile']['name'], PATHINFO_FILENAME);
      $folderPath = "uploads/image/";
      $ext = pathinfo($_FILES['catImgFile']['name'], PATHINFO_EXTENSION);
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

      $query = "insert into artist (title, pictureUrl,description) VALUES ('".$cat_title."', '".$fileNewName. ".".$ext."','".$artist_bio."')";  //_thump
      $run = mysql_query($query);

        if ($run) {

          session_start();
          $_SESSION['success-insert'] = 'success';
          header("location:artist.php");

        }

    }


    else if (isset($_POST['cat_edit'])) {
     
      $cat_title = mysql_real_escape_string($_POST['cat_title']);
      $artist_bio = mysql_real_escape_string($_POST['artist_bio']);
      $id = $_GET['id'];


      $filenameImg = $_FILES['catImgFile']['name'];
    

      if (!empty($filenameImg)) {
      
        $file = $_FILES['catImgFile']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = pathinfo($_FILES['catImgFile']['name'], PATHINFO_FILENAME);
        $folderPath = "uploads/image/";
        $ext = pathinfo($_FILES['catImgFile']['name'], PATHINFO_EXTENSION);
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



        if (empty($filenameImg)) {

          $update = "update artist set title = '".$cat_title."' , description ='".$artist_bio."' where id = '".$id."'";

          $run = mysql_query($update);

            if ($run) {

              session_start();
              $_SESSION['success-edit'] = 'success';
              header("location:artist.php");

            }

        }


        elseif (!empty($filenameImg)) {

          $update = "update artist set title = '".$cat_title."', pictureUrl = '".$fileNewName. ".".$ext."' , description ='".$artist_bio."' where id = '".$id."'";  //_thump

          $run = mysql_query($update);

            if ($run) {

              session_start();
              $_SESSION['success-insert'] = 'success';
              header("location:artist.php");

            }

        }


    }


    else{

      $id = $_GET['id'];
      
      $delete = "delete from artist where id = '".$id."'";
      $res = mysql_query($delete);

        if(!$res)
        {
          echo mysql_error();
        }
        else
        {
          session_start();
          $_SESSION['success-del'] = 'success';
          header("location:artist.php");
        }
    }



function imageResize($imageResourceId,$width,$height) {

  //$targetWidth =350;
  //$targetHeight =350;
  
  $targetWidth =$width;
  $targetHeight =$height;


  $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
  imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);

  return $targetLayer;
}