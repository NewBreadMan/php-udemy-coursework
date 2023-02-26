<!-- Blog Side Bar  -->
<div class="col-md-4">



<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name ="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form> <!-- end of blog search form -->
    <!-- /.input-group -->
</div>
<!-- USER LOGIN Well -->
<div class="well">
     <h4>Admin Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter username">
        </div>

        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Submit </button>
            </span>
        </div >
    </form> <!-- end of USER LOGIN form -->
  
</div>

<!-- Blog Categories Well -->

<div class="well">
<?php
    $query = "SELECT * FROM categories";
        $category_qry = mysqli_query($connx, $query);
      
?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
<?php
        while($row = mysqli_fetch_array($category_qry)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
        }
?>
                
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
              
            </ul>
        </div>   <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
   </div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>
</div>