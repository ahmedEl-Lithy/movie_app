<?php
require_once 'core/init.php';

class Comment {

  protected static $table_name="comment";
  protected static $db_fields=array('id', 'movie_id', 'user_id', 'date', 'body');

  public $id;
  public $movie_id;
  public $user_id;
  public $date;
  public $body;

	public static function make($movie_id, $user_id, $body="") {
	    if(!empty($movie_id) && !empty($user_id) && !empty($body)) {
			$comment = new Comment();
		    $comment->movie_id = (int)$movie_id;
		    $comment->date = strftime("%Y-%m-%d %H:%M:%S", time());
		    $comment->user_id = $user_id;
		    $comment->body = $body;
		    return $comment;
			} else {
				return false;
			}
	}
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  	}
  
	public static function find_by_id($id=0) {
	$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
  
	public static function find_by_sql($sql="") {
	$conn=DB::getInstance();
	$result_set = $conn->run_query($sql);
	$object_array = array();
	while ($row = $conn->fetch_array($result_set)) {
	  $object_array[] = self::instantiate($row);
	}
	return $object_array;
	}

	private static function instantiate($record) {
	$object = new self;
	foreach($record as $attribute=>$value){
	  if($object->has_attribute($attribute)) {
	    $object->$attribute = $value;
	  }
	}
	return $object;
	}
	
	private function has_attribute($attribute) {
	return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
	$attributes = array();
	foreach(self::$db_fields as $field) {
	  if(property_exists($this, $field)) {
	    $attributes[$field] = $this->$field;
	  }
	}
	return $attributes;
	}

	protected function sanitized_attributes() {
	  $clean_attributes = array();
	  return $clean_attributes;
	}
}
?>