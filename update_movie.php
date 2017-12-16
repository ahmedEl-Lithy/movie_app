<?php 
require_once 'core/init.php';
include('includes/header.php');

$user = new user();
if(!$user->isLoggedIn()){ Redirect::to('login.php'); }

$data = $user->data();
$user_id=$data->id;
if(input::exists()){
	if(token::check(input::get('token'))){
		$movie_id = intval($_GET['id']);
		$conn=DB::getInstance();
		try{
			$conn->update('added_movies',$movie_id,array(
				'name' => input::get('name'),
				'quantity' => input::get('quant'),
				'category'=>input::get('cat_movie'),
                'type' => input::get('type'),
				'seller_id' => $user_id,
				'price' => input::get('price'),
				'yearofproduction' => input::get('date'),
				'description'=> input::get('description'),
				'discount'=> input::get('discount')
			));
			Redirect::to('index.php');

		} catch(Exception $e){
			die($e->getMessage());
		}
	}
}
	$movie_id = intval($_GET['id']);
		$movie_data=DB::getInstance()->get('added_movies',array('id','=', $movie_id));
		if($movie_data->count()){
			foreach($movie_data->results() as $row){
			$movie_name=$row->name;
			$quantity=$row->quantity;
			$category=$row->category;
			$price=$row->price;
			$production_year=$row->yearofproduction;
			$description=$row->description;
			$discount=$row->discount;
			}
		}
?>
</div>
<div class="row">
	<div id="menu">
		<nav>
			<div class="wrap-nav">
			   <ul>
				 <li class="active"><a href="index.php">Home</a></li>
				 <li><a href="logout.php">logout</a></li>
			   </ul>
			</div>
		</nav>
	</div>
</div>
</div>
</header>
	<div class="wrap-container zerogrid">
	<div id="main-content" class="col-2-3">
	<div class="movie">
	<div class="title">
		<center><h2>UPDATE MOVIE</h2></center>
	</div>
	<center>
	<form action ="" method="post">
	Movie Name:<br><input type="text" name="name" required value="<?php echo $movie_name;?>"><br>
	Quantity:<br><input type="number" min="0" name="quant" required value="<?php echo $quantity;?>"><br>
	Category: 
	<select name="cat_movie">
		<option value="comedy">comedy</option>
		<option value="horror">Horror</option>
		<option value="tragedy">Tragedy</option>
	</select><br>
	Movie Type:&nbsp;
	<input type="radio" name="type" required value="dvd"> DVD &nbsp; <input type="radio" name="type" value="video"> Video<br>
	Price:<br><input type="number" type="number" min="1" required name="price"value="<?php echo $price;?>"><br>
	Year Of Production:<br><input type="date" required data-date-inline-picker="true"  name="date" value="<?php echo $production_year;?>"/><br>
	Discount:<br><input type="number" min="0" max="100" required name="discount"value="<?php echo $discount;?>"><br>
	description:<br><textarea type="description" required name="description" cols="40" rows="8"><?php echo $description;?></textarea><br>
	<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
	
	<button class="button button1" type="submit" value="update">Update</button>
	</form>
	</center>
			</div>
		</div>
	</div>
<?php include('includes/footer.php'); ?>