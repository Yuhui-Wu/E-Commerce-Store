<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header_cus.php"); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">
   Order Detail

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>Id</th>
           <th>product name</th>
           <th>price</th>
           <th>quantity</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <?php order_detail(); ?>
        </tr>

        

    </tbody>
</table>
</div>
        <a class="btn btn-primary" href="index.php?orders_cus">Back to Order List</a>
<? 

?>
<?php include(TEMPLATE_BACK . "/footer.php"); ?>
