<?php include('comments.php'); ?>
<?php include('config.php'); ?>
<?php include('dbconfig.php'); ?>
<?php require('components/head.inc.php'); ?>
<?php require('components/navbar.inc.php'); ?>

<?php 

  if( $_SESSION["loggedin"]== 0 ) 
  {
        $_SESSION["type"] = 2;
  }

  if (isset($_GET['newsid'])){
    $id=$_GET['newsid'];
  }

  $sql = "SELECT nTitle, nContent, nDate,img FROM $news_table WHERE nid=$id";
  $result = $conn->query($sql);

  $sql = "SELECT nid,nTitle, nContent, nDate,img FROM $news_table  WHERE type=2 LIMIT 5";
  $sidenews = $conn->query($sql);

  $sql = "SELECT tid,tname FROM $tags_table";
  $tags = $conn->query($sql);

  $sql = "SELECT name,ccontent, cDate FROM $comments_table WHERE nid=$id ";
  $comment_result = $conn->query($sql);

?>

<div style="margin-top:25px;" class="blog-single container gray-bg ">
    <div class="row justify-content-center">
        <div class="col-lg-9 mr-4 ml-4 m-px-tb">
        <?php if (isset($result)): ?>
            <?php foreach ($result as $row): ?>
                <article class="article">
                    <div class="article-title">
                            <h2><?php echo $row["nTitle"]; ?></h2>
                            <div class="media">
                                <div  style="color: #656565;font-size: 18px;font-style: italic;" class="media-body">
                                <span><?php echo date("F j, Y g:i a", strtotime($row["nDate"]));?></span>
                                </div>
                            </div>
                         </div>
                        <div>
                        <?php $image = base64_encode(file_get_contents($row["img"])) ?>
                        <img style="width:100% !important;height:auto !important;" src="data:image/x-icon;base64,<?= $image?>" alt="">
                        </div>
                        
                        <div class="article-content">
                        <?php 
                        $var=html_entity_decode($row["nContent"]);
                        echo substr($var,2,strlen($var)-6);
                         ?>
                              </div>
                    <?php endforeach ?>
            <?php endif ?>

           
        <!--- comments-->
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="col-md-12">    
                    <div class="blog-comment">
                        <h3 >Comments</h3><hr/>
                        <ul class="comments">
                        <div id="comments-wrapper">
                        <?php if (isset($comment_result)): ?>
                        <?php foreach ($comment_result as $comment): ?>
                        <li class="clearfix">
                            <div class="post-comments">
                            <p class="meta"><?php echo date("F j, Y g:i a", strtotime($comment["cDate"]));?>
                            <a href="#"><?php echo $comment["name"]; ?>
                            </a> says : <i class="pull-right">
                            <a href="#"></a></i></p>
                            <p><?php echo $comment["ccontent"]; ?></p>
                            </div>
                            </li>
                        <?php endforeach ?>
                        <?php endif ?>
                        </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form article-comment">
            <h4>Leave a Reply</h4>
                <form id="comment_form"  method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input name="comment_name" id="comment_name" placeholder="Name *" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="comment_text" id="comment_text" placeholder="Your message *" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                    
                    </div>
                        <div class="float-sm-right">
                            <div class="send">
                                <button id="submit_comment"  type="submit" name="submit" class="px-btn theme"><span>Submit</span> </i></button>
                            </div>
                        </div>
                </form>
             </div>
        </div>
        
        
</div>
</div>
<!-- Javascripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="scripts.js"></script>
<?php require('components/footer.inc.php'); ?>