<?php

  $posts_edit = "posts-edit";


include('header.php');

?>

  <script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=571ma62fmefzor3lwwwbkn9khs0chpwyvjru2hqe0szdkwi0'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea'
  });
  </script>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header category-header">

           <?php

            include('header-bar.php');

            ?> 


        </header><!-- /header -->
        <!-- Header-->


      <?php 

        if (!empty($_SESSION['success-insert'])) {
          ?>
            <div class="center">
              <div class="myAlert-top alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                <strong>Successfully!</strong> Post is added. 
              </div>
            </div>
          <?php
          unset($_SESSION['success-insert']);
        }
        elseif (!empty($_SESSION['success-edit'])) {
          ?>
            <div class="center">
              <div class="myAlert-top alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                <strong>Successfully!</strong> Post is updated. 
              </div>
            </div>
          <?php
          unset($_SESSION['success-edit']);
        }
        elseif (!empty($_SESSION['success-del'])) {
          ?>
            <div class="center">
              <div class="myAlert-top alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                <strong>Successfully!</strong> Post is deleted. 
              </div>
            </div>
          <?php
          unset($_SESSION['success-del']);
        }


       $id = $_GET['id'];

         $sel_qur = "select * from posts where id = '" . $id . "'";
        $sel_run = mysql_query($sel_qur);
        $sel_data = mysql_fetch_array($sel_run);

          $sel_qur_specific_cat = "select * from category where id = '" . $sel_data['cat_id'] . "'";
          $sel_run_specific_cat = mysql_query($sel_qur_specific_cat);
          $sel_data_specific_cat = mysql_fetch_array($sel_run_specific_cat);
          
          
          $sel_qur_specific_artist = "select * from artist where id = '" . $sel_data['artist_id'] . "'";
          $sel_run_specific_artist = mysql_query($sel_qur_specific_artist);
          $sel_data_specific_artist = mysql_fetch_array($sel_run_specific_artist);


      ?>




        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
                
              <div class="card">
                <div class="card-body cat-card-body">
                  <form role="form" method="post" action="featured-actions.php?id=<?php echo $id ?>" enctype="multipart/form-data">

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="post_title" placeholder="Enter post title..." class="form-control" value="<?php echo $sel_data['title']; ?>" required>
                      </div>
                    </div>

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <textarea id="mytextarea" name="post_desc"><?php echo $sel_data['description']; ?></textarea>
                      </div>
                    </div>
                    
                    <!--For entering post tags-->
                  
                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="post_tags" placeholder="Enter post tags..." class="form-control" value="<?php echo $sel_data['tags']; ?>" required>
                      </div>
                    </div>
                    
                    
                    <!--For Stream Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="stream_url" placeholder="Enter stream url..." class="form-control" value="<?php echo $sel_data['streamUrl']; ?>" required>
                      </div>
                    </div>-->
                    
                     <!--For Web Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="web_url" placeholder="Enter Web url..." class="form-control" value="<?php echo $sel_data['webUrl']; ?>" >
                      </div>
                    </div>-->
                    
                    
                    <!--For Fb Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="fb_url" placeholder="Enter Facebook url..." class="form-control" value="<?php echo $sel_data['fbUrl']; ?>" >
                      </div>
                    </div>-->
                    
                    
                    <!--For Twitter Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="twitter_url" placeholder="Enter Twitter url..." class="form-control"  value="<?php echo $sel_data['twitterUrl']; ?>" >
                      </div>
                    </div>-->

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <select class="form-control" name="catType" required>
                          <option selected value="<?php echo $sel_data_specific_cat['id'] ?>"><?php echo $sel_data_specific_cat['title']; ?></option>
                          <option disabled="disabled">--------</option>
<?php 

$sel_qur_cat = "select * from category";
$sel_run_cat = mysql_query($sel_qur_cat);

while($sel_data_cat = mysql_fetch_array($sel_run_cat)) {  

?>
                          <option value="<?php echo $sel_data_cat['id'] ?>"><?php echo $sel_data_cat['title'] ?></option>

<?php } ?>

                      </select>
                    </div>
                  </div>
                  
                  
                  
                  <!--For the selection of Artist-->
                  
                  <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <select class="form-control" name="artist" required>
                          <option selected value="<?php echo $sel_data_specific_artist['id'] ?>"><?php echo $sel_data_specific_artist['title']; ?></option>
                          <option disabled="disabled">--------</option>
<?php 

$sel_qur_artist = "select * from artist";
$sel_run_artist = mysql_query($sel_qur_artist);

