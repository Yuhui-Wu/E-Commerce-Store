
<?php 


if(isset($_GET['id'])) {


$query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
confirm($query);

while($row = fetch_array($query)) {

$product_title          = escape_string($row['product_title']);
$product_category_id    = escape_string($row['product_category_id']);
$product_price          = escape_string($row['product_price']);
$product_descriptor     = escape_string($row['product_descriptor']);
$short_desc             = escape_string($row['short_desc']);
$product_quantity       = escape_string($row['product_quantity']);
$product_image          = escape_string($row['product_image']);
    }

update_product();

}

 ?>

<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Product
</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

    <div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
       
    </div>

    <div class="form-group">

      <div class="col-xs-6">
        <label for="product-quantity">Product quantity</label>
        <input type="number" name="product_quantity" min="0"class="form-control" size="60" value="<?php echo $product_quantity; ?>">
      </div>
      <div class="col-xs-6">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" min="0" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>

    <div class="form-group">
           <label for="product_descriptor">Product Description</label>
      <textarea name="product_descriptor" id="" cols="30" rows="10" class="form-control" ><?php echo $product_descriptor; ?></textarea>
    </div>    
    <div class="form-group">
    <label for="product-image">Product Image Url </label>
        <input type="text" name="product_image" class="form-control" value="<?php echo $product_image; ?>">
       
    </div>
</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product_category_id">Product Category</label>
          
        <select name="product_category_id" id="" class="form-control">
            <option value="<?php echo $product_category_id; ?>"><?php echo show_product_category_title($product_category_id); ?></option>

            <?php show_categories_add_product_page(); ?>
           
        </select>
        <hr>


</div>




<!-- Product Tags -->


    <div class="form-group">
          <label for="short-desc">Product short description</label>
        <input type="text" name="short_desc" class="form-control" value="<?php echo $short_desc; ?>">
    </div>





</aside><!--SIDEBAR-->


    
</form>



                


