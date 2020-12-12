<?php

  $featured = "posts";


include('header.php');
$category_id = $_GET['category_id'];

?>

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

      ?>



        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
            
                <div class="card">
                    
                  <!--<div class="card-header">
                      <strong class="card-title">
                        <a href="post-insert.php"><i class="fa fa-plus cat-circle-icon-purple text-light p-2 font-2xl"></i></a>
                        &nbsp;Add Post
                      </strong>
                  </div>-->
                  
                  <div class="card-body">
                      
                      <!--<ul class="nav nav-tabs" id="myTab" role="tablist">
                          
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Post Image</a>
                        </li>
                        
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Post Video</a>
                        </li>
                        
                      </ul>-->
                      
                      <div class="tab-content pl-3 p-1" id="myTabContent">
                          
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                          <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                              
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <!--<th>File</th>-->
                                            <th>Statistics</th>
                                            <th>Featured</th>
                                            <th>Actions</th>
                                            <th>Block</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

<?php

  if (!empty($category_id)){
      
      $sel_qur_posts   = "select * from posts where  cat_id = '".$category_id."' order by id DESC";
      
  }else{
      
      $sel_qur_posts   = "select * from posts where isFeatured='1' order by id DESC";
      
  }    


    function shorten($string, $maxLength) {
    return substr($string, 0, $maxLength);
}

  //$sel_qur_posts   = "select * from posts where postType = 'image' and cat_id = '".$category_id."' order by id DESC";
  $sel_run_posts   = mysql_query($sel_qur_posts);

  while ($sel_data_post  = mysql_fetch_array($sel_run_posts)) {

    $id = $sel_data_post['id'];
    $cat_id = $sel_data_post['cat_id'];
    $isEnable = $sel_data_post['isEnable'];
    $isFeatured = $sel_data_post['isFeatured'];

    $sel_qur_post_cat = "select * from category where id = '" . $cat_id . "'";
    $sel_run_post_cat = mysql_query($sel_qur_post_cat);
    $sel_data_post_cat = mysql_fetch_array($sel_run_post_cat);
    
    $sel_qur_post_com = "select * from comments where post_id  = '" . $id . "'";
    $sel_run_post_com = mysql_query($sel_qur_post_com);
    $count_com=mysql_num_rows($sel_run_post_com);
?>

                <tr>
                    <td style="width: 20%;"><?php echo $sel_data_post['title']; ?></td>
                    <td class="post_desc" style="width: 20%;"><?php echo shorten($sel_data_post['description'],80); ?></td>
                    <td><?php echo $sel_data_post_cat['title']; ?></td>
                    <td><img src="uploads/image/<?php echo $sel_data_post['coverUrl']; ?>" alt=""></td>
                    
                    <!--<td><?php echo $sel_data_post['likes']; ?> / <?php echo $sel_data_post['dislikes']; ?></td>-->
                    <!--<td style="width: 20%">
                      <audio style="width: 100%" controls src="uploads/video/<?php echo $sel_data_post['streamUrl'] ?>" type="audio/mp3">
                        </audio>
                    </td>-->
                    <td><?php echo $sel_data_post['downloads']; ?></td>
                    
                    <!--<td><?php echo $count_com; ?></td>-->
                    
                    <td>
                        <label class="switch switch-text switch-info switch-pill">
                            <input type="checkbox" id="feature_<?php echo $id; ?>" class="switch-input" onClick="show123(<?php echo $isFeatured; ?>, <?php echo $id; ?>,'featured')" <?php if($isFeatured == 1): echo "checked"; endif; ?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span>
                        </label>
                    </td>
                    
                    <td>
                      <a href="featured-edit.php?id=<?php echo $id ?>"><i class="fa fa-pencil cat-circle-icon-black text-light p-2 font-2xl"></i></a>
                      <a href="featured-actions.php?id=<?php echo $id ?>"><i class="fa fa-times cat-circle-icon-red text-light p-2 font-2xl"></i></a>
                    </td>
                    
                    <td>
                        <label class="switch switch-text switch-info switch-pill">
                            <input type="checkbox" id="switchimg_<?php echo $id; ?>" class="switch-input" onClick="show11(<?php echo $isEnable; ?>, <?php echo $id; ?>,)" <?php if($isEnable == 1): echo "checked"; endif; ?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span>
                        </label>
                    </td>
                    
                </tr>


                <script>
                
                function show11(str, str1) {
                  if(str.length == "")
                  {
                    document.getElementById("testing11").innerHTML = "please write something";
                    return;
                  }
                  
                 // alert(str);
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                      document.getElementById("testing11").innerHTML = xhttp.responseText;
                     // alert(xhttp.responseText);
                      //alert("switchimg_"+str1);
                      document.getElementById("switchimg_"+str1).setAttribute("onClick", "show11("+xhttp.responseText+","+str1+")");
                      $("#testing11").find("script").each(function(i) {
                          eval($(this).text());
                      });
                    }
                  };
                  xhttp.open("GET", "updatePostToggle.php?var1="+str+"&var2="+str1, true);
                  xhttp.send();
                }
                
                </script>
                
                <script>
                    
                function show123(str, str1 ,str2) {
                  if(str.length == "")
                  {
                    document.getElementById("testing11").innerHTML = "please write something";
                    return;
                  }
                  
                  ///alert(str);
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                      document.getElementById("testing11").innerHTML = xhttp.responseText;
                     // alert(xhttp.responseText);
                      //alert("switchimg_"+str1);
                      document.getElementById("feature_"+str1).setAttribute("onClick", "show123("+xhttp.responseText+","+str1+",'"+str2+"')");
                      $("#testing11").find("script").each(function(i) {
                          eval($(this).text());
                      });
                    }
                  };
                  xhttp.open("GET", "updatePostToggle.php?var1="+str+"&var2="+str1+"&var3="+str2, true);
                  xhttp.send();
                }
                    
                </script>
                
                
                <div id="testing11"></div>
                                        
