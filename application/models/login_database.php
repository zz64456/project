<?php

Class Login_Database extends CI_Model {

// Insert registration data in database


	// Read data using username and password
	public function login($acc, $pswd) {
		$acc = $acc;
		$pswd = $pswd;
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where('user_account', $acc);
		$this->db->where('user_password',$pswd);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}



}

?>