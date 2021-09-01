<?php
include('config/db_connect.php');
include('config/config_cont.php');
?>

<footer id="footer">

  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 footer-contact">
          <h3><?php echo $company_name; ?></h3>
          <p> <?php echo $address; ?> </p>
          <br>
          <p> <?php echo $phone; ?> </p>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#"><?php echo $bullet_1; ?></a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#"><?php echo $bullet_2; ?></a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#"><?php echo $bullet_3; ?></a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#"><?php echo $bullet_4; ?></a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#"><?php echo $bullet_5; ?></a></li>
          </ul>
        </div>

        

      </div>
    </div>
  </div>

  <div class="container d-md-flex py-4">

    <div class="mr-md-auto text-center text-md-left">
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $company_name; ?></span></strong>. All Rights Reserved
      </div>
    </div>
  </div>
</footer>

</body>

</html>