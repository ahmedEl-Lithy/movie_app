<?php
require_once 'core/init.php';
if(DB::getInstance()->delete('added_movies',array('id','=',$_POST['id']))){
	Redirect::to('delete_movie.php');
}
else{
	echo "not deleted";
	
}

