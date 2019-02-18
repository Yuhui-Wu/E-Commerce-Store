
<?php 

$customer = $_SESSION['id'];
$query = query("SELECT * FROM customers WHERE customer_id = {$customer} ");
confirm($query);

while($row = fetch_array($query)) {

$street         = escape_string($row['street']);
$city           = escape_string($row['city']);
$state          = escape_string($row['state']);
$zip_code       = escape_string($row['zip_code']);

}

 ?>
<?php update_address(); ?>

<div class="col-md-12">

<div class="row">
<h2>
   Edit Address
</h2>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

    <div class="form-group">
    <label for="stree">Street </label>
        <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
       
    </div>

        <div class="form-group">
    <label for="city">City </label>
        <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
       
    </div>

    <div class="form-group">
    <label for="state">State </label>
        <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
       
    </div>

    <div class="form-group">
    <label for="zip_code">Zip Code </label>
        <input type="text" name="zip_code" class="form-control" value="<?php echo $zip_code; ?>">
       
    </div>




</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="update">
    </div>


     <!-- Product Categories-->



</div>











</aside><!--SIDEBAR-->


    
</form>



                


