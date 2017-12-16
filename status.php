<?php 
require_once 'core/init.php';
include('includes/header.php');
$user = new user();
if(!$user->isLoggedIn()){
        Redirect::to('login.php');
}
$data = $user->data();
$id=$data->id;
$movie=DB::getInstance()->get('added_movies',array('status','=','new'));
    if($movie->count()){
?>
<div class="row">
<div id="menu">
    <nav>
        <div class="wrap-nav">
           <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href='role.php'>Change Role</a></li>    
            <li><a href='changepassword.php'>Change password</a></li>
            <li><a href='cart.php'>View all movies</a></li>
            <li><a href='status.php'>Update status</a></li>
            <li><a href='logout.php'>logout</a></li></ul><hr>
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
            <center><h2>Update Status</h2></center>
        </div>
        <center>
 <table class="table" border="1" style="width:100%">
     <thead>
              <tr>
                <th>Movie</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Type</th>
                <th>Price</th>
                <th>Year Of Production</th>
                <th>Status</th>
                <th>Update</th>
              </tr>
              <tr></tr>
            </thead>
            <tbody>
      <?php foreach ($movie->results() as $m) { ?>
             <tr>
             <td><?php echo $m->name;?></td>
             <td><?php echo $m->quantity;?></td>
             <td><?php echo $m->category;?></td>
             <td><?php echo $m->type;?></td>
             <td><?php echo $m->price;?></td>
             <td><?php echo $m->yearofproduction;?></td>
             <td><?php echo $m->status?></td>
             <form action ="update_status.php" method="post">
            <input type="hidden" name="id" value="<?php echo $m->id;?>">
            <td> <button class="button button1" type="submit" name="Delete" value="delete">OLD</button></td>
             </form>
            <?php }
        }
        else{
            echo "there are not any movie... go to   ";?>
            <a href="add_movie.php">add movie</a><?php
            
        }
             ?>
             
            </tr>
      <?php echo "<br>";?>
</tbody>
</table>
</center>

        </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>