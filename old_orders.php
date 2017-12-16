<?php
	require_once 'core/init.php';
	include('includes/header.php');
	$conn=DB::getInstance();
	$user=new user();
	$data=$user->data();
	$id=$data->id;
	$orderid=0;
	$order=$conn->get('order_num',array('ct_id'.'=',$id));
	if($order->count()){
		foreach ($order->results() as $key ) {
			$orderid=$key->id;
		}
	}
	$movie_name="";
	$orders=$conn->get('order_details',array('order_id','=',$orderid));
	if($orders->count()){
		foreach ($orders->results() as $d_order) {
			$movie=$conn->get('added_movies',array('id','=',$d_order->movie_id));
			foreach ($movie->results() as $m ) {
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SWE order Form</title>
 	<link rel="stylesheet" href="css/style2.css">
 	<link rel="stylesheet" href="css/style3.css">
  </head>
  <body>
      <div class="row">
        <div id="menu">
            <nav>
                <div class="wrap-nav">
                <ul>
                <li><a href='cart.php'>Home</a></li>
                <li><a href='profile.php'>profile</a></li>
                <li><a href='logout.php'>logout</a></li>
                

                </ul><hr>";
        </div>
        </nav>
        </div>
        </div>
	<div id="contact" class="container">
		<div class="card"></div>
		<div class="card">
			  <div class="toggle"></div>
			  <h1 class="title">Delevery Info</h1>
		      <div class="close"></div>
			  <div id="contact">
			  <center>
			  <form action='delete_film.php' method="post">

 movie: <?php echo $m->name;
		}
		?> <br>price : <?php echo $d_order->price,$d_order->movie_id;?>

			      <input type="hidden" name="id" value="<?php echo $d_order->movie_id; ?>">
			      <center><button name="Delete" class="button button1"><span>Delete</span></button></center>
        	  </form>

        	  <center>
		      <form action='update_film.php' method="post">
			      Quantity : <input type="txt" name="q" value="<?php echo $d_order->quantity; ?>"><br>
			      Mobile : <input type="txt" name="m" value="<?php echo $d_order->Mobile; ?>"><br>
			      Email : <input type="txt" name="e" value="<?php echo $d_order->email; ?>"><br>
			      Address : <input type="txt" name="a" value="<?php echo $d_order->Address; ?>"><br>
			      <input type="hidden" name="id" value="<?php echo $d_order->d_id; ?>">
			      <button name="Update" class="button button1"><span>update</span></button>
        	  </form>
        	  </center>
        	  </center>
		      <?php } 
		  		} else{
					$conn->delete('order_num',array('ct_id','=',$id));
					Redirect::to ('cart.php');
				}
			  ?>
			</div>
		</div>
	</div>
</body>
</html>