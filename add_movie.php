<?php 
	require_once 'core/init.php';
	$user = new user();
	if(!$user->isLoggedIn()){
			Redirect::to('login.php');
	}

	$data = $user->data();
	$id=$data->id;
	if(input::exists()){
		if(token::check(input::get('token'))){
		// In an application, this could be moved to a config file
		$upload_errors = array(
			// http://www.php.net/manual/en/features.file-upload.errors.php
		  UPLOAD_ERR_OK 				=> "No errors.",
		  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
		  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
		  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
		  UPLOAD_ERR_NO_FILE 		=> "No file.",
		  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
		  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
		  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
		);

		$tmp_file = $_FILES['file_upload']['tmp_name'];
		$temp = basename(input::get('name'));
		$target_file = str_replace(' ', '', $temp.".jpg");
		$upload_dir = "images/posters";
	  	move_uploaded_file($tmp_file, $upload_dir."/".$target_file);

		$conn=DB::getInstance();
		$fields=array(
				'name' => input::get('name'),
				'quantity' => input::get('quant'),
				'category'=>input::get('cat_movie'),
	            'type' => input::get('type'),
				'seller_id' => $id,
				'price' => input::get('price'),
				'yearofproduction' => input::get('date'),
				'status'=>'new',
				'poster_name'=>$target_file,
				'description' => input::get('description'),
				'discount' => input::get('discount')
			);
		try{
			$conn->insert('added_movies',$fields);
		} catch(Exception $e){
			die($e->getMessage());
		}
		}
	}
	include('includes/header.php');		
?>

<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>

<?php
if( input::get('name')!="")
{
?>
<div class="alert success">
  <span class="closebtn">X</span>  
  <strong>Success! </strong>successful add.
</div>
<?php } ?>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>

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
			<center><h2>ADD MOVIE</h2></center>
		</div>
		<center><form action ="" enctype="multipart/form-data" method="post">
		Movie Name:<br><input type="text" name="name" required><br>
  		Quantity:<br><input type="number" name="quant" min='1'required><br>
		
		Category: 
	    <select name="cat_movie" required>
		    <option value="comedy">Comedy</option>
		    <option value="horror">Horror</option>
		    <option value="tragedy">Tragedy</option>
		    <option value="action">Action</option>
		    <option value="drama">Drama</option>
		</select><br>
		Movie Type:&nbsp;
		  <input type="radio" name="type" value="dvd" required> DVD &nbsp;
		  <input type="radio" name="type" value="video"required> Video<br>
		Price:<br><input type="number" name="price" min='1'required><br>
		Discount:<br><input type="number" name="discount" min='0' max='100'required><br>
		Year Of Production:<br><input type="date" data-date-inline-picker="true" required name="date"/><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
   	    Movie Poster:<br><input required type="file" name="file_upload" /><br>
		Description :<br><textarea name="description" cols="40" rows="8" required></textarea><br>
  		
		  
		<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
		<button class="button button1" type="submit" onclick="return confirm('Are u sure?');" value="add">Add</button>
		
		</center></form>
		</div>
		</div>
	</div>
<?php include('includes/footer.php'); ?>