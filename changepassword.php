<?php
include_once'connectdb.php';
session_start();

 include_once'header.php';
//  when click on update password button we get out value from user into variables
//  using of select query we get out database record according to useremail
//  if value matched then we run update

if(isset($_SESSION['btnupdate'])){
    $oldpassword=$_POST['txtoldpass'];
    $newpassword=$_POST['txtnewpass'];
    $confirmpassword=$_POST['txtconpass'];

    $youremail=$_SESSION['useremail'];
    $select=$pdo->prepare("SELECT * FROM `sbh_tbl_user` WHERE useremail='$youremail'");
    $select->execute();

   $row=$select->fetch(PDO::FETCH_ASSOC);

   $useremail_db=$row['useremail'];
   $password_db= $row['password'];

   if($oldpassword==$password_db){

    if( $newpassword==$confirmpassword){
        $update=$pdo->prepare("UPDATE `sbh_tbl_user` SET password=:pass where useremail=:email");
        
        $update->bindParam(':pass',$confirmpassword);
        $update->bindParam(':email', $youremail);
        if($update->execute()){
       echo 'pasword updated';
        }else{
         echo"not updated";   
        }

    }else{
   echo'new and confirm password not  matched';
    }
   }else{
       echo'not matched';
   }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        
        -------------------------->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1"> Old Password</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtoldpass"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="txtnewpass"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="txtconpass"
                            placeholder="Password">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once'footer.php';?>