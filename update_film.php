<?php
require_once 'core/init.php';

$order_id=$_POST['id'];
$q=$_POST['q'];
$e=$_POST['e'];
$a=$_POST['a'];
$m=$_POST['m'];
$movie_id="";
$o_id="";
$price="";
$conn=DB::getInstance()->get('order_details',array('d_id','=',$order_id));
foreach ($conn->results() as $row) {
		 				$o_id=$row->order_id;
		 				$price=$row->price;
		 				$movie_id=$row->movie_id;
		 		}
		 		echo $order_id;

$con=DB::getInstance();
try{
	if($con->update('order_details',$order_id,array(
					'order_id' => $o_id,
					'price' => $price,
					'movie_id'=>$movie_id,
	                'quantity' =>$q,
					'Address' => $a,
					'Mobile' => $m,
					'email' => $e
				))){
		echo "done";
	}
	else{
		echo "fu*k ";
	}
} catch(Exception $e){
				die($e->getMessage());
			}
?>