<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header_cus.php"); ?>
<?php
if(!isset($_SESSION['username'])) {
    redirect("../../public");
}
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Database Overview</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <?php

                if ($_SERVER['REQUEST_URI']== "/ecom/public/profile/"|| $_SERVER['REQUEST_URI']== "/ecom/public/profile/index.php") {
                    include(TEMPLATE_BACK . "/orders_cus.php");
                }

                if(isset($_GET['orders_cus'])) {
                    include(TEMPLATE_BACK . "/orders_cus.php");
                }

                if(isset($_GET['edit_address'])) {
                    include(TEMPLATE_BACK . "/edit_address.php");
                }





                ?>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . "/footer.php"); ?>
