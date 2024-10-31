<?php include('partials/adminClient.php'); ?>

<!--add admin content-->
<section class="add-admin">
    <div class="banner"></div>
    <h2 class="sub-title">Add Admin</h2>
    <br>

    <!-- session variable -->
    <div class="text-center">
    <!-- message shown when admin add failed -->
    <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //display message
            unset($_SESSION['add']); //reset session
        }
    ?>
    </div>
    <!-- session variable -->

    <div class="add-admin-form">
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" placeholder="Enter name" required>
                </td>
            </tr>

            <tr>
                <td>Password: </td>
                <td>
                    <input type="password" name="password" placeholder="enter password" required>
                </td>
            </tr>

            <tr>
                <td>Access level: </td>
                <td>
                    <input type="text" name="access_level" placeholder="enter access level" required>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn">
                </td>
            </tr>

        </table>

        </form>
    </div>
</section>
<!--add admin content-->

<?php include('partials/adminFooter.php'); ?>

<?php 

    //save new admin info into database

    //if button is clicked
    if(isset($_POST['submit']))
    {
        //prevent injection mysqli_real_escape_string()
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // md5 one way encryption
        $access_level = mysqli_real_escape_string($conn, $_POST['access_level']);

        //create sql query 
        $sql = "INSERT INTO table_admin SET
            username = '$username',
            access_level = '$access_level',
            password = '$password'
        ";

         //connect to sql and pass in $ql, if error die()
         $res = mysqli_query($conn, $sql) or die(mysqli_error());

         //check wether successfully added or not and give message
         if($res==TRUE)
         {
            //data inserted
            //create session variable to display message
            $_SESSION['add'] = "<div class='success'> Admin added successfully </div>";
            //redirect page
            header("location:".HOMEURL.'admin/adminManageAdmins.php');
         }
         else
         {
            //failed
            //create session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            //redirect page
            header("location:".HOMEURL.'admin/add-admin.php');
         }
    }   

?>