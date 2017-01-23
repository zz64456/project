<?php

Class Login_Database extends CI_Model {

// Insert registration data in database


	// Read data using username and password
	public function login($acc, $pswd) {
		$acc = $acc;
		$pswd = $pswd;
		// $data = $this->db->select('*');
		// $this->db->from('account');
		// $this->db->where('user_account', $acc);
		// $this->db->where('user_password',$pswd);
		// $data2 = $this->db->limit(1);
		// $query = $this->db->get();
		$query = $this->db->query("SELECT * FROM `account` WHERE `user_account` = '$acc' AND `user_password` = '$pswd'");
		//print_r($data3);
		if ($query->num_rows() == 1) {
			foreach ($query->result() as $row) {
				$result = array('user_account'=>$row-> user_account,
								'user_password'=>$row-> user_password,
								'user_name'=>$row-> user_name,
								'user_level'=>$row-> user_level);
			}
			return $result;
		}
		else {
			return false;
		}
	}



}

?>