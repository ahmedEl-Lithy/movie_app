<?php

class user {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null){
		$this->_db=DB::getInstance();

		$this->_sessionName= config::get('session/session_name');
		$this->_cookieName= config::get('remember/cookie_name');

		if(!$user){
			if(session::exists($this->_sessionName)){
				$user= session::get($this->_sessionName);
				
				if($this->find($user)){
					$this->_isLoggedIn=true;
				} else{

				}
			}

		} else {
			$this->find($user);
		}
	}

	public function update($fields = array(), $id= null){
			
		if(!$id && $this->isLoggedIn()){
			$id=$this->data()->id;
		}

		if(!$this->_db->update('users', $id, $fields)){
			throw new Exception("Error Processing Request");
		}
	}

	public function create($fields= array()){
		if(!$this->_db->insert('users', $fields)){
			throw new Exception('There was a problem creating an account');
		}
	}

	public function find($user= null){
		if($user){
			$field=(is_numeric($user)) ? 'id' : 'username';
			$data=$this->_db->get('users', array($field, '=', $user));

			if($data->count()){
				$this->_data= $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($username= null, $password = null, $remember = false){
	

		if(!$username && !$password && $this->exists()){
			session::put($this->_sessionName, $this->data()->id);
		} else {
				$user=$this->find($username);
		if($user){
			if($this->data()->password=== Hash::make($password, $this->data()->salt)){
				session::put($this->_sessionName, $this->data()->id);


				if($remember){
					$hash=Hash::unique();
					$hashCheck= $this->_db->get('user_session', array('user_id', '=', $this->data()->id));

					if(!$hashCheck->count()){
						$this->_db->insert('users_session',array(
							'user_id' => $this->data()->id,
							'hash' => $hash


						));
					} else {
						$hash= $hashCheck->first()->hash;
					}

					cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));

				}
				return true;
			}
		}
	}
			return false;
	}

	public function hasPermission($key){
		$group= $this->_db->get('groups', array('id', '=', $this->data()->group));

		if($group->count()){
			$permissions=json_decode($group->first()->permissions, true);

			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false ;
	}

	public function logout(){

		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		session::delete($this->_sessionName);
		cookie::delete($this->_cookieName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}
	public function view_movie_with_my_offers($user_id){
		$movie_data=DB::getInstance()->get('added_movies',array());
	    echo "<table class='table' border='1' style='width:100%'>";
        echo "<thead><tr>
            <th>Movie</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Type</th>
            <th>Price</th>
            <th>Year Of Production</th>
            <th>Option</th>
          </tr></thead><tbody>";
        foreach($movie_data->results() as $row){
            echo "<tr><td>";
            echo $row->name;
        	echo "</td><td>";
        	echo $row->quantity;
        	echo "</td><td>";
        	echo $row->category;
        	echo "</td><td>";
            echo $row->type;
            echo "</td><td>";
            echo $row->price;
            echo "</td><td>";
            echo $row->yearofproduction;
            echo "</td>";
			if($row->seller_id==$user_id){
            echo "<form action ='update_movie.php' method='get'>
		  	<input type='hidden' name='id' value=",$row->id,">
		 	<td> 
			<button class=\"button button1\" type=\"submit\" value=\"Update\">Update</button>
		</form>";
            }
		}
		echo "</tr></tbody></table>";
	}

//view al admin
	public function view_all_movies(){
		echo "<table class='table' border='1' style='width:100%'>";
    	echo "<thead><tr>
        <th>Movie</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Type</th>
        <th>Price</th>
        <th>Year Of Production</th>
        <th>status</th>
        <th>Comments</th>
      	</tr></thead><tbody>";
      	$movie_data=DB::getInstance()->get('added_movies',array('status','=', 'new'));
      	foreach ($movie_data->results() as $row) {
        echo "<tr><td>";
        echo $row->name;
    	echo "</td><td>";
    	echo $row->quantity;
    	echo "</td><td>";
    	echo $row->category;
    	echo "</td><td>";
        echo $row->type;
        echo "</td><td>";
        echo $row->price;
        echo "</td><td>";
        echo $row->yearofproduction;
        echo "</td><td>";
		echo $row->status;
		echo "</td><td>";

		$movie_comment=DB::getInstance()->get('comment',array('movie_id','=', $row->id));

			if($movie_comment->count()){
				echo "<a href='movie.php?id=$row->id'>";
				echo count($movie_comment->results());
				echo "</a>";
			
			
		}else{
			echo 0;
		}
        
    }
	
	echo "</td></tr></tbody></table>";
		}

	public function view_movie($user_id,$user_type){
		if($user_type==1){//admin
			$this->view_all_movies();
		}elseif ($user_type==2) {//seller
			$this->view_movie_with_my_offers($user_id);
		}else{//customer
			echo "customer";
		}
	}
}