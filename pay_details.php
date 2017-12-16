<?php
    require_once 'core/init.php';
    include('includes/header.php');
    $user=new user();
    if(!$user->isLoggedIn()){ Redirect::to('login.php'); }
   $data = $user->data();
   $id=$data->id;
    $tot= $_SESSION["tot"];
   $conn=DB::getInstance();
        $exist=DB::getInstance()->get('order_num',array('ct_id','=',$id));
        if(!$exist->count()){
		try{
			$conn->insert('order_num',array(
				'ct_id' => $id,
				'total' => $tot
			));
		}
		catch(Exception $e){
			die($e->getMessage());
		}
        }
        else{
            Redirect::to ('old_orders.php');
            }?>
            <style type="text/css">
            .button {
                 background-color: #4CAF50; /* Green */
                 border: none;
                 color: white;
                 padding: 15px 32px;
                 text-align: center;
                 text-decoration: none;
                 display: inline-block;
                 font-size: 16px;
}
            </style>

    pay by deliver : <br>
 <form action="deliver_form.php" method="post">
 	<input type="hidden" name="pay_action" value="deliver">
    <input type="submit" value="deliver details" class="button">
</form>
<br>
pay with paypal:
<br>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="ahmed@company.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <?php foreach($_SESSION["cart_item"] as $k => $v)
  {
  	?>
  <input type="hidden" name="item_name" value="<?php echo $v['name'];?>">
  <input type="hidden" name="amount" value="<?php echo $v['price'] * $v['quantity'];?>">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="return" value="wwww.onlinetuting.com/movie/paypal_success.php"/>
<?php
  }
  	?>
<input type="hidden" name="cancel_return" value="localhost/movie/paypal_cancel.php"/>

  <!-- Display the payment button. -->
  <input type="submit" name="submit" value="Pay with PayPal!" class="button">

</form>
<?php
include('includes/footer.php');
?>