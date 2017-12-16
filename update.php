<?php
require_once 'core/init.php';

$user= new user();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

if(input::exists()){
	if(token::check(input::get('token'))){

		$validate= new validate();
		$validation= $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			),
			'fav' => array(
				'required'=> true
				)

		));
		if($validation->passed()){
			try{
				$user->update(array(
					'name' => input::get('name'),
					'fav_cat_id' => input::get('fav')

					));
				session::flash('home', 'your details have been updated');
				Redirect::to('fav_cat.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}


		} else {
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}

		}
	}
}

include('includes/header.php');

?>

<div class="row">
	<div id="menu">
		<nav>
			<div class="wrap-nav">
			   <ul>
				 <li class="active"><a href="index.php">Home</a></li>
				 <li><a href="contact.html">CONTACT</a></li>
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
			<center><h2>UPDATE INFO</h2></center>
		</div>
		<center>
<form action="" method="post">
<div class="field">
	<h3>Name: <input type="text" required  name="name" value="<?php echo escape($user->data()->name); ?>">

	<button class="button button1" type="submit" value="update">Update</button></h3>
	<h3>Favourite Category:</h3>
	<?php
		$conn=DB::getInstance()->get('category',array());
		foreach ($conn->results() as $row) { 
			$cat_id = $row->id;
			?>
			<input type='radio' required name='fav' value="<?php echo $row->id; ?>"><?php echo $row->name; ?><br>
		<?php } ?>
	<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
</div>
</form>

</center>
</div>
		</div>
	</div>
<?php include('includes/footer.php'); ?>