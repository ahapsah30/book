<?php

  $Dashboard = "dashboard";


include('header.php');

?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
        <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">-->

           <?php

            include('header-bar.php');


// ******--------------**********
// Logic for image cardboard
// ******--------------**********

    $sel_qur_postImg   = "select COUNT(*) from posts where isEnable = '0'";
    $sel_run_postImg   = mysql_query($sel_qur_postImg);
    $sel_dataImg       = mysql_fetch_array($sel_run_postImg);
    $sel_data_extractImg = implode(" ",$sel_dataImg);
    $sel_data_extractImg = $sel_data_extractImg[0].$sel_data_extractImg[1];


    $sel_qur_postImgBlc     = "select COUNT(*) from posts where isEnable = '1'";
    $sel_run_postImgBlc     = mysql_query($sel_qur_postImgBlc);
    $sel_dataImgBlc         = mysql_fetch_array($sel_run_postImgBlc);
    $sel_data_extractImgBlc = implode(" ",$sel_dataImgBlc);
    $sel_data_extractImgBlc = $sel_data_extractImgBlc[0].$sel_data_extractImgBlc[1];


    $sel_data_extractImg; //total posts
    $sel_data_extractImgBlc; //block posts

    $imageBlockRatio = ($sel_data_extractImgBlc/$sel_data_extractImg)*100;
    $imageBlockRatio = round($imageBlockRatio, 2);
            


// ******--------------**********
// Logic for video cardboard
// ******--------------**********

    $sel_qur_postVideo   = "select COUNT(*) from posts where  isFeatured='1' ";
    $sel_run_postVideo   = mysql_query($sel_qur_postVideo);
    $sel_dataVideo       = mysql_fetch_array($sel_run_postVideo);
    $sel_data_extractVideo = implode(" ",$sel_dataVideo);
    $sel_data_extractVideo = $sel_data_extractVideo[0].$sel_data_extractVideo[1];


    $sel_qur_postVideoBlc     = "select COUNT(*) from posts where isFeatured='1' && isEnable = '1'";
    $sel_run_postVideoBlc     = mysql_query($sel_qur_postVideoBlc);
    $sel_dataVideoBlc         = mysql_fetch_array($sel_run_postVideoBlc);
    $sel_data_extractVideoBlc = implode(" ",$sel_dataVideoBlc);
    $sel_data_extractVideoBlc = $sel_data_extractVideoBlc[0].$sel_data_extractVideoBlc[1];


    $videoBlockRatio = ($sel_data_extractVideoBlc/$sel_data_extractVideo)*100;
    $videoBlockRatio = round($videoBlockRatio, 2);



// ******--------------**********
// Logic for user cardboard
// ******--------------**********

    $sel_qur_postUser   = "select COUNT(*) from artist";
    $sel_run_postUser   = mysql_query($sel_qur_postUser);
    $sel_dataUser       = mysql_fetch_array($sel_run_postUser);
    $sel_data_extractUser = implode(" ",$sel_dataUser);
    $sel_data_extractUser = $sel_data_extractUser[0].$sel_data_extractUser[1];


    $sel_qur_postUserBlc     = "select COUNT(*) from artist where isEnable = '1'";
    $sel_run_postUserBlc     = mysql_query($sel_qur_postUserBlc);
    $sel_dataUserBlc         = mysql_fetch_array($sel_run_postUserBlc);
    $sel_data_extractUserBlc = implode(" ",$sel_dataUserBlc);
    $sel_data_extractUserBlc = $sel_data_extractUserBlc[0].$sel_data_extractUserBlc[1];


    $UserBlockRatio = ($sel_data_extractUserBlc/$sel_data_extractUser)*100;
    $UserBlockRatio = round($UserBlockRatio, 2);



// ******--------------**********
// Logic for comment cardboard
// ******--------------**********

    $sel_qur_postComment   = "select COUNT(*) from category";
    $sel_run_postComment   = mysql_query($sel_qur_postComment);
    $sel_dataComment       = mysql_fetch_array($sel_run_postComment);
    $sel_data_extractComment = implode(" ",$sel_dataComment);
    $sel_data_extractComment = $sel_data_extractComment[0].$sel_data_extractComment[1];


    $sel_qur_postComBlc     = "select COUNT(*) from category where isEnable = '1'";
    $sel_run_postComBlc     = mysql_query($sel_qur_postComBlc);
    $sel_dataComBlc         = mysql_fetch_array($sel_run_postComBlc);
    $sel_data_extractComBlc = implode(" ",$sel_dataComBlc);
    $sel_data_extractComBlc = $sel_data_extractComBlc[0].$sel_data_extractComBlc[1];


    $ComBlockRatio = ($sel_data_extractComBlc/$sel_data_extractComment)*100;
    $ComBlockRatio = round($ComBlockRatio, 2);
    
