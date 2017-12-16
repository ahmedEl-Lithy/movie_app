<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'core/init.php';
require_once("classes/dbcontroller.php");
include('includes/header.php');
$user = new user();
if(!$user->isLoggedIn()){
		Redirect::to('login.php');
}
$data = $user->data();
$id=$data->id;
$cate_id = $data->fav_cat_id;
$db_handle = new DBController();
$item_total=-1;
$conn=DB::getInstance()->get('category',array('id','=',$cate_id));
foreach ($conn->results() as $row) { 
	$cat_name = $row->name;
}

if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			$productByCode=DB::getInstance()->get('added_movies',array('id','=', $_GET["id"]));
			if(!empty($_POST["quantity"])&&$productByCode[0]["quantity"]>=$_POST["quantity"]) {
				$itemArray = array($productByCode[0]["id"]=>array(
				'name'=>$productByCode[0]["name"], 
				'id'=>$productByCode[0]["id"], 
				'quantity'=>$_POST["quantity"], 
				'discount'=>$productByCode[0]['discount'], 
				'price'=>$productByCode[0]["price"]));
				
				if(!empty($_SESSION["cart_item"])) {
					$id=$productByCode[0]["id"];
					$f=0;
					foreach($_SESSION["cart_item"] as $k => $v)
						if($id == $v["id"] )
						{
							$f=1;
							break;
						}
						if($f==1){
						$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
						}else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}else{
				echo "Sorry quantity of ".$productByCode[0]["name"]. " is more than available";
			}
		break;
	//---------------------------------------------------------------------------------
		case "remove":
			if(!empty($_SESSION["cart_item"])) {
				$r=-1;
				foreach($_SESSION["cart_item"] as $k => $v)
				{
					if($_GET["id"] == $v['id'])
						$r=$k;
					}
					if($r!=-1)
						{
						unset($_SESSION["cart_item"][$r]);				
						if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
					}
				}
		break;
	//---------------------------------------------------------------------------------
		case "empty":
			unset($_SESSION["cart_item"]);
		break;	
	}
}
?>
<HTML>
<HEAD>
	<TITLE>Simple PHP Shopping Cart</TITLE>
	<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
    <div class="row">
        <div id="menu">
            <nav>
		<div class="wrap-nav">
		   <ul>
			 <li class="active"><a href="index.php">Home</a></li>
			 <li><a href="profile.php">Profile</a></li> 
		   	 <li><a href="logout.php">logout</a></li>
		   </ul>
	   </div>
	   </div>
	<div id="shopping-cart">
		<div class="txt-heading"><center>Shopping Cart<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a></div>
       <form method="get" action="search.php" id="search"  style="float:right">
            <input name="q" type="text" size="40" placeholder="Name..."/>
            <input type="submit" value="Search">
        </form>
        <br><br>
        <?php
		if(isset($_SESSION["cart_item"])){
		    $item_total = 0;
		?>	
		<table cellpadding="10" cellspacing="1">
		<tbody>
		<tr>
		<th><strong>Name</strong></th>
		<th><strong>id</strong></th>
		<th><strong>Quantity</strong></th>
		<th><strong>Price</strong></th>
		<th><strong>Discount</strong></th>
		<th><strong>Action</strong></th>
		</tr>	
		<?php foreach ($_SESSION["cart_item"] as $item=>$v){ ?>
		<tr>
		<td><strong><?php echo $v["name"]; ?></strong></td>
		<td><?php echo $v["id"]; ?></td>
		<td><?php echo $v["quantity"]; ?></td>
		<td align=right><?php echo "$".$v["price"]; ?></td>
		<td><?php echo "$".$v["discount"]; ?></td>
		<td><a href="cart.php?action=remove&id=<?php echo $v["id"]; ?>" class="btnRemoveAction">Remove Item</a></td>
		</tr>
		<?php
			$dis_cost=0;
			if($v["discount"]>0){
				$dis_cost=($v["price"]*$v["discount"])/100;
			}
			$item_total += (($v["price"]-$dis_cost)*$v["quantity"]);

			$_SESSION["tot"]=$item_total;
			}
		?>
		<tr>
		<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
		</tr>
		</tbody>
		</table>		
	 	<?php } ?>
	</div>
	<?php
	if($item_total>0){
	?>
	<form action="pay_details.php" method="">
 	 <center><input type="submit" value="pay" class="btnAddAction"></center>
	</form>
	<?php } ?>
	<div id="product-grid">
	<center>
		<div class="txt-heading">
			<a href="fav_cat.php" style="color:black;">Show Favourite Category</a>
			<p>Products</p>
		</div>
	</center>
	<?php
		$product_array = $db_handle->runQuery("SELECT * FROM added_movies WHERE category='" . $cat_name . "'");
		if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
			$temp = $product_array[$key]["name"];
			$name = str_replace(' ', '', $temp); 
		?>
			<div class="product-item">
			<center>
			<a href="movie.php?id=<?php echo $product_array[$key]["id"]; ?>"><img src="images/posters/<?php echo $name; ?>.jpg"></a>
				<div class="info">
				<form method="post" action="cart.php?action=add&id=<?php echo $product_array[$key]["id"]; ?>">
				<div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
				<div><strong>avaliable quantity <?php echo $product_array[$key]["quantity"]; ?></strong></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<div><strong>Discount : <?php echo "%".$product_array[$key]["discount"]; ?></strong></div>
				<div>
					<input type="text" name="quantity" value="1" size="2" />
					<input type="submit" value="Add to cart" class="btnAddAction" />
				</div>
				</form>
				</div>
			</div>
		<?php
			}
		}else{
			echo "No movies In that category";
		}
		?>
	</div>
	</div>
	</nav>
	</div>
	</div>
	<div id="pagination" style="clear: both;">
</div>
<?php include('includes/footer.php'); ?>
