<?php
require_once 'core/init.php';

DB::getInstance()->update('users',$_POST['id'],array('user_type'=>'1'));

Redirect::to('role.php');
?>