// ******--------------**********
// Logic for Admob Configuration
// ******--------------**********    
    
    $sel_qur = "select * from admob where id = '1' ";
    $sel_run = mysql_query($sel_qur);
    $sel_data = mysql_fetch_array($sel_run);
    

?> 


        <div class="content mt-5">

            <div class="col-sm-6 col-lg-3 header-small-cards">
               <div class="card">
                <div class="card-body">
                    
                    <div class="clearfix float-left">
                        <div class="text-muted text-uppercase font-xs small">Books</div>
                        <div class="h6 text-secondary font-weight-bold mb-3 mt-1"><?php echo $sel_data_extractImg; ?></div>
                    </div> 
                    
                    <div class="float-right">
                        <i class="fa fa-area-chart bg-flat-color-5 circle-icon-purple p-3 font-2xl text-light"></i>
                    </div>
                    
                    <div class="float-left">
                        <?php  if ($imageBlockRatio >= 50) : ?>
                            <span class="text text-danger"><i class="fa fa-arrow-down"> <?php echo $imageBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  else : ?>
                            <span class="text text-success"><i class="fa fa-arrow-up"> <?php echo $imageBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  endif; ?>
                        
                    </div>    
                
                </div>
               </div>
            </div>

            <!--/.col-->

            <div class="col-sm-6 col-lg-3 header-small-cards">
                <div class="card">
                <div class="card-body">
                    <div class="clearfix float-left">
                        <div class="text-muted text-uppercase font-xs small">Featured</div>
                        <div class="h6 text-secondary font-weight-bold mb-3 mt-1"><?php echo $sel_data_extractVideo; ?></div>
                    </div> 
                    <div class="float-right">
                        <i class="fa fa-heart bg-flat-color-5 circle-icon-orange p-3 font-2xl text-light"></i>
                    </div>
                    <div class="float-left">
                        <?php  if ($videoBlockRatio >= 50) : ?>
                            <span class="text text-danger"><i class="fa fa-arrow-down"> <?php echo $videoBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  else : ?>
                            <span class="text text-success"><i class="fa fa-arrow-up"> <?php echo $videoBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  endif; ?>
                    </div>    
                </div>
               </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3 header-small-cards">
                <div class="card">
                <div class="card-body">
                    
                    <div class="clearfix float-left">
                        
                        <div class="text-muted text-uppercase font-xs small">Artist</div>
                        
                        <div class="h6 text-secondary font-weight-bold mb-3 mt-1"><?php echo $sel_data_extractUser; ?></div>
                    </div> 
                    
                    <div class="float-right">
                        <i class="fa fa-users bg-flat-color-5 circle-icon-yellow p-3 font-2xl text-light"></i>
                    </div>
                    
                    <div class="float-left">
                        
                        <?php  if ($UserBlockRatio >= 50) : ?>
                        
                            <span class="text text-danger"><i class="fa fa-arrow-down"> <?php echo $UserBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                            
                        <?php  else : ?>
                        
                            <span class="text text-success"><i class="fa fa-arrow-up"> <?php echo $UserBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                            
                        <?php  endif; ?>
                        
                    </div>    
                    
                </div>
               </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3 header-small-cards">
                <div class="card">
                <div class="card-body">
                    <div class="clearfix float-left">
                        
                        <div class="text-muted text-uppercase font-xs small">Categories</div>
                        
                        <div class="h6 text-secondary font-weight-bold mb-3 mt-1"><?php echo $sel_data_extractComment; ?></div>
                        
                    </div> 
                    
                    <div class="float-right">
                        <i class="fa fa-th-large bg-flat-color-5 circle-icon-lightblue p-3 font-2xl text-light"></i>
                    </div>
                    
                    <div class="float-left">
                        <?php  if ($ComBlockRatio >= 50) : ?>
                            <span class="text text-danger"><i class="fa fa-arrow-down"> <?php echo $ComBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  else : ?>
                            <span class="text text-success"><i class="fa fa-arrow-up"> <?php echo $ComBlockRatio ?>% </i></span><span class="text-header"> &nbsp;Since last month</span>
                        <?php  endif; ?>
                    </div>    
                </div>
               </div>
            </div>
            <!--/.col-->

        </div> <!-- .content -->


        </header><!-- /header -->
        <!-- Header-->



        <div class="user-table-content col-sm-12">

            <div class="col-sm-12">
                
                <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All Users</strong>
                            </div>
                            
                            
                            <div class="card-body">
                                
                                <!--<form role="form" method="post" action="admob-actions.php?id=<?php echo 1 ?>" enctype="multipart/form-data">-->
                                
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Block/Unblock</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php

  $sel_qur_user   = "select * from users order by id DESC";
  $sel_run_user   = mysql_query($sel_qur_user);

  while ($sel_data_user  = mysql_fetch_array($sel_run_user)) {

    $id = $sel_data_user['id'];
    $isEnable = $sel_data_user['isEnable'];
    
     if($sel_data_user['userType']=="native"){
      $pictureUrl="uploads/image/".$sel_data_user['avatar'];
    }else{
        $pictureUrl=$sel_data_user['avatar'];
    }
?>

                <tr>
                    <td><img class="round-image" src="<?php echo $pictureUrl; ?>" style="cursor: pointer; height: 50px; border-radius: 100%; width: 50px; " alt=""><span><?php echo $sel_data_user['email']; ?></span></td>
                    <td><?php echo $sel_data_user['fname']; ?></td>
                    <td><?php echo $sel_data_user['lname']; ?></td>
                    <td>
                        <label class="switch switch-text switch-info switch-pill">
                            <input type="checkbox" class="switch-input" onClick="show1(<?php echo $isEnable; ?>, <?php echo $id; ?>)" <?php if($isEnable == 1): echo "checked"; endif; ?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span>
                        </label>
                    </td>
                </tr>


                <script>
                function show1(str, str1) {
                  if(str.length == "")
                  {
                    document.getElementById("testing1").innerHTML = "please write something";
                    return;
                  }
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                      document.getElementById("testing1").innerHTML = xhttp.responseText;
                      $("#testing1").find("script").each(function(i) {
                          eval($(this).text());
                      });
                    }
                  };
                  xhttp.open("GET", "updateUserToggle.php?var1=" + str + "&& var2="+str1, true);
                  xhttp.send();
                }
                </script>
                <div id="testing1"></div>
                                        
