<?php require('components/head.inc.php'); ?>
<?php require('components/navbar.inc.php'); ?>
<?php include('dbconfig.php'); ?>
<?php 
 
    if (isset($_POST['save'])) {
        
        $email=$_POST['email'];
        $uname=$_POST['uname'];
        $pass=$_POST['pass'];
        $sql = "UPDATE users SET email='$email',username='$uname',pass='$pass' WHERE uid=$uid";
        $result = $conn->query($sql);
    }
    $uid=$_GET['uid'];
    $sql = " SELECT email,pass,username FROM users WHERE uid= $uid";
    $result = $conn->query($sql);
    $result=$result->fetch_assoc();

?>
<!------ Include the above in your HEAD tag ---------->
<div class="container" style="padding-top: 60px;margin-right:100px;">
  <h1 class="page-header">Edit Profile</h1>
  <div class="row">
    
    <div class="col-xs-12 personal-info ml-5 mt-5">
      
      <h3>Personal info</h3>
      <form method="post" class="form-horizontal" >
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
              
            <input name="email" class="form-control" value="<?php echo $result['email'] ?>" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-3 control-label">Username:</label>
          <div class="col-md-8">
            <input name="uname" class="form-control" value="<?php echo $result['username'] ?>" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <input name="pass" class="form-control" value="<?php echo $result['pass'] ?>" type="password">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input name="save" class="btn btn-primary" value="Save Changes" type="submit">
            <span></span>
           
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require('components/footer.inc.php'); ?>
 