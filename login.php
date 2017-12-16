<?php
require_once 'core/init.php';
$user = new user();
if($user->isLoggedIn()){ Redirect::to('index.php'); }

if(input::exists()){
 if(token::check(input::get('token'))){

 	$validate=new Validate();
 	$validation=$validate->check($_POST, array(
 		'Name' => array('required' => true),
 		'password' => array('required' => true)


 	));
 	if($validation->passed()){
 		$user = new user();

 		$remember = (input::get('remember') === 'on') ? true : false;
 		$login= $user->login(input::get('Name'), input::get('password'), $remember);
 		if($login){
 			redirect::to('profile.php');
 		} else {
 			echo '<p>Sorry, logging in failed.</p>';
 			?> you can register if you have not account<a href="register.php"> REGISTER</a><?php
 		}
 	} else{
 		foreach($validation->errors() as $error){
 			echo $error, '<br>';
 		}

 	}

 }
}

?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Movie Store</title>
    <link rel="stylesheet" href="css/style2.css">
 <link rel="stylesheet" href="css/style3.css">
  </head>
  <body>
<div class="pen-title">
  <h1>Welcome To Our Movie Store</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <form class="reg_form" action="" method="post">
    		
    		<div class="input-container">
				<input type="text" class="inpue-larg" name="Name" id="Name" autocomplete="off" placeholder="Name...">
      			<label for ="Name"></label>
			</div>
    		
    		<div class="input-container">
				<input type="password" class="inpue-medium" name="password" id="password" autocomplete="off" placeholder="Password...">
      			<label for ="password" class="inpue-medium"></label>
			</div>
			
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
      <center><button class="button button1" type="submit" value="log in">Log In</button></center>
			
		</form>
	</div>
</body>
</html>