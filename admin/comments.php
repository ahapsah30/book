<?php

  $comments = "comments";


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


        <div class="category-table-content col-sm-12">

            <div class="col-sm-12">
                
                <div class="card">
                            
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>User Name</th>
                                            <th>Comment</th>
                                            <th>Block/Unblock</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php

$sel_qur_com = "select * from comments order by id DESC";
$sel_run_com = mysql_query($sel_qur_com);

while($sel_data_com = mysql_fetch_array($sel_run_com)) {  

  $id = $sel_data_com['id'];
  $post_id = $sel_data_com['post_id'];
  $user_id = $sel_data_com['user_id'];
  $isEnable = $sel_data_com['isEnable'];

    $sel_qur_post   = "select * from posts where id = '".$post_id."'";
    $sel_run_post   = mysql_query($sel_qur_post);
    $sel_data_post  = mysql_fetch_array($sel_run_post);

    $sel_qur_user = "select * from users where id = '".$user_id."'";
    $sel_run_user = mysql_query($sel_qur_user);
    $sel_data_user  = mysql_fetch_array($sel_run_user);
?>

                <tr>
                    <td><?php echo $sel_data_post['title']; ?></td>
                    <td><?php echo $sel_data_user['fname']; ?> <?php echo $sel_data_user['lname']; ?></td>
                    <td><?php echo $sel_data_com['comments']; ?></td>
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
                  xhttp.open("GET", "updateCommentToggle.php?var1=" + str + "&& var2="+str1, true);
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

