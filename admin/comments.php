<?php require_once "includes/admin_header.php" ;?>

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
                            <small>Posted Comments Page</small>
                        </h1>
<?php
    if(isset($_GET['source'])){
        $source = $_GET['source'];
    }else{
        $source = "";
    }

    switch($source) {
        case 'Add Comment';
        include "includes/addComment.php";
        break;

        case 'Edit Comment';
        include "includes/editComment.php";
        break;

        default:
        include "includes/viewAllComments.php";
        break;


}

?>
      

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
     <?php include "includes/admin_footer.php"; ?>