<?php 

}

?>

                                    </tbody>
                                </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Video</th>
                                            <th>Likes / Dislikes</th>
                                            <th>Downloads</th>
                                            <th>Comments</th>
                                            <th>Actions</th>
                                            <th>Block</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php

  if (!empty($category_id)){
      
      $sel_qur_posts   = "select * from posts where postType = 'video' and cat_id = '".$category_id."' order by id DESC";
      
  }else{
      
      $sel_qur_posts   = "select * from posts where postType = 'video' order by id DESC";
      
  }

  //$sel_qur_posts   = "select * from posts where postType = 'video' and cat_id = '".$category_id."' order by id DESC";
  $sel_run_posts   = mysql_query($sel_qur_posts);

  while ($sel_data_post  = mysql_fetch_array($sel_run_posts)) {

    $id = $sel_data_post['id'];
    $cat_id = $sel_data_post['cat_id'];
    $isEnable = $sel_data_post['isEnable'];

    $sel_qur_post_cat = "select * from category where id = '" . $cat_id . "'";
    $sel_run_post_cat = mysql_query($sel_qur_post_cat);
    $sel_data_post_cat = mysql_fetch_array($sel_run_post_cat);
    
    $sel_qur_post_com = "select * from comments where post_id  = '" . $id . "'";
    $sel_run_post_com = mysql_query($sel_qur_post_com);
    $count_com=mysql_num_rows($sel_run_post_com);
    //$sel_data_post_com = mysql_fetch_array($sel_run_post_com);
?>

                <tr>
                    <td style="width: 10%;"><?php echo $sel_data_post['title']; ?></td>
                    <td class="post_desc" style="width: 25%"><?php echo $sel_data_post['description']; ?></td>
                    <td><?php echo $sel_data_post_cat['title']; ?></td>
                    <td style="width: 20%">
                      <video style="width: 100%" controls src="uploads/video/<?php echo $sel_data_post['videoUrl'] ?>" type="video/mp4">
                        </video>
                    </td>
                    <td><?php echo $sel_data_post['likes']; ?> / <?php echo $sel_data_post['dislikes']; ?></td>
                    <td><?php echo $sel_data_post['downloads']; ?></td>
                    <td><?php echo $count_com; ?></td>
                    <td style="width: 10%">
                      <a href="post-edit.php?id=<?php echo $id ?>"><i class="fa fa-pencil cat-circle-icon-black text-light p-2 font-2xl"></i></a>
                      <a href="post-actions.php?id=<?php echo $id ?>"><i class="fa fa-times cat-circle-icon-red text-light p-2 font-2xl"></i></a>
                    </td>
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
                  xhttp.open("GET", "updatePostToggle.php?var1=" + str + "&& var2="+str1, true);
                  xhttp.send();
                }
                </script>
                <div id="testing1"></div>
                                        
<?php 

}

?>

                                    </tbody>
                                </table>
                        </div>
                      </div>
                    </div>
                  </div>


            </div>

        </div>





    </div><!-- /#right-panel -->

    <!-- Right Panel -->

<?php

    include('footer.php');

?>