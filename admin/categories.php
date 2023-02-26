<?php include "includes/admin_header.php" ;?>

    <div id="wrapper">
<!-------------- Navigation --------------->
<?php include "includes/admin_nav.php";?>   
<!---------------- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
           <div class="container-fluid">
<!---------------- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin's Page
                            <small>Post Categories Page</small>
                        </h1>

<div class="col-xs-6">

<?php  ///Insert categories function call
            insertCategories();
?>

    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Add Category</label>
            <input type="text" class="form-control" name="cat_title"> 
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Add Category"> 
        </div>
    </form>

<?php  /// UPDATE CATEGORIES codeblock
    if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        include "includes/update_categories.php";
    }
?>
  
</div>
<!------------------- Categories Table ---->
<div class="col-xs-6">


      <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php //find all categories from table...
    findAllCategories ();   
//------delete the record
    deleteCategories()
?>
            </tbody>
        </table>
    </form>
</div>

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

            </div>
            <!-- /.container-fluid -->

        </div>
     <?php include "includes/admin_footer.php"; ?>