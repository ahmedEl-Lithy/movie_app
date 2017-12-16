<?php
require_once 'core/init.php';

DB::getInstance()->update('added_movies',$_POST['id'],array('status'=>'old'));

Redirect::to('status.php');
?>