<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h3>Search the product you like!</h3>
            <p> </p>
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" name="submit" value="Search">
                            </span>
                            <input type="text" name="product_title" class="form-control" placeholder="exp. pro">
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
            
                    <p> </p>

                    <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-default">Sort by:
                          </button>
                          <button type="submit" class="btn btn-info" name="newest">Newest
                          </button>
                          <button type="submit" class="btn btn-info" name="priceup">Price:$-$$
                          </button>
                          <button type="submit" class="btn btn-info" name="pricedown">Price:$$-$
                          </button>
                      </div>
               </form>     <!-- Split button -->


        </header>

        <hr>


        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            <?php get_products_shoppage(); ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>