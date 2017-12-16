<?php 
	require_once 'core/init.php';
	include('includes/header.php');

	$user = new user();
	if(!$user->isLoggedIn()){
			Redirect::to('login.php');
	}

	$data = $user->data();
	$id=$data->id;

?>
<div class="row">
	<div id="menu">
		<nav>
		<div class="wrap-nav">
		   <ul><li><a href='add_movie.php'>add movie</a></li>
            <li><a href='offers.php'>Update movie</a></li>
            <li><a href='changepassword.php'>Change password</a></li>
            <li><a href='update.php'>update details</a></li>
            <li><a href='delete_movie.php'>Delete Movie</a></li>
            <li><a href='logout.php'>logout</a></li></ul><hr>
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
			<center><h2>Offers</h2></center>
		</div>
		<center>
		<div class="row">
				
	<?php
		$offer=DB::getInstance()->get('added_movies',array('seller_id','=', $id));
		echo  '<h2>your Offers Info are : </h2>';
			
		if($offer->count()){
			foreach($offer->results() as $row){
			$movie_id=$row->id;
			$movie_name=$row->name;
			$production_year=$row->yearofproduction;
			echo '<ul><li><h3><a href="update_movie.php?id=',$movie_id,'">',$movie_name,'(',$production_year,')</a></h3></li></br></ul>';
			}
			session::put('seller_id', $id);

	     	
		}
	?>
	</div>
	</center>
	</div></div></div>

<?php include('includes/footer.php'); ?>