while($sel_data_artist = mysql_fetch_array($sel_run_artist)) {  

?>
                          <option value="<?php echo $sel_data_artist['id'] ?>"><?php echo $sel_data_artist['title'] ?></option>

<?php } ?>

                      </select>
                    </div>
                  </div>
                  

                  <div class="row form-group category-table">
                    <div class="col col-12 col-sm-7">
                      <select class="form-control" name="postType" required onchange="ifYesFor(this);">
                        <option value="<?php echo $sel_data['postType'] ?>"><?php echo $sel_data['postType'] ?></option>
                        <option disabled="disabled">--------</option>
                        <option value="file">File</option>
                        <option value="link">Link</option>
                      </select> 
                    </div>
                  </div>
                  
                  
                  <div class="row form-group category-table" id="ifYesForImage" style="display: flex ">
                      <div class="col col-12 col-sm-7">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            
                          <div class="fileupload-new thumbnail" style="width: 100%">
                            <img src="uploads/image/<?php echo $sel_data['coverUrl'] ?>" alt="" style="width: 25%" />
                          </div>
                          
                          <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>
                          <div class="cat-select-img-btn">
                            <span class="btn btn-theme02 btn-file  sel-img-text">
                              <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" accept="image/*" name="postImgFile" class="default" value="<?php echo $sel_data['coverUrl'] ?>" />
                            </span>
                          </div>
                        </div>  
                      </div>
                    </div> 


                    <div class="row form-group category-table" id="ifYesForVideo" style="display:  <?php echo $sel_data['postType'] == 'file' ? 'flex':'none' ?>">
                      <div class="col col-12 col-sm-7">
                          
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            
                         <div class="fileupload-new thumbnail" style="width: 100%">
                              <p><?php echo $sel_data['streamUrl'] ?></p> 
                         <!-- <audio style="width: 35%" controls src="uploads/video/<?php echo $sel_data['streamUrl'] ?>" type="audio/mp3">
                          </audio>-->
                         </div>
                    
                    <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;"></div>
                    
                    <div class="cat-select-img-btn">
                      <span class="btn btn-theme02 btn-file  sel-img-text">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      <input type="file" name="postVideoFile"  class="default" value="<?php echo $sel_data['streamUrl'] ?>" />
                      </span>
                    </div>
                          
                        </div>  
                        
                      </div>
                    </div>
                    
                    
                      <div class="row form-group category-table" id="fileUrl" style="display: <?php echo $sel_data['postType'] == 'link' ? 'flex':'none' ?>" >
                      <div class="col col-12 col-sm-7">
                        <input type="text" id="file_url" name="file_link" placeholder="Enter Link Url ..." class="form-control" value="<?php echo $sel_data['streamUrl']; ?>" required="<?php echo $sel_data['postType'] == 'link' ? 'true':'false' ?>" >
                    </div>
                    </div>
                    


<?php



if ($sel_data['postType'] == 'video') {
    
      $isFile=false;
      
      
    ?>
  
       <!-- <div class="row form-group category-table"  >
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="file_link" placeholder="Enter File Url ..." class="form-control" required>
        </div>
        </div>-->
        
      

<?php

}
  else if(($sel_data['postType'] == 'image')){
     $isFile=true;
    
?>

  <!--<div class="row form-group category-table">
    <div class="col col-12 col-sm-7">
      <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-new thumbnail" style="width: 100%">
          <img src="uploads/image/<?php echo $sel_data['coverUrl'] ?>" alt="" style="width: 25%" />
        </div>
        <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>
        <div class="cat-select-img-btn">
          <span class="btn btn-theme02 btn-file  sel-img-text">
            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
          <input type="file" accept="image/*" name="postImgFile" class="default" value="<?php echo $sel_data['coverUrl'] ?>" />
          </span>
        </div>
      </div>  
    </div>
  </div>

  <div class="row form-group category-table">
      
    <div class="col col-12 col-sm-7">
        
      <div class="fileupload fileupload-new" data-provides="fileupload">
          
        <div class="fileupload-new thumbnail" style="width: 100%">
          <audio style="width: 35%" controls src="uploads/video/<?php echo $sel_data['streamUrl'] ?>" type="audio/mp3">
          </audio>
        </div>
        
        <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;"></div>
        
        <div class="cat-select-img-btn">
          <span class="btn btn-theme02 btn-file  sel-img-text">
            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
          <input type="file" name="postVideoFile" accept="audio/*" class="default" value="<?php echo $sel_data['streamUrl'] ?>" />
          </span>
        </div>
        
      </div>  
      
    </div>
    
  </div>-->
  
        

<?php

  }

?>


                    

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="submit" class="btn btn-theme cate-btn text-light" id="cat_insert" name="post_edit" value="Update Post">
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>

            </div>

        </div>





    </div><!-- /#right-panel -->

    <!-- Right Panel -->

<?php

    include('footer.php');

?>


<script>
    function ifYesFor(that) {
        if (that.value == "file") {             
            document.getElementById("ifYesForImage").style.display = "flex";
            document.getElementById("ifYesForVideo").style.display = "flex";
             document.getElementById("fileUrl").style.display = "none";
             document.getElementById("file_url").required=false;
        } else if(that.value == "link") {
            document.getElementById("ifYesForImage").style.display = "flex";
            document.getElementById("ifYesForVideo").style.display = "none";
            document.getElementById("fileUrl").style.display = "flex";
            document.getElementById("file_url").required=true;
        }
        else{
            document.getElementById("ifYesForImage").style.display = "none";
            document.getElementById("ifYesForVideo").style.display = "none";
        }
    }
</script>
