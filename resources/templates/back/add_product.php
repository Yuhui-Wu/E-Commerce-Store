<?php add_product(); ?>
<div class="col-md-12">

<div class="row">
<h2>
   Add Product
</h2>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

    <div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" required>
       
    </div>

    <div class="form-group">

      <div class="col-xs-6">
        <label for="product-quantity">Product quantity</label>
        <input type="number" name="product_quantity" min="0"class="form-control" size="60">
      </div>
      <div class="col-xs-6">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" min="0" class="form-control" size="60" required>
      </div>
    </div>

    <div class="form-group">
           <label for="product_descriptor">Product Description</label>
      <textarea name="product_descriptor" id="" cols="30" rows="10" class="form-control"required></textarea>
    </div>    
    <div class="form-group">
    <label for="product-image">Product Image Url </label>
        <input type="text" name="product_image" class="form-control"required>
       
    </div>
</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product_category_id">Product Category</label>
          
        <select name="product_category_id" id="" class="form-control">
            <option value="">Select Category</option>
            <?php show_categories_add_product_page(); ?>

           
        </select>
        <hr>


</div>




<!-- Product Tags -->


    <div class="form-group">
          <label for="short-desc">Product short description</label>
        <input type="text" name="short_desc" class="form-control">
    </div>





</aside><!--SIDEBAR-->


    
</form>



                


