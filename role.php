
<?php 
require_once'core/init.php';

include('includes/header.php'); ?>
<div class="row">
        <div id="menu">
            <nav>
                <div class="wrap-nav">
          <?php
$user=new user();
   if($user->isloggedIn()){ 
    $data = $user->data();
    $user_id=$data->id;
    $user_type=$data->user_type;
        if ($user_type==1) {
         echo "<ul>
        <li><a href='index.php'>Admin Panel</a></li>
        <li><a href='changepassword.php'>Change password</a></li>
        <li><a href='status.php'>Update status</a></li>
        <li><a href='logout.php'>logout</a></li></ul><hr>";
        ?>
<table class='table' border='1' style='width:100%'>
<thead><tr>
            <th>id</th>
            <th>username</th>
            <th>name</th>
            <th>Type</th>
            <th> make admin</th>
          </tr></thead>
          <tbody>

          <?php $users=DB::getInstance()->get('users',array());
      	foreach ($users->results() as $row) {

      	if($row->user_type!='1'){

        echo "<tr><td>";
        echo $row->id;
    	echo "</td><td>";
    	echo $row->username;
    	echo "</td><td>";
    	echo $row->name;
    	echo "</td><td>";
    	if($row->user_type==2){
    		echo "seller";
    	}
    	if($row->user_type==3){
    		echo "customer";
    	}
    	echo "</td>";
    	?>
    	<td>
    	<form action ="change_role.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row->id;?>">
    	<?php
        echo "<button class='button button1' type='submit' name='change' value='admin'>admin</button></td>";
        ?>
        </form>
        </td>
        <?php
    }
    }
		}

		else{
			Redirect::to('includes/errors/404.php');
		}
	}
	else{
		Redirect::to('login.php');
	}
		?>
		</tbody>
		</table>
		</div>
		</nav>
		</div>
		</div>
		
<?php include('includes/footer.php'); ?>


        





