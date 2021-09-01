<?php
include('config/db_connect.php');
include('config/config_cont.php');

?>
<nav class="navbar navbar-expand-lg py-3 navbar-light fixed-top" style="background-color: #F5F5F5;" >
    <div class="container">
        <a class="brand-name" style="color: black" href="index.php"><?php echo $company_name; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php#home">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="btn btn-success my-2 my-sm-0" href="./register.php" role="button">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success my-2 my-sm-0" href="./login.php" role="button">Login</a>
                    </li>
                <?php else : ?>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="./user.php?user=<?php echo $_SESSION['user']['id']; ?>" role="button">
                                <strong><?php echo $_SESSION['user']['username']; ?></strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="index.php?logout=true">Logout</a>

                        </li>

                    <?php endif ?>

                <?php endif ?>
            </ul>
        </div>
    </div>
    </div>
</nav>