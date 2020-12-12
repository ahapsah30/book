<?php

  $posts_insert = "posts-insert";


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


        $sel_qur = "select * from category";
        $sel_run = mysql_query($sel_qur);

      ?>




        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
                
              <div class="card">
                <div class="card-body cat-card-body">
                  <form role="form" method="post" action="post-actions.php" enctype="multipart/form-data">

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="post_title" placeholder="Enter post title..." class="form-control" required>
                      </div>
                    </div>

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <textarea id="mytextarea" name="post_desc"></textarea>
                      </div>
                    </div>
                    
                    
                    <!--For entering post tags-->
                  
                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="post_tags" placeholder="Enter post tags..." class="form-control" required>
                      </div>
                    </div>
                    
                    
                    <!--For Stream Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="stream_url" placeholder="Enter stream url..." class="form-control" required>
                      </div>
                    </div>-->
                    
                    
                    <!--For Web Url-->
                  
                   <!-- <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="web_url" placeholder="Enter Web url..." class="form-control" required>
                      </div>
                    </div>-->
                    
                    
                    <!--For Fb Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="fb_url" placeholder="Enter Facebook url..." class="form-control" required>
                      </div>
                    </div>-->
                    
                    
                    <!--For Twitter Url-->
                  
                    <!--<div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="twitter_url" placeholder="Enter Twitter url..." class="form-control" required>
                      </div>
                    </div>-->

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <select class="form-control" name="catType" required>
                          <option value="">Select Category</option>
<?php 

while($sel_data = mysql_fetch_array($sel_run)) {  

?>
                          <option value="<?php echo $sel_data['id'] ?>"><?php echo $sel_data['title'] ?></option>

<?php } ?>

                      </select>
                    </div>
                  </div>
                  

                   <div class="row form-group category-table">
                    <div class="col col-12 col-sm-7">
                      <select class="form-control" name="postType" required onchange="ifYesFor(this);">
                        <option value="">Select Post Type</option>
                        <option value="file">File</option>
                        <option value="link">Link</option>
                      </select> 
                    </div>
                  </div>
                  
                  
                    <!--For the selection of Artist-->
                  
                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <select class="form-control" name="artist" required>
                         
                          <option value="">Select Author</option>
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
                  
                


                    <div class="row form-group category-table" id="ifYesForImage" style="display: none;">
                      <div class="col col-12 col-sm-7">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            
                          <div class="fileupload-new thumbnail" style="width: 100%">
                            <img src="images/ic_gallery.png" alt="" style="width: 25%" />
                          </div>
                          
                          <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>
                          
                          <div class="cat-select-img-btn">
                            <span class="btn btn-theme02 btn-file  sel-img-text">
                              <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" accept="image/*" name="postImgFile" class="default" />
                            </span>
                          </div>
                          
                        </div>  
                      </div>
                    </div>

                    
                    <div class="row form-group category-table" id="ifYesForVideo" style="display: none;">
                        
                      <div class="col col-12 col-sm-7">
                          
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            
                          <div class="fileupload-new thumbnail" style="width: 100%">
                            <img src="images/ic_video.png" alt="" style="width: 20%" />
                          </div>
                          
                          <div class="fileupload-preview fileupload-exists thumbnail" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;"></div>
                          
                          <div class="cat-select-img-btn">
                            <span class="btn btn-theme02 btn-file  sel-img-text">
                              <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                              
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            
                            <input type="file" name="postVideoFile" accept="audio/*" class="default" />
                            
                            </span>
                            
                          </div>
                          
                        </div>  
                      </div>
                    </div>
                    
                    <div class="row form-group category-table" id="fileUrl" style="display: none;" >
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="file_link" placeholder="Enter File Url ..." class="form-control" required>
                      </div>
                    </div>
                    

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="submit" class="btn btn-theme cate-btn text-light" id="cat_insert" name="post_insert" value="Insert Post">
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
        } else if(that.value == "link") {
            document.getElementById("ifYesForImage").style.display = "flex";
            document.getElementById("ifYesForVideo").style.display = "none";
            document.getElementById("fileUrl").style.display = "flex";
        }
        else{
            document.getElementById("ifYesForImage").style.display = "none";
            document.getElementById("ifYesForVideo").style.display = "none";
        }
    }
</script>
