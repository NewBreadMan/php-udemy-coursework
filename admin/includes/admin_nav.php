<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

 <?php include "admin_nav_bar.php"; ?>       

<!--                 LEFT Sidebar Menu Items - 
    These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-table"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                        <li><a href="./posts.php"> View All Posts</a>
                            </li>
                            <li><a href="posts.php?source=Add Post"> Add Post</a>
                            </li>
                            <li><a href="#"> Edit Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-edit"></i> Caategories</a>
                    </li>
                    <li>
                        <a href="./comments.php" data-toggle="collapse" data-target="#comment_dropdown"><i class="fa fa-fw fa-table"></i> Comments <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="comments_dropdown" class="collapse">
                        <li><a href="../comments.php"> View All comments</a>
                            </li>
                            <li><a href="../comments.php?source=Add comment"> Add Post</a>
                            </li>
                            <li><a href="#"> Edit Comment</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <a href="#" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="collapse">
                        <li><a href="users.php">  View All Users</a>
                            </li>
                            <li><a href="users.php?source=add_user">  Add User</a>
                            </li>
                            <!-- <li><a href="users.php?source=edit_user">  Edit User</a>
                            </li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"fa fa-fw fa-wrench"></i> Profile</a>
                    </li>         
                </ul>
            </div>