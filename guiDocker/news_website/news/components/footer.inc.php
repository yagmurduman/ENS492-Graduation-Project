<?php include('config.php'); ?>
<footer class="bg-light text-center text-lg-start mt-5">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0 mt-4">
      <form  method="get" action='searchresults.php?search_input=<?php echo $_GET['search_input'];?>'>
                <div class="d-flex form-group has-search">
                    <input type="text" id="search_input" name="search_input" class="form-control" placeholder="Search">
                </div>   
        </form> 
      </div>
      <!--Grid column-->

      <!--Grid column-->

      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class=" mb-3">Have any questions?</h5>

        <ul class="list-unstyled">
          <li>
          
          <a style="font-family: <?php echo $font_family;?>; color:#31352E !important" href="contact.php">Contact us <i class="far fa-envelope"></i></a>
          
          </li>
          
        </ul>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
   
    <a class="text-dark"><?php echo $webtitle?></a>
  </div>
  <!-- Copyright -->
</footer>

  </body>

