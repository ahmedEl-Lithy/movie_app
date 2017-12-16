<?php 
require_once 'core/init.php';
$user = new user();
$e=array();
 $x=0;
if($user->isLoggedIn()){ Redirect::to('index.php'); }
if(input::exists()){
	if(token::check(input::get('token'))){

	$Validate=new validate();
	$validation=$Validate->check($_POST, array(
		'username' => array(
			'required'=>true,
			'min'=> 2,
			'max' => 20,
			'unique' => 'users'
		),
		'password' => array(
			'required'=>true,
			'min' => 6
		),
		'password_again' => array(
			'required' => true,
			'matches' => 'password'
		),
		'Address' => array(
			'required'=>true,
			'min'=>5,
			'max'=>50
			)
		));

	if($validation->passed()){
		$user= new user();

		$salt=Hash::salt(32);
		try{
			$user->create(array(
				'username' => input::get('username'),
				'password' => Hash::make(input::get('password'), $salt),
				'name'=>input::get('name'),
				'salt' => $salt,
                'email' => input::get('email'),
				'Address' => input::get('Address'),
				'Mobile' => input::get('Mobile'),
				'joined' => date('Y-m-d H:i:s'),
				'user_type'=>input::get('user_t')
			));
			$login= $user->login(input::get('username'), input::get('password'), $remember);
			Redirect::to('index.php');

		} catch(Exception $e){
			die($e->getMessage());
		}
	} else {
		
		foreach($validation->errors() as $error){
			$e[$x]=$error;
			$x++;

		}

	}

}}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SWE register Form</title>
 <link rel="stylesheet" href="css/style2.css">
 <link rel="stylesheet" href="css/style3.css">

  </head>
  <body>

<div id="contact" class="container">
<div class="card"></div>
  <div class="card">
  <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <?php
    if($x>0){
    	for ($i=0; $i<$x; $i++) { 
    		?><center><font color="red"><?php echo $e[$i];?></font></center><?php
    		echo '<br>';
    	
    	}
    	
    }
    ?>
      <form action ="" method="post">
      
		<div class="input-container">
	      <input type="text" name="name" id="input" id="name" value="<?php echo escape(input::get('name')); ?>" required>	
          <label for="username">name</label>
        </div>

    	<div class="input-container">
	      <input type="text" name="username" id="input" id="username" value="<?php echo escape(input::get('username')); ?>" required>	
          <label for="username">Username</label>
  		</div>

  		<div class="input-container">
          <input type ="text" name="email" id="input" value="<?php echo escape(input::get('email')); ?>" id="email" required>
          <label for="email">E-mail</label>
        </div>

        <div class="input-container">
          <input type ="password" name="password" id="input"  id="password" required>
          <label for="password">Enter your password</label>
      	</div>

    	<div class="input-container">  
          <input type ="password" name="password_again"  id="input" id="password_again" required>
          <label for="password_again">Confirm Password</label>
      	</div>
      	
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="radio" name="user_t" value="2">seller <br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="radio" name="user_t" value="3">customer <br><br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ** if you want to buy and offer movies for selling choose <font color="red">seller</font><br>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ** if you just want to buy movie or watch the movie choose <font color="red">customer </font><br><br>

      	

      	<div class="input-container">
          <input type ="text" name="Address" id="input" value="<?php echo escape(input::get('Address')); ?>" id="Address" required>
          <label for="name">Address</label>
      	</div>

      	<div class="input-container">
          <input type ="text" name="Mobile" id="input" value="<?php echo escape(input::get('Mobile')); ?>" id="Mobile" required>
          <label for="name">Mobile</label>
        </div>

          <input type="hidden" name="token" value="<?php echo token::generate(); ?>">

        <center><button class="button button1"><span>register</span></button></center>
       
    </form> 
</div>
</div>
</body>
</html>