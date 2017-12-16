<?php
require_once 'core/init.php';
if(DB::getInstance()->delete('comment',array('id','=',$_POST['comm_id']))){
	echo "done";
	Redirect::to("movie.php?id=".$_POST['movie_id']);
}
else{
	echo "not deleted";
	
}

