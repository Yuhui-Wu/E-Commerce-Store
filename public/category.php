<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
             <h3>Enjoy your shopping!</h3>
            <p> </p>
 
        </header>

        <hr>

        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            <?php get_products_catpage(); ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>