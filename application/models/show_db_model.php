<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class show_db_model extends CI_Model {
		function _construct(){
		parent::_construct();
			}

	function show_db($keyword){
		$query = $this->db->query("SELECT * FROM `table_all` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
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


	//備註
	function show_notes($id){
		$query = $this->db->query("SELECT * FROM `table_all` WHERE `id` = '$id' ");
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
		$query = $this->db->query("SELECT * FROM `table_processed` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
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


	//下載專用空資料表....將要儲存的資料放入資料庫
	function put_NewData($data){
		$new = $data;
		$this->db->query("DELETE FROM `empty` WHERE 1");//清空資料表
		$this->db->query("INSERT INTO `empty`(`id`, `日期`, `買賣`, `LINE`, `company_name`, `customer_name`, `電話`, `手機1`, `手機2`, `價位`, `張數`, `來源`, `備註`, `帳號`, `身分證字號`, `地址`, `EMAIL`) VALUES ( '0id', '日期', '買賣', 'LINE', '股票名稱', '姓名', '電話', '手機1', '手機2', '價位', '張數', '來源', '備註', '帳號', '身分證字號', '地址', 'EMAIL' );
			");//先放入欄位名稱
		for ($i=0; $i < count($new); $i++) { 
			//echo $new[$i]['id']."<br>";
			$new[$i]['備註'] = "請看網頁";
			$this->db->insert('empty',$new[$i]);
		}
		$this->db->query("SELECT * into outfile 'C:/xampp/tmp/content.csv' FIELDS TERMINATED BY ',' ESCAPED BY ' ' LINES TERMINATED BY '\r' from empty");
	}

	//動作紀錄資料表
	function move_record($user_name, $time, $move, $data){
		$this->db->query("INSERT INTO `move_record`(`id`, `user_name`, `time`, `action`, `data`) VALUES ( '', '$user_name', '$time', '$move', '$data');
			");//先放入欄位名稱
	}

	//匯入CSV檔案到table_all
	function insertCSV_to_table_all($data){
        $this->db->insert('table_all', $data);
        return $this->db->insert_id();
    }

    //匯入CSV檔案到table_processed
	function insertCSV_to_table_processed($data){
        $this->db->insert('table_processed', $data);
        return $this->db->insert_id();
    }

    //刪除欄位名稱
    function delete_title(){
    	$tables = array('table_all', 'table_processed');
		$this->db->where('日期', '日期');
		$this->db->delete($tables);
    }
}
