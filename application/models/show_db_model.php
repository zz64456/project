<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class show_db_model extends CI_Model {
		function __construct(){
		parent::__construct();
			}

	function show_db($keyword){
		$query = $this->db->query("SELECT * FROM `table3` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																								 OR `電話` LIKE '%$keyword%'
																								 OR `手機1` LIKE '%$keyword%'
																								 OR `身分證字號` LIKE '%$keyword%'
																								 OR `來源` LIKE '%$keyword%'");
		if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('id'=>$row-> id,
								'日期'=>$row-> 日期,
								'買賣'=>$row-> 買賣,
								'LINE'=>$row-> LINE,
								'company_name'=>$row-> company_name,
								'customer_name'=>$row-> customer_name,
								'電話'=>$row-> 電話,
								'手機1'=>$row-> 手機1,
								'手機2'=>$row-> 手機2,
								'價位'=>$row-> 價位,
								'張數'=>$row-> 張數,
								'來源'=>$row-> 來源,
								'備註'=>$row-> 備註,
								'帳號'=>$row-> 帳號,
								'身分證字號'=>$row-> 身分證字號,
								'地址'=>$row-> 地址,
								'EMAIL'=>$row-> EMAIL,);
			}
			return  $result;
		}
	}

	function show_all(){
		$query = $this->db->query("SELECT * FROM `table3`");
		if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('id'=>$row-> id,
								'日期'=>$row-> 日期,
								'買賣'=>$row-> 買賣,
								'LINE'=>$row-> LINE,
								'company_name'=>$row-> company_name,
								'customer_name'=>$row-> customer_name,
								'電話'=>$row-> 電話,
								'手機1'=>$row-> 手機1,
								'手機2'=>$row-> 手機2,
								'價位'=>$row-> 價位,
								'張數'=>$row-> 張數,
								'來源'=>$row-> 來源,
								'備註'=>$row-> 備註,
								'帳號'=>$row-> 帳號,
								'身分證字號'=>$row-> 身分證字號,
								'地址'=>$row-> 地址,
								'EMAIL'=>$row-> EMAIL,);
			}
			return  $result;
		}
	}

	function show_notes($id){
		$query = $this->db->query("SELECT * FROM `table3` WHERE `id` = '$id' ");
		if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('id'=>$row-> id,
								'company_name'=>$row-> company_name,
								'customer_name'=>$row-> customer_name,
								'備註'=>$row-> 備註,
								'地址'=>$row-> 地址,
								'EMAIL'=>$row-> EMAIL,
								'帳號'=>$row-> 帳號,
								'手機1'=>$row-> 手機1,);
			}
			return  $result;
		}
	}

	//手機篩選過後無重複
	function show_all_number_processed($keyword){
		$query = $this->db->query("SELECT * FROM `table3篩選過無重複` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																								 OR `電話` LIKE '%$keyword%'
																								 OR `手機1` LIKE '%$keyword%'
																								 OR `身分證字號` LIKE '%$keyword%'
																								 OR `來源` LIKE '%$keyword%'");
		if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('id'=>$row-> id,
								'日期'=>$row-> 日期,
								'買賣'=>$row-> 買賣,
								'LINE'=>$row-> LINE,
								'company_name'=>$row-> company_name,
								'customer_name'=>$row-> customer_name,
								'電話'=>$row-> 電話,
								'手機1'=>$row-> 手機1,
								'手機2'=>$row-> 手機2,
								'價位'=>$row-> 價位,
								'張數'=>$row-> 張數,
								'來源'=>$row-> 來源,
								'備註'=>$row-> 備註,
								'帳號'=>$row-> 帳號,
								'身分證字號'=>$row-> 身分證字號,
								'地址'=>$row-> 地址,
								'EMAIL'=>$row-> EMAIL,);
			}
			return  $result;
		}
	}

}
