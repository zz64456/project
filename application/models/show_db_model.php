<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class show_db_model extends CI_Model {
		function _construct(){
		parent::_construct();
			}

	function show_db($keyword, $type, $user_name){
		if ($user_name == 'admin') { // 使用者為admin
			if ($type == 1) {
				$query = $this->db->query("SELECT * FROM `table_all` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																									 OR `電話` LIKE '%$keyword%'
																									 OR `手機1` LIKE '%$keyword%'
																									 OR `手機2` LIKE '%$keyword%'
																									 OR `身分證字號` LIKE '%$keyword%'
																									 OR `備註` LIKE '%$keyword%'");
				$type_alert = "全部搜尋...";
			} elseif ($type == 2) {
				$query = $this->db->query("SELECT * FROM `table_processed` WHERE `company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																									 OR `電話` LIKE '%$keyword%'
																									 OR `手機1` LIKE '%$keyword%'
																									 OR `手機2` LIKE '%$keyword%'
																									 OR `身分證字號` LIKE '%$keyword%'
																									 OR `來源` LIKE '%$keyword%'
																									 OR `備註` LIKE '%$keyword%'");
				$type_alert = "去重複搜";
			} else {
				$query = $this->db->query("SELECT * FROM `table_processed` WHERE `來源` LIKE '%$keyword%'");
				$type_alert = "來源搜尋";
			}
		} else {	// 使用者為一般
			if ($type == 1) {
				$query = $this->db->query("SELECT * FROM `table_all` WHERE `認養人` = '$user_name' AND (`company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																									 OR `電話` LIKE '%$keyword%'
																									 OR `手機1` LIKE '%$keyword%'
																									 OR `手機2` LIKE '%$keyword%'
																									 OR `身分證字號` LIKE '%$keyword%'
																									 OR `備註` LIKE '%$keyword%')");
				$type_alert = "全部搜尋...";
			} elseif ($type == 2) {
				$query = $this->db->query("SELECT * FROM `table_processed` WHERE `認養人` = '$user_name' and (`company_name` LIKE '%$keyword%' OR `customer_name` LIKE '%$keyword%'
																									 OR `電話` LIKE '%$keyword%'
																									 OR `手機1` LIKE '%$keyword%'
																									 OR `手機2` LIKE '%$keyword%'
																									 OR `身分證字號` LIKE '%$keyword%'
																									 OR `來源` LIKE '%$keyword%'
																									 OR `備註` LIKE '%$keyword%')");
				$type_alert = "去重複搜";
			} else {
				$query = $this->db->query("SELECT * FROM `table_processed` WHERE `認養人` = '$user_name' and `來源` LIKE '%$keyword%'");
				$type_alert = "來源搜尋";
			}
		}

		echo '<span style="color:#FF0000">'.$type_alert.'</span>';
		
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
								'EMAIL'=>$row-> EMAIL,
								'認養人'=>$row-> 認養人,);
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


	//下載專用空資料表....將要儲存的資料放入資料庫
	function put_NewData($data){
		$new = $data;
		$this->db->query("DELETE FROM `empty` WHERE 1");//清空資料表
		$this->db->query("INSERT INTO `empty`(`id`, `日期`, `買賣`, `LINE`, `company_name`, `customer_name`, `電話`, `手機1`, `手機2`, `價位`, `張數`, `來源`, `備註`, `帳號`, `身分證字號`, `地址`, `EMAIL`, `認養人`) VALUES ( '0id', '日期', '買賣', 'LINE', '股票名稱', '姓名', '電話', '手機1', '手機2', '價位', '張數', '來源', '備註', '帳號', '身分證字號', '地址', 'EMAIL', '' );
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
		if (is_null($data)) {
			$this->db->query("INSERT INTO `move_record`(`id`, `user_name`, `time`, `action`, `data`) VALUES ( '', '$user_name', '$time', '$move', '');");//先放入欄位名稱
		} else {
			$this->db->query("INSERT INTO `move_record`(`id`, `user_name`, `time`, `action`, `data`) VALUES ( '', '$user_name', '$time', '$move', '$data');");//先放入欄位名稱
		}
	}

	//匯入CSV檔案到table_all
	function insertCSV_to_table_all($data){
        $this->db->insert('table_all', $data);
        return $this->db->insert_id();
    }

    //匯入CSV檔案到table_processed
	function insertCSV_to_table_processed($id){
		$this->db->query("INSERT INTO table_processed SELECT * FROM table_all WHERE id='$id'");
    }

    //刪除欄位名稱
    function delete_title(){
    	$this->db->query("DELETE FROM `table_all` WHERE `LINE` = 'LINE'");
    	$this->db->query("DELETE FROM `table_processed` WHERE `LINE` = 'LINE'");
    }

    //取得資料表source
    function get_table_source(){
    	$query = $this->db->query("SELECT * from source");
    	if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('來源'=>$row-> 來源,
								'筆數'=>$row-> 筆數,
								'未分配筆數'=>$row-> 未分配筆數,);
			}
			return  $result;
		}
    }

    //取得資料表employee
    function get_table_employee(){
    	$query = $this->db->query("SELECT * from employee");
    	if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('user_id'=>$row-> user_id,
								'user_account'=>$row-> user_account,
								'user_password'=>$row-> user_password,
								'user_name'=>$row-> user_name,
								'user_level'=>$row-> user_level,);
			}
			return  $result;
		}
    }

    //依據來源取得未分配客戶
    function use_source_get_unassigned_client($source_name){
    	if ($source_name == '54391') {
    		echo "yes";
    	}
    	$query = $this->db->query("SELECT * from table_processed where `來源` = '$source_name' and (`認養人` IS NULL or `認養人` = '')");
    	if($query->result()!=null){
			foreach ($query->result() as $row) {
				$result[] = array('id'=>$row-> id,
								'來源'=>$row-> 來源,
								'認養人'=>$row-> 認養人,
								'手機1'=>$row-> 手機1,);
			}
			return  $result;
		}
    }

    //新增來源
    function insert_source($source_name){
		$this->db->query("INSERT INTO `source`(`來源`, `筆數`) VALUES ( '$source_name', 1);");
    }

    //匯入後更新來源總筆數
    function update_source_總筆數($source_name){
		$this->db->query("UPDATE `source` SET `筆數` = 筆數+1 WHERE `來源`='$source_name';");
    }

    //分派名單後更新來源未分配筆數
    function update_source_未分配筆數($source_name,$count){
		$this->db->query("UPDATE `source` SET `未分配筆數` = 未分配筆數-$count WHERE `來源`='$source_name';");
    }

    //分派名單後更新table_processed認養人
    function update_table_processed_認養人($employee_name, $id){
		$this->db->query("UPDATE `table_processed` SET `認養人`='$employee_name' WHERE `id`='$id';");
    }

    //分派名單後以這100組客戶的手機號碼更新table_all此100客戶每一筆的認養人(100可為200 300 500)
    function update_table_all_認養人($employee_name, $cellphone){
    	$this->db->query("UPDATE `table_all` SET `認養人`='$employee_name' WHERE `手機1`='$cellphone';");
    }

    //抓自己的客戶資料
    function get_employee_himself_customer($employee_name){
    	$query = $this->db->query("SELECT * FROM `table_all` WHERE `認養人` = '$employee_name'");
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
								'EMAIL'=>$row-> EMAIL,
								'認養人'=>$row-> 認養人,);
			}
			return  $result;
		}
    }

}
