<?php include('partials/adminClient.php'); ?>

<!--admin content-->
<section class="admin-content">
    <div class="banner"></div>
    <h2 class="sub-title">Manage Admin</h>
    <br>

    <!--sessio variable-->
    <div class="text-center">
    <?php
        //message shown when admin added
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //display message
            unset($_SESSION['add']); //reset session
        }
        
        //message shown when admin deleted
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
    ?>
    </div>
    <!--sessio variable-->

    <!--add admin button-->
    <div class="admin-add-button">
        <a href="add-admin.php" class="btn">Add admin</a>
    </div>
    <!--add amin button-->
    <!--admin list-->
    <div class="admin-list">
        
    <?php
        //query to select all admin
        $sql = "SELECT * FROM table_admin";
        //execute query
        $res = mysqli_query($conn, $sql);

        //check if query executed
        if($res==TRUE)
        {
            //count rows
            $count = mysqli_num_rows($res); //functionn get all rows

            //check no. rows
            if($count>0)
            {
                //have data
                while($rows=mysqli_fetch_assoc($res))
                {
                    //get each data
                    $id = $rows['id'];
                    $username = $rows['username'];
                    $access_level = $rows['access_level'];

                    //display rows
                    ?>

                    <div class="admin-box">
                        <div class="admin-box-info">
                            <h4>ID: <?php echo $id; ?></h4>
                            <h4>Name: <?php echo $username; ?></h4>
                            <p>Access level: <?php echo $access_level; ?></p>
                        </div>
                        <div class="admin-box-button">
                            <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn">Delete</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //no data
            }
        }
    ?>
    </div>
    <!--admin list-->
    <div class="clearfix"></div>
</section>
<!--sdmin content-->

<?php include('partials/adminFooter.php'); ?>