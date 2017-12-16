<?php
require_once 'core/init.php';
	if(empty($_GET['id'])) {
	  $session->message("No photograph ID was provided.");
	  redirect_to('index.php');
	}
	

	$comments = $photo->comments();
	
?>

<a href="list_photos.php">&laquo; Back</a><br />
<br />

<h2>Comments on <?php echo $photo->filename; ?></h2>

<?php echo output_message($message); ?>
<div id="comments">
  <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom: 2em;">
	    <div class="author">
	      <?php echo htmlentities($comment->author); ?> wrote:
	    </div>
      <div class="body">
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
	    <div class="meta-info" style="font-size: 0.8em;">
	      <?php echo datetime_to_text($comment->created); ?>
	    </div>
			<div class="actions" style="font-size: 0.8em;">
				<a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment</a>
			</div>
    </div>
  <?php endforeach; ?>
  <?php if(empty($comments)) { echo "No Comments."; } ?>
</div>