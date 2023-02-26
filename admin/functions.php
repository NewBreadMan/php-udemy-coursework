<?php 

function insertCategories() {
global $connx;
  if(isset($_POST['submit'])){
    $cat_title= $_POST['cat_title'];
    if(empty($cat_title) || $cat_title == ""){
        echo "<h4></h4>This field cannot be empty</h4>";
    }else{
        $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}') ";
        $add_category_qry = mysqli_query($connx, $query);

        if(!$add_category_qry) {
            die('Something went wrong with the Insert query' . mysqli_error($connx));
           }
        header("Location: categories.php");
      }
    }
}
function findAllCategories(){
    global $connx; 
    $query = "SELECT * FROM categories";
    $category_qry = mysqli_query($connx, $query);    

    while($row = mysqli_fetch_array($category_qry)) {
        $cat_title = $row['cat_title'];
        $cat_id    = $row['cat_id'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></a></td>";
        echo "</tr>";
    }
}
function deleteCategories(){
    global $connx;
    if(isset($_GET['delete'])){
        $spec_cat_id = $_GET['delete'];  //specific cat id

        $query = "DELETE FROM categories WHERE CAT_ID = {$spec_cat_id} " ;
        $del_cat_qry = mysqli_query($connx, $query);
        header("Location: categories.php");
    }
}

function confirmQuery($result){
    global $connx;
    if(!$result){
       die("Query " . $result . "failed.  " . mysqli_error($connx));
    }
}

?>