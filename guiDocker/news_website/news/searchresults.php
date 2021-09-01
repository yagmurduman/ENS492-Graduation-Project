<?php require('components/head.inc.php'); ?>
<?php require('components/navbar.inc.php'); ?>
<?php include('config.php'); ?>
<?php include('dbconfig.php'); ?>

<script type="text/javascript">
 document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#loader").style.display = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };

$(document).ready(function() {
  $('#loading').show();
});
    
</script>

<?php 

          if (isset($_GET['search_input'])){
        $word=$_GET['search_input'];
            $sql = "SELECT nid,nTitle,SUBSTR(nContent, 1, 200) AS nContent,nDate,img FROM  $news_table WHERE nTitle LIKE '% ". $word . "  %' OR nContent LIKE '% ". $word . " %' ";  
     
}

    $searchresult = $conn->query($sql);     
?>

<style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;}
          
          @keyframes spin {
              100% {
                  transform: rotate(360deg);
              }
          }
            
          .center {
              position: absolute;
              top: 0;
              bottom: 0;
              left: 0;
              right: 0;
              margin: auto;
          }
      </style>
      <div id="loader" class="center"></div>
     
  
  
  <div id="loading" style="display:none;margin-top:20px;" class="row justify-content-center">
  
<div class="col-8">
        <?php   if (isset($searchresult)): ?>
        <?php  foreach ($searchresult as $row):?>
        <div class="row ">
            <div style="cursor:pointer;" onclick="location.href='newspage.php?newsid='+<?php echo $row['nid'];?>" class="row news-card p-3 bg-white">
                <div class="col-md-4">
                    <div class="feed-image">
                    <?php $image = base64_encode(file_get_contents($row["img"])) ?>
                  
                 <img  class="news-feed-image img-fluid img-responsive" src="data:image/x-icon;base64,<?= $image?>" alt="">
                 </div>
                </div>
                <div class="col-md-8">
                    <div class="news-feed-text">
                        <h5><b><?php echo $row["nTitle"]; ?></b></h5><span>
                        <?php 
                        $var=html_entity_decode($row["nContent"]);
                        echo substr($var,5,strlen($var));
                        echo "..." ?><br></span>
                        <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                           
                                <div class="d-flex flex-column ml-2">
                                    <h6 class="username"></h6><span class="date"><?php echo date("F j, Y", strtotime($row["nDate"])); ?></span>
                                    </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <?php  endforeach?>
        <? else: ?>
                <h1>No results found!</h1>

        <?php  endif ?>
    </div>

    </div>

<?php require('components/footer.inc.php'); ?>