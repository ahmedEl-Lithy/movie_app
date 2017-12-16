<?php include('includes/header.php'); ?>
    <div class="row">
        <div id="menu">
            <nav>
                <div class="wrap-nav">
    
<?php
    require_once'core/init.php';
    $user=new user();

    if($user->isloggedIn()){ 
    $data = $user->data();
    $user_id=$data->id;
    $user_type=$data->user_type;
        if ($user_type==1) {
            echo "<ul>
        <li><a href='role.php'>Change Role</a></li>    
        <li><a href='changepassword.php'>Change password</a></li>
        <li><a href='cart.php'>View all movies</a></li>
        <li><a href='status.php'>Update status</a></li>
        <li><a href='logout.php'>logout</a></li></ul><hr>";
        
        $user->view_all_movies();
            
        }elseif ($user_type==2) {
            echo "<ul><li><a href='add_movie.php'>add movie</a></li>
            <li><a href='offers.php'>Update movie</a></li>
            <li><a href='changepassword.php'>Change password</a></li>
            <li><a href='update.php'>update details</a></li>
            <li><a href='delete_movie.php'>Delete Movie</a></li>
            <li><a href='logout.php'>logout</a></li></ul><hr>
            <li><a href='delete_movie.php'>Delete Movie</a></li>";
         $user->view_movie_with_my_offers($user_id);
           
        }else{//customer
            Redirect::to('cart.php');
        }?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<?php include('includes/footer.php');
}else { ?>
    <a href="login.php">login</a></li> OR .... <a href="register.php">register</a>
    <h3>you could check our user manual<a href="user_help.php"> here</a></h3>
    <?php include('includes/footer.php'); }?>