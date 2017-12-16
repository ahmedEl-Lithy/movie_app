<?php
	require_once 'core/init.php';

	$user= new user();
	if(!$user->isLoggedIn()){
		Redirect::to('index.php');
	}
	if(input::exists()){
		if(token::check(input::get('token'))){
			$validate=new validate();
			$validation= $validate->check($_POST, array(
				'password_current' => array(
					'required' => true,
					'min' => 6
					),
				'password_new' => array(
					'required' => true,
					'min' => 6
					),
				'password_new_again' => array(
					'required' => true,
					'min' => 6,
					'matches' => 'password_new'
					)
			));

			if($validation->passed()){
				if(Hash::make(input::get('password_current'), $user->data()->salt) !== $user->data()->password){
					echo 'Your current password is wrong';
				}else {
					$salt= Hash::salt(32);
					$user->update(array(
						'password' => Hash::make(input::get('password_new'), $salt),
						'salt'=> $salt
					));
					session::flash('home', 'Your password has been updated.');
					Redirect::to('index.php');
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
			<center><h2>CHANGE PASSWORD</h2></center>
		</div>
		<center>
<form action="" method="post">
<div class="field">
	<label for="password_current">Current password</label>
	<input type="password" name="password_current" id="password_current">
</div>

<div class="field">
	<label for="password_new">New password</label>
	<input type="password" name="password_new" id="password_new">
</div>

<div class="field">
	<label for="password_new_again">New password again</label>
	<input type="password" name="password_new_again" id="password_new_again">
</div>
<button class="button button1" type="submit" value="Change">Confirm</button>
		
<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
</form>
</center>
</div>
		</div>
	</div>
<?php include('includes/footer.php'); ?>