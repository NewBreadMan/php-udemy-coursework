<?php include "includes/admin_header.php" ;?>
    <div id="wrapper">

<!----------- Navigation --------------->
<?php include "includes/admin_nav.php";?>   
<!---------------- /.navbar-collapse -->
        </nav>
<div id="page-wrapper">
    <div class="container-fluid">

                <!-- Page Heading -->
       <div class="row">
            <div class="col-lg-12">
                 h1 class="page-header">
                      Welcome to <?php echo $_SESSION['firstname']. "'s  "; ?>Admin Front Page
                    <small> <?php echo $_SESSION['firstname']; ?></small>  </h1>

<!-- <ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> Blank Page
    </li>
</ol> -->
            </div>
        </div>
                <!-- /.row -->
                <!-- row. -->                
        <div class="row">
           <div class="col-lg-3 col-md-6">
             <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                     </div>
                    <div class="col-xs-9 text-right">
<?php 
        $query = "SELECT * FROM posts" ;
        $postsCountQry = mysqli_query($connx, $query);
        $postCounts = mysqli_num_rows($postsCountQry);    
        echo "<div class='huge'>{$postCounts}</div>";
?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
        $query = "SELECT * FROM comments" ;
        $commentsCountQry = mysqli_query($connx, $query);
        $commentsCounts = mysqli_num_rows($commentsCountQry);
        echo "<div class='huge'>{$commentsCounts}</div>";
?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
        $query = "SELECT * FROM users" ;
        $usersCountQry = mysqli_query($connx, $query);
        $usersCounts = mysqli_num_rows($usersCountQry);
        echo "<div class='huge'>{$usersCounts}</div>";
?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
        $query = "SELECT * FROM categories" ;
        $categoriesCountQry = mysqli_query($connx, $query);
        $categoriesCounts = mysqli_num_rows($categoriesCountQry);
        echo "<div class='huge'>{$categoriesCounts}</div>";
?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->


                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Blog Analytics', 'Totals', 'Approved', 'Unapproved'],
          ['Posts', 1000, 400, 200],
          ['Comments', 1170, 460, 250],
          ['Users', 660, 1120, 300],
          ['Categories', 1030, 'null', 'null']
        ]);

        var options = {
          chart: {
            title: 'Blog Analytics',
            subtitle: 'for Posts, Comments, Users and Categories',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 450px;"></div>
                </div>                
            </div>
            <!-- /.container-fluid -->

        </div>
     <?php include "includes/admin_footer.php"; ?>

