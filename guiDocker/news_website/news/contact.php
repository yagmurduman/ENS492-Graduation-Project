<?php require('components/head.inc.php'); ?>
<?php require('components/navbar.inc.php'); ?>
<?php include('dbconfig.php'); ?>
<?php include('config.php'); ?>

    <section class="contact">
      <div class=" container mr-5 mt-5">
        <div class="row">
          <div class="col-md-6 mt-5 ">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <h1>Contact us:</h1>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Email address</label
              >
              <input  
                class="form-control"
                id="email"
                name="email"
                placeholder="name@example.com"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Leave a message:</label
              >
              <textarea
                name="msg" id="msg"
                class="form-control"
                rows="3"
              ></textarea>
            </div>
            <button type="submit"  name="submit" class="btn btn-outline-secondary">
              Send
            </button>
            </form>
            <?php
            if(isset($_POST["submit"])){
                  $time = date('Y-d-m H:i:s');
                  $db= mysqli_select_db($conn , "contentdb");
                  $email=$_POST['email'];
                  $msg=$_POST['msg'];
                  if(  $msg!="" and $email!=""){

                    $sql="INSERT INTO $contact_table (conid,condate,conemail,concontent) VALUES ('0','$time','$email','$msg')";
                    $result = $conn->multi_query($sql);
                    
                    if($result){
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> We have recieved your message!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
                    }
  
                    else{
                      echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> An error occured while submitting your message!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
  
                    }

                  }
                  else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong>  You should check in on some of those fields above.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                   </div>';

                  }
                
                 
            }
            ?>
          </div>
          <div class="col-md">
            <img src="img/handshake.svg" alt="Contact image" />
          </div>
        </div>
      </div>
    </section><?php require('components/footer.inc.php'); ?>