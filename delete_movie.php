<?php 
require_once 'core/init.php';
include('includes/header.php');
$user = new user();
if(!$user->isLoggedIn()){
        Redirect::to('login.php');
}
$data = $user->data();
$id=$data->id;
$movie=DB::getInstance()->get('added_movies',array('seller_id','=',$id));
    if($movie->count()){
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
            <center><h2>DELETE MOVIE</h2></center>
        </div>
        <center>
 <table class="table" border="1" style="width:100%">
     <thead>
              <tr>
                <th>Id</th>
                <th>Movie</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Type</th>
                <th>Price</th>
                <th>Year Of Production</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
      <?php foreach ($movie->results() as $m) { ?>
             <tr>
             <td><?php echo $m->id;?></td>
             <td><?php echo $m->name;?></td>
             <td><?php echo $m->quantity;?></td>
             <td><?php echo $m->category;?></td>
             <td><?php echo $m->type;?></td>
             <td><?php echo $m->price;?></td>
             <td><?php echo $m->yearofproduction;?></td>
             <form action ="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $m->id;?>">
            <td> <button class="button button1" type="submit" name="Delete" value="delete">Delete</button></td>
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