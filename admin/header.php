<?php

include('connection.php');

  session_start();
  if(empty($_SESSION['uid']))
  {
    header("location:login.php");
  }


?>

<!doctype html>

<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">

    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-fileupload.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> -->

                <div class="page-title sidebar-title">
                    <h5>Books4u</h5>
                </div>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                
                <ul class="nav navbar-nav">
                    
                    <li <?php if(!empty($Dashboard)) echo "class='active'"; ?>>
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard circle-text-red"></i>Dashboard </a>
                    </li>
                    
                    <li <?php if(!empty($category) || !empty($category_insert) || !empty($category_edit)) echo "class='active'"; ?>>
                        <a href="category.php"> <i class="menu-icon fa fa-plus circle-text-orange"></i>All Categories</a>
                    </li>
                    
                     <li <?php if(!empty($artist) || !empty($artist_insert) || !empty($artist_edit)) echo "class='active'"; ?>>
                        <a href="artist.php"> <i class="menu-icon fa fa-user-circle-o circle-text-lightblue"></i>All Author</a>
                    </li>
                    
                    <li <?php if(!empty($featured) || !empty($featured_insert) || !empty($featured_edit)) echo "class='active'"; ?>>
                        <a href="featured.php"> <i class="menu-icon fa fa-heart circle-text-orange"></i>Featured Books</a>
                    </li>
                    
                    <li <?php if(!empty($posts) || !empty($posts_insert) || !empty($posts_edit)) ?> class="menu-item-has-children dropdown">
                        <a href="posts.php"  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="menu-icon fa fa-pencil circle-text-yellow"></i>All Books </a>
                        
                        <ul class="sub-menu children dropdown-menu">
									<?php
										
								        $query1=mysql_query("select * from category");
	                                    while($row1=mysql_fetch_array($query1))
	                                    {
	                                    	?>
	                                            <li>

	                                            	<a href="posts.php?category_id=<?php echo $row1['id'];?>&name=<?php echo $row1['title'];?>">
	                                            	    <?php echo $row1['title'];?>
	                                            	    
	                                            	</a>
	                                                
	                                            </li>
	                                        <?php
	                                    }
										
									?>
									
								</ul>
								
								
                    </li>
                    
                   <li <?php if(!empty($comments)) echo "class='active'"; ?>>
                        <a href="comments.php"> <i class="menu-icon fa fa-comments circle-text-lightblue"></i>All Comments</a>
                    </li>
                    
                    <li <?php if(!empty($report)) echo "class='active'"; ?>>
                        <a href="reports.php"> <i class="menu-icon fa fa-comments circle-text-lightblue"></i>Reports</a>
                    </li>
                    
                    <li <?php if(!empty($policy)) echo "class='active'"; ?>>
                        <a href="policy.php"> <i class="menu-icon fa fa-shield circle-text-green"></i>Privacy Policy</a>
                    </li>
                    
                    <li <?php if(!empty($admob_setting)) echo "class='active'"; ?>>
                        <a href="admob.php"> <i class="menu-icon fa fa-bolt circle-text-green"></i>Settings</a>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->