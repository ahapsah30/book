<?php

      // $sel_qur = "select username from admin where id = '".$_SESSION['uid']."'";
      // $sel_run = mysql_query($sel_qur);
      // $sel_data = mysql_fetch_array($sel_run);

?>

<div class="header-menu">

    <div class="col-sm-7">
        <div class="header-left">
            <div class="page-title">
                <h5>
                    <?php 
                        if(!empty($Dashboard)){
                            echo "Dashboard";   
                        } 
                        else if(!empty($category)){
                            echo "All Categories";  
                        }
                        else if(!empty($category_insert)){
                            echo "Add Category";  
                        }
                        else if(!empty($category_edit)){
                            echo "Edit Category";  
                        } 
                        else if(!empty($artist)){
                            echo "All Author";  
                        }
                        else if(!empty($artist_insert)){
                            echo "Add Author";  
                        }
                        else if(!empty($artist_edit)){
                            echo "Edit Author";  
                        }
                        else if(!empty($comments)){
                            echo "All Comments";  
                        }
                        else if(!empty($admin_profile)){
                            echo "Admin Profile";  
                        }
                        else if(!empty($posts)){
                            echo "All Book";  
                        }
                        else if(!empty($featured)){
                            echo "Featured Book";  
                        }
                        else if(!empty($posts_insert)){
                            echo "Add Book";  
                        }
                        else if(!empty($posts_edit)){
                            echo "Edit Book";  
                        }
                        else if(!empty($policy)){
                            echo "Add Policy";  
                        }
                        else if(!empty($admob_setting)){
                            echo "Admob Configuration";  
                        }
                        else if(!empty($report)){
                            echo "Book Reports";  
                        }
                    ?>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <div class="user-area dropdown float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
            </a> <span class="profile-title">admin</span>

            <div class="user-menu dropdown-menu">
                <a class="nav-link" href="admin-profile.php"><i class="fa fa-user"></i> My Profile</a>

                <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </div>

        </div>

    </div>
</div>