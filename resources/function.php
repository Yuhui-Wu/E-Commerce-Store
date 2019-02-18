<?php

// helper functions
function last_id(){

global $connection;

return mysqli_insert_id($connection);


}

function set_message($msg) {
	if (!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}


//get location
function redirect($location){

	header("Location: $location ");
}

//connect to database and get sql query
function query($sql) {

	global $connection;
	return mysqli_query($connection, $sql);
}

//check the error
function confirm($result) {
	global $connection;
	if(!$result) {
		die("QUERY FAILED " . mysqli_error($connection));
	}
}

function escape_string($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}

/***************************Front End Function**************************/
//get products

function get_products() {

$query = query(" SELECT * FROM products");

confirm($query);

while ($row = fetch_array($query)) {
    $product = <<<DELIMETER
	<div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
	            <div class="caption">
	            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
	            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
	            </h4>
	            <p>{$row['short_desc']}</p>
	            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">ADD TO CART</a>
        	</div>
        </div>
    </div>

DELIMETER;
	echo $product;
}
}

function get_categories(){
	$query = query("SELECT * FROM categories");
	confirm($query);

	while ($row = mysqli_fetch_array($query)) {

$category_links = <<<DELIMETER
<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;
	echo $category_links;

    }
}

function get_products_catpage() {

	$query = query(" SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");

confirm($query);

while ($row = fetch_array($query)) {
    $product = <<<DELIMETER
    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}  &#36;{$row['product_price']}  </h3>
                <p>{$row['short_desc']}</p>
                <p>
	            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>

DELIMETER;
	echo $product;
}
}

function get_products_shoppage() {
	if (isset($_POST['submit'])) {
		$product_title = escape_string($_POST['product_title']);
		$query = query(" SELECT * FROM products WHERE product_title LIKE '%{$product_title}%' ");}
	elseif (isset($_POST['priceup'])) {
		$query = query(" SELECT * FROM products ORDER BY product_price ASC");
	}
	elseif (isset($_POST['pricedown'])) {
		$query = query(" SELECT * FROM products ORDER BY product_price DESC");
	}
	elseif (isset($_POST['newest'])) {
		$query = query(" SELECT * FROM products ORDER BY product_id DESC");
	}
		
	else {
		$query = query(" SELECT * FROM products ");

		}
		confirm($query);

while ($row = fetch_array($query)) {
    $product = <<<DELIMETER
    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>&#36;{$row['product_price']}</p>
                <p>
	            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>

DELIMETER;
	echo $product;
}
}


function login_manager() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		$query = query("SELECT * FROM salesperson WHERE sales_name = '{$username}' AND sales_password = '{$password}'");
		confirm($query);

		if (mysqli_num_rows($query) == 0) {
			redirect("login.php");
			set_message("Your password or username are wrong!");
		} else {
			$_SESSION['username'] = $username;
			redirect("admin");
		}
	}
}

function login_customer() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		$query = query("SELECT * FROM customers WHERE customer_name = '{$username}' AND customer_password = '{$password}'");
		confirm($query);


		if (mysqli_num_rows($query) == 0) {
			redirect("login_cus.php");
			set_message("Your password or username are wrong!");
		} else {
			$row = fetch_array($query);
			$_SESSION['id'] = $row[customer_id];
			$_SESSION['username'] = $username;
			redirect("profile");
		}
	}
}

/*************display order****************/
function display_orders(){

$query = query("SELECT * FROM orders");
confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>&#36;{$row['order_amount']}</td>
    <td>{$row['order_date']}</td>    
    <td>{$row['order_status']}</td>    
    <td>{$row['customer_id']}</td>
    <td>{$row['salesperson_id']}</td>

    <td><a class="btn btn-primary" href="view_order.php?id={$row['order_id']}">View Detail</a></td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>




DELIMETER;

echo $orders;



    }



}

function customer_orders(){
	$customer = $_SESSION['id'];

$query = query("SELECT * FROM orders,salesperson WHERE customer_id = {$customer} AND orders.salesperson_id = salesperson.salesperson_id");
confirm($query);

while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>&#36;{$row['order_amount']}</td>
    <td>{$row['order_date']}</td>    
    <td>{$row['order_status']}</td>    
    <td>{$row['sales_name']}</td>

    <td><a class="btn btn-primary" href="view_order_cus.php?id={$row['order_id']}">View Detail</a></td>
</tr>




DELIMETER;

echo $orders;



    }



}

function order_detail(){
	if(isset($_GET['id'])) {
		$query = query("SELECT o.order_id, o.quantity, p.product_title,p.product_price  FROM orderitem o,products p WHERE order_id = " . escape_string($_GET['id']) . " AND o.product_id = p.product_id ");
		confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['product_title']}</td>
    <td>&#36;{$row['product_price']}</td>    
    <td>{$row['quantity']}</td>    
</tr>




DELIMETER;

echo $orders;



    }


}

}

/*************show sales person************/
function show_salesperson_name(){


$query = query("SELECT * FROM salesperson");
confirm($query);

while($row = fetch_array($query)) {


$salesperson_options = <<<DELIMETER

 <option value="{$row['salesperson_id']}">{$row['sales_name']}</option>


DELIMETER;

echo $salesperson_options;

     }



}

