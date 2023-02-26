  <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Edit Category</label>

        <?php 
    if(isset($_GET['edit'])){
    $cat_id = $_GET['edit'];
    
    $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
    $edit_category_qry = mysqli_query($connx, $query);    

    while($row = mysqli_fetch_array($edit_category_qry)) {
        $cat_title = $row['cat_title'];
        $cat_id    = $row['cat_id'];
    ?>
    
    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title"> 

    <?php }  }  ?>
    
    <?php  //~~~~~UPDATE QUERY~~~~~~~~~~~~~~
    
    if(isset($_POST['update'])){
        $edit_cat_title = $_POST['cat_title'];  
        $query = "UPDATE categories SET cat_title = '{$edit_cat_title}' WHERE cat_id = {$cat_id} " ;
        $edit_cat_qry = mysqli_query($connx, $query);
        header("Location: ./categories.php");            
        }
      
    ?>      
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update" value="Update Category"> 
        </div>
    </form>