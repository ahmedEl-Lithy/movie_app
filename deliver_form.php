<?php 
require_once 'core/init.php';
include('includes/header.php');
$user = new user();
if(!$user->isLoggedIn()){ Redirect::to('login.php'); }
$data=$user->data();
$id=$data->id;
$orderid=0;
$old_quan=0;
$m_name="";
$cat="";
$type="";
$year="";
$ad="";
$mob="";
$em="";
if(input::exists()){
	if(token::check(input::get('token'))){
	$Validate=new validate();
	$validation=$Validate->check($_POST, array(
		'Address' => array(
			'required'=>true,
			'min'=>5,
			'max'=>50
			),
		));

	if($validation->passed()){
		$orders=DB::getInstance()->get('order_num',array('ct_id','=',$id));
		if($orders->count()){
			foreach ($orders->results() as $key) {
				$orderid=$key->id;
			}
		}
		 foreach ($_SESSION["cart_item"] as $item=>$v){
		 	try{
		 		DB::getInstance()->insert('order_details',array(
		 			'order_id'=>$orderid,
		 			'price'=>$v["price"],
		 			'movie_id'=>$v["id"],
		 			'quantity'=>$v["quantity"],
		 			'Address'=>$data->Address,
		 			'Mobile'=>$data->Mobile,
		 			'email'=>$data->email
		 			));
		 			$qu=DB::getInstance()->get('added_movies',array('id','=',$v["id"]));
		 			foreach ($qu->results() as $q) {
		 				$old_quan=$q->quantity;
		 				$type=$q->type;
		 				$year=$q->yearofproduction;
		 				$cat=$q->category;
		 				$m_name=$q->name;
		 			}
		 			
		 			 $new_quan=intval($old_quan)-intval($v["quantity"]);
		 			DB::getInstance()->update('added_movies',$v["id"],array(
		 				'name' => $m_name,
						'quantity' =>$new_quan,
						'category'=>$cat,
                		'type' =>$type ,
						'seller_id' => $data->id,
						'price' => $v["price"],
						'yearofproduction' => $year,
						'status'=>'new'
		 				));
		 			
		 	
		   } catch(Exception $e){
			die($e->getMessage());
	        }
	        
	   }

	   unset($_SESSION["cart_item"]);
	   unset($_SESSION["tot"]);
	  Redirect::to ('old_orders.php');
	}
	}
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SWE order Form</title>
 <link rel="stylesheet" href="css/style2.css">
 <link rel="stylesheet" href="css/style3.css">

  </head>

<div id="contact" class="container">
<div class="card"></div>
  <div class="card">
  <div class="toggle"></div>
    <h1 class="title">Delevery Info</h1>
      <div class="close"></div>

<div id="contact">
      <form action ="" method="post"> 
		<div class="input-container">
          <input type ="text" name="Address" value="<?php echo $data->Address; ?>" id="Address" required>
           <label for="name">* Address</label>
        </div>
        <div class="input-container">
          <input type ="text" name="Mobile"  value="<?php echo $data->Mobile; ?>" id="Mobile" required>
           <label for="name">* Mobile</label>
        </div>
        <div class="input-container">
           <input type ="text" name="email"  value="<?php echo $data->email; ?>" id="email" required>
           <label for="email">* E-mail</label>
        </div>
        <center><button class="button button1"><span>Make Order</span></button></center>
          <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
      </form> 
</div>
</div>
</div>