/**************place order****************/
function place_order() {
	if(isset($_POST['placeorder'])) {
$order_date             = date("Y-m-d");
$customer_id            = $_SESSION['id'];
$salesperson_id         = escape_string($_POST['salesperson_id']);
$order_status           = "process";
$order_amount           = $_SESSION['item_total'];

$query = query("INSERT INTO orders(order_date, customer_id, salesperson_id, order_status, order_amount) VALUES('{$order_date}', '{$customer_id}', '{$salesperson_id}', '{$order_status}', '{$order_amount}')");
confirm($query);
$last_id = last_id();

foreach ($_SESSION['id_array'] as $key => $value) {
	$order_item = query("INSERT INTO orderitem(order_id, product_id, quantity) VALUES($last_id,$key,$value)");
	confirm($order_item);
	$order_quantity = query("UPDATE products SET product_quantity = product_quantity - $value WHERE product_id = $key");
	confirm($order_quantity);
}

redirect("thank_you.php");




        }

}   

/**************view product***************/
function get_products_in_admin(){


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$category = show_product_category_title($row['product_category_id']);

$product = <<<DELIMETER

        <tr>
            <td>{$row['product_id']}</td>
            <td>

             <a href="index.php?edit_product&id={$row['product_id']}"><p>{$row['product_title']}</p></a>

            </td>
            <td>{$category}</td>
            <td>&#36;{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $product;


        }





}


function show_product_category_title($product_category_id){


$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
confirm($category_query);

while($category_row = fetch_array($category_query)) {

return $category_row['cat_title'];

}



}      

/***************************updating product code ***********************/
function update_product() {


if(isset($_POST['update'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_descriptor     = escape_string($_POST['product_descriptor']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);



$query = "UPDATE products SET ";
$query .= "product_title            = '{$product_title}'        , ";
$query .= "product_category_id      = '{$product_category_id}'  , ";
$query .= "product_price            = '{$product_price}'        , ";
$query .= "product_descriptor       = '{$product_descriptor}'  , ";
$query .= "short_desc               = '{$short_desc}'           , ";
$query .= "product_quantity         = '{$product_quantity}'     , ";
$query .= "product_image            = '{$product_image}'          ";
$query .= "WHERE product_id=" . escape_string($_GET['id']);





$send_update_query = query($query);
confirm($send_update_query);
set_message("Product has been updated");
redirect("index.php?products");


        }


}
/***************************Add Products *************************/
function add_product() {
	if(isset($_POST['publish'])) {
$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_descriptor     = escape_string($_POST['product_descriptor']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_POST['product_image']);

$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity, product_descriptor, short_desc, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_quantity}', '{$product_descriptor}', '{$short_desc}', '{$product_image}')");
$last_id = last_id();
confirm($query);

set_message("New Product with id {$last_id} was Added");
redirect("index.php?products");




        }

}

function show_categories_add_product_page(){


$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {


$categories_options = <<<DELIMETER

 <option value="{$row['cat_id']}">{$row['cat_title']}</option>


DELIMETER;

echo $categories_options;

     }



}

/*************** Add Customers *****************/
function add_customer() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$email = escape_string($_POST['email']);
		$password = escape_string($_POST['password']);
		$query = query("INSERT INTO customers(customer_name,customer_email,customer_password) VALUES('{$username}', '{$email}', '{$password}')");
		confirm($query);

$last_id = last_id();
confirm($query);

redirect("login_cus.php");




        }

}

/*****************Data Overview*******************/
function overview() {
$query = query("SELECT COUNT(*) AS total FROM orders");
confirm($query);

$re = fetch_array($query);
$_SESSION['total'] = $re['total'];

$query1 = query("SELECT SUM(order_amount) AS amount FROM orders");
confirm($query1);

$re = fetch_array($query1);
$_SESSION['amount'] = $re['amount'];

$query2 = query("SELECT COUNT(*) AS num FROM products");
confirm($query2);

$re = fetch_array($query2);
$_SESSION['num'] = $re['num'];
	
}

/*****************Edit Address******************/
function update_address() {


if(isset($_POST['update'])) {

$street         = $_POST['street'];
$city           = $_POST['city'];
$state          = $_POST['state'];
$zip_code       = $_POST['zip_code'];
$customer_id    = $_SESSION['id'];

$query = query("UPDATE customers SET street = '$street', city = '$city', state = '$state', zip_code = '$zip_code' WHERE customer_id = '$customer_id'");

$update_address = query($query);
redirect("index.php?edit_address");

        }

}

/*****************Add category*******************/
function show_categories_in_admin() {


$category_query = query("SELECT * FROM categories");
confirm($category_query);


while($row = fetch_array($category_query)) {

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


$category = <<<DELIMETER


<tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $category;



    }



}


function add_category() {

if(isset($_POST['add_category'])) {
$cat_title = escape_string($_POST['cat_title']);

if(empty($cat_title) || $cat_title == " ") {

echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";


} else {


$insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
confirm($insert_cat);
set_message("Category Created");



    }


    }




}
/*****************Display Users*****************/
function display_users() {


$salesperson_query = query("SELECT * FROM salesperson");
confirm($salesperson_query);

while($row = fetch_array($salesperson_query)) {

$user_id = $row['salesperson_id'];
$username = $row['sales_name'];
$email = $row['sales_email'];
$job = $row['job_title'];
$store = $row['store_id'];
$salary = $row['salary'];


$user = <<<DELIMETER


<tr>
    <td>{$user_id}</td>
    <td>{$username}</td>
     <td>{$email}</td>
     <td>{$job}</td>
     <td>{$store}</td>
     <td>{$salary}</td>

</tr>



DELIMETER;

echo $user;



    }



}



?>