<?php require('components/head.inc.php'); ?>
<?php require('components/navbar.inc.php'); ?>
<?php include('config.php'); ?>
<?php include('dbconfig.php'); ?>
<?php 
 
    
    if (isset($_POST['save'])) {
        
        $title=$_POST['title'];
        $content=$_POST['content'];
        $date=$_POST['date'];
        $img=$_POST['img'];
        $type=$_POST['type'];

        $sql = "INSERT INTO $news_table (nid,nTitle,nContent,nDate,img,type) VALUES ('','$title','$content','$date','$img','$type')";
        $result = $conn->query($sql);
    }

?>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="padding-top: 60px;margin-right:100px;">
  <h1 class="page-header">Admin Page</h1>
  <div class="row">
    
    <div class="col-xs-12 personal-info ml-5 mt-5">
      
      <h3>Add News</h3>
      <form method="post" class="form-horizontal" >
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Title:</label>
          <div class="col-lg-8">
              
            <input name="title" class="form-control" value="" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-3 control-label">Content:</label>
          <div class="col-md-8">
            <input name="content" class="form-control" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Image:</label>
          <div class="col-md-8">
            <input name="img" class="form-control" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Date:</label>
          <div class="col-md-8">
            <input name="date" class="form-control" value="" type="date">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Type:</label>
          <div class="col-md-8">
            <input name="type" class="form-control" value="" type="text">
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
