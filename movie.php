<?php require_once 'core/init.php'; 
  $user = new user();
  if(!$user->isLoggedIn()){
      Redirect::to('login.php');
  }
  $data = $user->data();
  $user_id=$data->id;
  $movie_id=$_GET['id'];
  $datetime = strftime("%Y-%m-%d %H:%M:%S", time());

  if(!empty($movie_id)) {
    $conn=DB::getInstance()->get('added_movies',array('id','=', $movie_id));
    if($conn->count()){
      foreach($conn->results() as $row){
      $poster = $row->poster_name;
      $movie_name = $row->name;
      $category = $row->category;
      $type = $row->type;
      $price = $row->price;
      $release = $row->yearofproduction;
      $description = $row->description;
      }
    }
  }

  //comment
  if(isset($_POST['submit'])) {
    $body = trim($_POST['body']);
    $new_comment = Comment::make($movie_id, $user_id, $body);
    $conn=DB::getInstance();
    $conn->insert('comment',array(
      'body'      => $body,
      'movie_id'  => $movie_id,
      'user_id'   => $user_id,
      'date'      => $datetime
    ));
    Redirect::to("movie.php?id={$movie_id}");
  } else {
    $body = "";
  }
  
?>
<HTML>
<HEAD>
  <TITLE>Movie Info</TITLE>
  <link rel="stylesheet" href="css/zerogrid.css">
  <link rel="stylesheet" href="css/style2.css">
  <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<body>
<div class="wrap-body">
<header>
  <div class="wrap-header zerogrid">
    <div class="row">
      <div class="col-1-2">
        <div class="wrap-col">
          <div class="logo"><a href="#"><img src="images/logo.png"/></a></div>  
        </div>
      </div>
    </div>
  <div id="menu">
    <nav>
      <div class="wrap-nav">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="profile.php">Profile</a></li> 
          <li><a href="logout.php">logout</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="movie_info">
    <div class="movie_poster">
      <img width="320px" height="420px" src="images/posters/<?php echo $poster; ?>" />
    </div>
    <div class="movie_desc">
    <font>Name : </font><font style="color: white;"><?php echo $movie_name; ?></font><br><br><br>
    <font>Release Date : </font><font style="color: white;"><?php echo $release; ?></font><br><br><br>
    <font>Category : </font><font style="color: white;"><?php echo $category; ?></font><br><br><br>
    <font>Type :  </font><font style="color: white;"><?php echo $type; ?></font><br><br><br>
    <font>Price : </font><font style="color: white;"><?php echo $price; ?></font>
    </div>
  </div>
  <div class="desc">
    <font>Description : </font><br><br>
    <font style="font-size: 22px; color: white;"><?php echo $description; ?></font> 
  </div>
  <hr>

  <div class="more_info">
    <div class="show_comments">
        <?php
          $comments = DB::getInstance()->get('comment',array('movie_id','=', $movie_id));
          if($comments->count()){
          foreach($comments->results() as $comment): 
        ?>
          <div class="comment" style="margin-bottom: 2em;">
            <div class="author">
              <?php
                $user_data=DB::getInstance()->get('users',array('id','=', $user_id));
                if($user_data->count()){
                  foreach($user_data->results() as $row){
                  echo $username=$row->name;
                  }
                } 
              ?> wrote:
            </div>
            <div class="body  "><?php echo $comment->body; ?></div>
            <div class="meta-info" style="font-size: 0.8em;">
            <?php
                $unixdatetime = strtotime($comment->date);
                echo strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
             ?>
            </div>
            <div class="options">
            <?php
            if ($user_id==$comment->user_id) {
              ?>
              <form action ="delete_comment.php" method="post">
              <input type="hidden" name="comm_id" value="<?php echo $comment->id;?>">
              <input type="hidden" name="movie_id" value="<?php echo $movie_id;?>"></input>
              <button class="button button1" type="submit" name="Delete" value="Delete">Delete Comment</button>
              </form>
              <?php
            }
            ?>
            </div>
            <hr>
          </div>

        <?php endforeach; }?>
        <?php if(empty($comments)) { echo "No Comments."; } ?>
      </div>

      <div class="comments">
        <font>Comments</font><br><br>
        <div id="comment-form">
          <form action="movie.php?id=<?php echo $movie_id; ?>" method="post">
            <table>
              <tr>
                <td><h4>Your comment:</h4></td>
                <td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><button class="button button1" type="submit" name="submit" value="Submit Comment">Submit</button></td>
              </tr>
            </table>
          </form>
        </div>
      </div>

  </div>