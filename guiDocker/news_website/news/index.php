<?php include('config.php'); ?>
<?php include('dbconfig.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
    
    

    $sql = "SELECT nid,SUBSTR(nTitle, 1, 100) AS nTitle, nDate,img FROM  $news_table WHERE type=1 ORDER BY nDate ASC LIMIT 4";
    $headlines = $conn->query($sql);

    $sql = "SELECT nid,SUBSTR(nTitle, 1, 100) AS nTitle, SUBSTR(nContent, 1, 200) AS nContent, nDate,img FROM  $news_table WHERE type=1 ORDER BY nDate DESC LIMIT 4";
    $headlines2 = $conn->query($sql);


    $sql = "SELECT COUNT(*) FROM  $news_table WHERE type=0 ORDER BY nDate ASC";
    $count = $conn->query($sql);

    $sql = "SELECT nid,SUBSTR(nTitle, 1, 100) AS nTitle,nDate,img FROM  $news_table  WHERE type=2 ORDER BY nDate ASC LIMIT 3";
    $rightnews = $conn->query($sql);


    $sql = "SELECT nid,SUBSTR(nTitle, 1, 100) AS nTitle,nDate FROM  $news_table  WHERE type=3 ORDER BY nDate ASC LIMIT 9";
    $leftnews = $conn->query($sql);

    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  

    $results_per_page = 3;  
    $start_from = ($page-1) * $results_per_page;  

    $number_of_result = mysqli_fetch_row($count)[0];  
    
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page); 
    $sql = "SELECT nid,SUBSTR(nTitle, 1, 100) AS nTitle,  nDate,img FROM  $news_table WHERE type=0 ORDER BY nDate DESC LIMIT $start_from, $results_per_page";
    $pg_middle_column = mysqli_query($conn, $sql);  
        
    
    ?>

    <?php require('components/head.inc.php'); ?>
    <?php require('components/navbar.inc.php'); ?>

    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 80%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
          
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
    <div class="container justify-content-center" id="loading" style="display:none" >
            <div class="row " >
                <?php if (isset($headlines)): ?>
                    <?php foreach ($headlines as $head): ?>
                        <div class="col-md-3 mt-3 ">
                            <a style="border-radius: 10px;" onclick="location.href='newspage.php?newsid='+<?php echo $head['nid'];?>" href="javascript:;" class="widget widget-image">
                                <div   class="widget-image-cover">
                                    <?php $image = base64_encode(file_get_contents($head["img"])) ?>
                                    <img    src="data:image/x-icon;base64,<?= $image?>" alt="">
                                </div>
                                <div class="widget-image-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                                <p style="font-weight: bold;font-size:11px">
                                                <?php echo date("F j, Y g:i a", strtotime($head["nDate"])); ?>
                                                </p>
                                        </div>
                                    </div>
                                    <h5><?php echo $head["nTitle"];  ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>

<div class="row justify-content-center mt-3">
     <div class="col-md-6 ">
   
       
        <div   style="height:550px; background-color:#FFFFFF !important;border-radius: 10px;">
            <?php if (isset($pg_middle_column)): ?>
                 <?php foreach ($pg_middle_column as $mc): ?>
                     <div class=" row flex  justify-content-center"  style="height:150px;" >
                           <div class="col">
                               <div class="flex flex-row" ></div>
                                   <div style="cursor:pointer;" onclick="location.href='newspage.php?newsid='+<?php echo $mc['nid'];?>" class="row" >
                                        <div class="col-md-4">
                                            <div class="feed-image">
                                                <?php $image = base64_encode(file_get_contents($mc["img"])) ?>
                                                <img  class="mt-4 news-feed-image img-fluid img-responsive" src="data:image/x-icon;base64,<?= $image?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mt-4 news-feed-text">
                                                    <h5><b><?php echo $mc["nTitle"];  ?></b></h5>
                                                    <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                                                        <div class="d-flex flex-column ml-2">
                                                            <h6 class="username"></h6><span class="date"><?php echo date("F j, Y", strtotime($mc["nDate"])); ?></span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <div  class="flex ">
                <div   class="list-row " id="sortable" data-sortable-id="0" aria-dropeffect="move">
                     <?php if (isset($leftnews)): ?>
                        <?php foreach ($leftnews as $ln): ?>
                          <div style="backround:#F6F4F2;cursor:pointer;" onclick="location.href='newspage.php?newsid='+<?php echo $ln['nid'];?>" class="list-item" data-id="13" data-item-sortable-id="0" draggable="true" role="option" aria-grabbed="false" style="">
                            <div class="flex"> <a href="#"  class="text-color" data-abc="true"><?php echo $ln["nTitle"];   ?></a></div>
                                <div class="no-wrap">
                                    <div class="item-date text-muted text-sm d-none d-md-block"><?php echo date("g:i a", strtotime($ln["nDate"])); ?></div>
                                </div>
                                
                            </div>  
                          
                        <?php endforeach ?>
                    <?php endif ?>
                </div> 
            </div> 
     </div>  
     <div class="col-md-6" >
        <div  id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                      
                        <!-- Wrapper for slides -->
                        <div style="  cursor:pointer;border-radius: 10px;display: flex;" class="carousel-inner">
                    
                                 <?php if (isset($rightnews)): ?>
                                <?php $i=0; foreach ($rightnews as $rn): ?>
                                    <div class="carousel-item <?php if($i==0){echo "active";$i++;} ?>">
                                        <?php $image = base64_encode(file_get_contents( $rn["img"])) ?>
                                        <img style="display: flex;height:550px" onclick="location.href='newspage.php?newsid='+<?php echo $rn['nid'];?>" src="data:image/x-icon;base64,<?= $image?>" alt="<?php echo $rn['nTitle']?>">
                                        <div class="carousel-caption">
                                        <h3><?php echo $rn["nTitle"]?></h3>
                                        </div>
                                  </div>

                                <?php endforeach ?>
                                <?php endif ?>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>
         <div class="mt-3" style="display: grid;grid-gap: 5px;  grid-template-columns: repeat(2, 315px);grid-template-rows: (2, 340px) ;grid-auto-flow: row;">
                <?php if (isset($headlines2)): ?>
                    <?php foreach ($headlines2 as $head): ?>
                            
                            <div style="border-radius: 10px;cursor:pointer;" onclick="location.href='newspage.php?newsid='+<?php echo $head['nid'];?>" class=" news-card2 p-3 bg-white">
                                    <div class="col">
                                        <div class="row">
                                                        
                                                            <div class="feed-image">
                                                            <?php $image = base64_encode(file_get_contents($head["img"])) ?>
                                                                <img  style="height:150px" class="news-feed-image img-fluid img-responsive" src="data:image/x-icon;base64,<?= $image?>" alt="">
                                                            </div>   
                                                        
                                                            <div class="row">
                                                                <div class="news-feed-text  mt-3">
                                                                <h5 style="font-weight:200;font-size:15px;font-weight: bold;"><b><?php echo $head["nTitle"]; ?></b></h5>

                                                                <div class="d-flex flex-row justify-content-between align-items-center mt-2"></div>
                                                                <div class="d-flex flex-row ml-2">
                                                                    <span class="date"><?php echo date("F j, Y", strtotime($head["nDate"])); ?></span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                        </div>
                                        
                                </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
        </div>

    </div>

</div>
</div>
</div> 


<br>
<?php require('components/footer.inc.php'); ?>

</html>