<?php 

}

?>

                                    </tbody>
                                </table>
                                
                                 <!--For Admob App Id-->
                  
                               <!-- <div class="row form-group category-table">
                                  <div class="col col-12 col-sm-7">
                                    <input type="text" name="admob_app_id" placeholder="Enter Admob App Id" class="form-control" value="<?php echo $sel_data['admob_app_id']; ?>" required>
                                  </div>
                                </div>-->
                            
                                <!--For Admob Banner Id-->
                              
                                <!--<div class="row form-group category-table">
                                  <div class="col col-12 col-sm-7">
                                    <input type="text" name="admob_banner_id" placeholder="Enter Admob Banner Id" class="form-control" value="<?php echo $sel_data['admob_banner_id']; ?>" required>
                                  </div>
                                </div>-->
                                
                                 <!--For Admob Interstitial Id-->
                              
                                <!--<div class="row form-group category-table">
                                  <div class="col col-12 col-sm-7">
                                    <input type="text" name="admob_interstitial_id" placeholder="Enter Admob Interstitial Id" class="form-control" value="<?php echo $sel_data['admob_interstitial_id']; ?>" >
                                  </div>
                                </div>
                                
                                <div class="row form-group category-table">
                                  <div class="col col-12 col-sm-7">
                                    <input type="submit" class="btn btn-theme cate-btn text-light" id="cat_insert" name="post_edit" value="Update Configuration">
                                  </div>
                                </div>-->
                                
                                <!--</form>-->
                                
                            </div>
                            
                            
                        </div>

            </div>

        </div>





    </div><!-- /#right-panel -->

    <!-- Right Panel -->


<?php

    include('footer.php');

?>

