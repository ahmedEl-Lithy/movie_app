<?php
require_once 'core/init.php';
if(DB::getInstance()->delete('order_details',array('movie_id','=',$_POST['id']))){
	Redirect::to('old_orders.php');
}
else{
	echo "not deleted";
	
}

