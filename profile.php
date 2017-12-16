<?php
require_once 'core/init.php';

include('includes/header.php');

$username= input::get('username');
	$user= new user($username);
	if(!$user->exists()){
		Redirect::to(404);
		 } else {
			$data = $user->data();
		
		?>
<div class="row">
<div id="menu">
<nav>
<div class="wrap-nav">
   <ul>
	 <li class="active"><a href="index.php">Home</a></li>
	 <li><a href="update.php">Update Info</a></li>
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
	<center><h2>Profile</h2></center>
</div>
<center>
<h3>Welcome <?php echo escape($data->username); ?></h3>
<p>Full Name: <?php echo escape($data->name); ?></p>
<p>Favourite Category: 
	<?php 
		$conn=DB::getInstance()->get('category',array('id','=', $data->fav_cat_id));
		foreach ($conn->results() as $row) { 
		echo escape($row->name); 
		}
		?>
</p>
	<?php
	}
	?>
</center>
<?php include('includes/footer.php'); ?>