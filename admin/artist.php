<?php

  $artist = "category-header";


include('header.php');

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
                <strong>Successfully!</strong> Artist is added. 
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
                <strong>Successfully!</strong> Artist is updated. 
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
                <strong>Successfully!</strong> Artist is deleted. 
              </div>
            </div>
          <?php
          unset($_SESSION['success-del']);
        }

      ?>



        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
                
                <div class="card">
                            <div class="card-header">
                                <strong class="card-title">
                                  <a href="artist-insert.php"><i class="fa fa-plus cat-circle-icon-purple text-light p-2 font-2xl"></i></a>
                                  &nbsp;Add Author
                                </strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                             <th>Bio</th>
                                            <th>Picture</th>
                                            <th>Actions</th>
                                            <th>Block/Unblock</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php

 function shorten($string, $maxLength) {
    return substr($string, 0, $maxLength);
}

  $sel_qur_cat   = "select * from artist order by id DESC";
  $sel_run_cat   = mysql_query($sel_qur_cat);

  while ($sel_data_cat  = mysql_fetch_array($sel_run_cat)) {

    $id = $sel_data_cat['id'];
    $isEnable = $sel_data_cat['isEnable'];
?>

                <tr>
                    <td><?php echo $sel_data_cat['title']; ?></td>
                    <td style="width: 30%;" > <font color="#1f1f1f"> <?php echo shorten($sel_data_cat['description'],100); ?></td>
                    <td><img class="cat-round-image" src="uploads/image/<?php echo $sel_data_cat['pictureUrl']; ?>" alt=""></td>
                    <td>
                      <a href="artist-edit.php?id=<?php echo $id ?>"><i class="fa fa-pencil cat-circle-icon-black text-light p-2 font-2xl"></i></a>
                      <a href="artist-actions.php?id=<?php echo $id ?>"><i class="fa fa-times cat-circle-icon-red text-light p-2 font-2xl"></i></a>
                    </td>
                    </td>
                    <td>
                        <label class="switch switch-text switch-info switch-pill">
                            <input type="checkbox" id="switchimg_<?php echo $id; ?>" class="switch-input" onClick="show1(<?php echo $isEnable; ?>, <?php echo $id; ?>)" <?php if($isEnable == 1): echo "checked"; endif; ?>> <span data-on="On" data-off="Off" class="switch-label"></span> <span class="switch-handle"></span>
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
                      document.getElementById("switchimg_"+str1).setAttribute("onClick", "show1("+xhttp.responseText+","+str1+")");
                      $("#testing1").find("script").each(function(i) {
                          eval($(this).text());
                      });
                    }
                  };
                  xhttp.open("GET", "updateArtistToggle.php?var1=" + str + "&& var2="+str1, true);
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





    </div><!-- /#right-panel -->

    <!-- Right Panel -->

<?php

    include('footer.php');

?>

