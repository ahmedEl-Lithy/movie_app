<?php
require_once 'core/init.php';
include_once("includes/header.php");
?>

<HTML>
<HEAD>
    <TITLE>Search Results</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet"/>
</HEAD>
<BODY>
<div class="wrap-container zerogrid">
    <div id="main-content" class="col-2-3">
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

                <br><br>
                <!--      <?php
                /*        if(isset($_SESSION["cart_item"])){
                            $item_total = 0;
                            */ ?>
            <table cellpadding="10" cellspacing="1">
                <tbody>
                <tr>
                    <th><strong>Name</strong></th>
                    <th><strong>id</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Action</strong></th>
                </tr>
                <?php /*foreach ($_SESSION["cart_item"] as $item=>$v){ */ ?>
                    <tr>
                        <td><strong><?php /*echo $v["name"]; */ ?></strong></td>
                        <td><?php /*echo $v["id"]; */ ?></td>
                        <td><?php /*echo $v["quantity"]; */ ?></td>
                        <td align=right><?php /*echo "$".$v["price"]; */ ?></td>
                        <td><a href="cart.php?action=remove&id=<?php /*echo $v["id"]; */ ?>" class="btnRemoveAction">Remove Item</a></td>
                    </tr>
                    <?php
                /*                    $item_total += ($v["price"]*$v["quantity"]);
                                    $_SESSION["tot"]=$item_total;
                                }
                                */ ?>
               <tr>
                    <td colspan="5" align=right><strong>Total:</strong> <?php /*echo "$".$item_total; */ ?></td>
                </tr>
                </tbody>
            </table>
        <?php /*} */ ?>
    </div>
    <?php
                /*    if($item_total && $item_total>0){
                        */ ?>
        <form action="pay_details.php" method="">
            <center><input type="submit" value="pay" class="btnAddAction"></center>
        </form>
    <?php /*} */ ?>
    <div id="product-grid">
        <center>
            <div class="txt-heading">
                <a href="fav_cat.php" style="color:black;">Show Search Results</a>
                <p>Products</p>
            </div>
        </center>-->
                <?php
                $query = $_GET['q'];

                if (is_numeric($query)) {
                    $movie_data = DB::getInstance()->get('added_movies', array('yearofproduction', '=', $query));
                } else if (is_string($query)) {
                    $movie_data = DB::getInstance()->get('added_movies', array('name', '=', $query));
                }
                if ($movie_data && $movie_data->count()) {
                    echo '<div id="product-grid">';
                    foreach ($movie_data->results() as $row) {
                        $movie_name = $row->name;
                        $id = $row->id;
                        $quantity = $row->quantity;
                        $category = $row->category;
                        $price = $row->price;
                        $production_year = $row->yearofproduction;
                        $img = $row->poster_name;

                        $temp = $row->name;
                        $movie_name = str_replace(' ', '', $temp);


                        echo '
        <div class="product-item">

			<center>
				<a href="movie.php?id=' . $id . '"><img src="images/posters/' . $movie_name . '.jpg"></a>
				<div class="info">
					<form method="post" action="cart.php?action=add&id=' . $id . '">
					<div><strong>' . $movie_name . '</strong></div>
					<div><strong>avaliable quantity <?php echo $quantity; ?></strong></div>
					<div class="product-price"><?php echo "$".$price; ?></div>
					<div>
						<input type="text" name="quantity" value="1" size="2" />
						<input type="submit" value="Add to cart" class="btnAddAction" />
					</div>
					</form>
				</div>
			</center>
			</div>';
                    }
                } else {
                    echo "no result found";
                }
                ?>
            </div>
        </div>
    </div>
</div>

</BODY>
</html>
<?php include('includes/footer.php'); ?>




