<?php

  $artist_insert = "category-insert";


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



        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
                
              <div class="card">
                <div class="card-body cat-card-body">
                  <form role="form" method="post" action="artist-actions.php" enctype="multipart/form-data">

                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="text" name="cat_title" placeholder="Enter Artist Name..." class="form-control" required>
                      </div>
                    </div>
                    
                     <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <textarea id="mytextarea" name="artist_bio" ></textarea>
                      </div>
                    </div>
                    
                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-new thumbnail" style="width: 100%">
                            <img src="images/ic_gallery.png" alt="" style="width: 25%" />
                          </div>
                          <div class="fileupload-preview fileupload-exists thumbnail img-preview" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px;"></div>
                          <div class="cat-select-img-btn">
                            <span class="btn btn-theme02 btn-file  sel-img-text">
                              <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" accept="image/*" name="catImgFile" class="default" />
                            </span>
                          </div>
                        </div>  
                      </div>
                    </div>
                    
                    <div class="row form-group category-table">
                      <div class="col col-12 col-sm-7">
                        <input type="submit" class="btn btn-theme cate-btn text-light" id="cat_insert" name="cat_insert" value="Insert Artist">
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

