<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Sign Up</h1>
            <p class="text-center"><?php display_message(); ?></p>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">

                <?php add_customer(); ?>
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control" required></label>
                </div>
                <div class="form-group"><label for="">
                    email<input type="text" name="email" class="form-control" required></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control" required></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  


    </header>


        </div>

    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>




