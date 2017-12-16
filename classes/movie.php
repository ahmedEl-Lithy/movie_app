<?php
require_once 'core/init.php';

class movie  {

protected static $db_fields=array('id', 'name', 'quantity', 'category', 'type', 'seller_id', 'price', 'yearofproduction', 'status', 'description', 'discount');

  public $id;
  public $name;
  public $quantity;
  public $category;
  public $type;
  public $seller_id;
  public $price;
  public $yearofproduction;
  public $status;
  public $description;
  public $discount;

  public static function comments($movie_id) {
    return Comment::find_comments_on($movie_id);
  }
  
  public static function count_all() {
	  $query = "SELECT count(*) FROM `added_movies`";
    $result_set = DB::getInstance()->run_query($query);
    $row = DB::getInstance()->fetch_array($result_set);
    return array_shift($row);
	}

  private static function instantiate($record) {
    $object = new self;
    // More dynamic, short-form approach:
    foreach($record as $attribute=>$value){
      if($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  private function has_attribute($attribute) {
    // We don't care about the value, we just want to know if the key exists
    // Will return true or false
    return array_key_exists($attribute, $this->attributes());
  }

    protected function attributes() { 
    // return an array of attribute names and their values
    $attributes = array();
    foreach(self::$db_fields as $field) {
      if(property_exists($this, $field)) {
        $attributes[$field] = $this->$field;
      }
    }
    return $attributes;
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
}
?>