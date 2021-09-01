<?php include('config.php'); ?>

<nav style="height:80px !important;box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color:<?php echo $navbar_color;?>" class="navbar navbar-expand-sm ">
  <div class="container-fluid ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-md-flex d-block flex-row mx-md-auto mx-0" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-5 mb-lg-1 ">
        <a style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $title_font_size;?>;color:<?php echo $navbar_text_color;?>!important;" class="navbar-brand" href="index.php"><?php echo $webtitle?></a>
      </ul> 
    </div>
  
    
  </div>
</nav>

<ul style="background-color:<?php echo $second_navbar_color;?>;box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
  <div  class="nav justify-content-center">  
    <li class="nav-item">
      <a class="nav-link active" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>" aria-current="page" href="searchresults.php?search_input=<?php echo strtolower($categ1);?>"><?php echo $categ1;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?>;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ2);?>"><?php echo $categ2;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ3);?>"><?php echo $categ3;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ4);?>"><?php echo $categ4;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ5);?>"><?php echo $categ5;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ6);?>"><?php echo $categ6;?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="font-family: <?php echo $font_family;?> ;font-size:<?php echo $navlink_font_size;?>;color:<?php echo $navlink_color;?>"  href="searchresults.php?search_input=<?php echo strtolower($categ7);?>"><?php echo $categ7;?></a>
    </li>
   
   
  </div>
</ul>

<?php include('dbconfig.php'); ?>

<?php 
  
    $sql = "SELECT nid,nTitle, nContent, nDate,img FROM $news_table WHERE type=4";
    $breakingnews = $conn->query($sql);
?>

<div class="row">
   

   
   
</div>

