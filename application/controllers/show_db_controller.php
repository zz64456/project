<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show_db_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        session_start();
        $this->load->helper('date');
        date_default_timezone_set('Asia/Taipei');
        ini_set('memory_limit', '256M');
        set_time_limit(0);
        $this->load->Model("Show_db_model");//載入model

    }   

    public function sessionCHECK()
    {
    	if (isset($_SESSION['user_account'])) {

    	} else {
    		$this->load->view('login_view');
    	}
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login_view');
	}

	public function test()
	{	
		
		$this->load->view('test');
	}

	
	public function show_db()//全部搜尋
	{	
		set_time_limit(0);

		if (isset($_SESSION['user_account'])) { // 檢查是否登入
			if (isset($_POST['keyword'])) { // 檢查是否輸入關鍵字
				$keyword=$_POST['keyword'];
			} else if (isset($_GET['cellphone1'])) {
				$keyword = $_GET['cellphone1']; // 給查看其他用的
			} else {
				$keyword='';
			}

			if (strlen($keyword)>0) {
				$this->load->Model("Show_db_model");//載入model
				$time = date("Y-m-d H:i:s");
				$this->Show_db_model->move_record($_SESSION['user_name'], $time, 'search', $keyword);//動作紀錄
				$keyword = str_replace( "-" , "" , $keyword);
				//echo $_SESSION['user_name']."999";
				if (isset($_POST['search_type'])==FALSE) {
					$_POST['search_type'] = 1;
				}
				$data = $this->Show_db_model->show_db($keyword, $_POST['search_type'], $_SESSION['user_name'] );//撈資料

				if (count($data)>=1) {
					foreach ($data as $row ) {
					    $_SESSION['id'] = $row['id'];
					    $_SESSION['日期'] = $row['日期'];
					    $_SESSION['買賣'] = $row['買賣'];
					    $_SESSION['LINE'] = $row['LINE'];
						$_SESSION['company_name'] = $row['company_name'];
						$_SESSION['customer_name'] = $row['customer_name'];
						$_SESSION['電話'] = $row['電話'];
						$_SESSION['手機1'] = $row['手機1'];
						$_SESSION['手機2'] = $row['手機2'];
						$_SESSION['價位'] = $row['價位'];
						$_SESSION['張數'] = $row['張數'];
						$_SESSION['來源'] = $row['來源'];
						$_SESSION['備註'] = $row['備註'];
						$_SESSION['帳號'] = $row['帳號'];
						$_SESSION['身分證字號'] = $row['身分證字號'];
						$_SESSION['地址'] = $row['地址'];
						$_SESSION['EMAIL'] = $row['EMAIL'];
					}
				}
				$this->load->view('show_db_view',array('data' => $data, 'keyword'=> $keyword
										, 'search_type'=> $_POST['search_type']));
			} else {
				$this->load->view('show_db_view');
			}
		} else {
			$this->load->view('login_view');
		}
	}

	//employee查看自己的全部名單
	public function get_employee_himself_customer(){
		$employee_himself_customer = $this->Show_db_model->get_employee_himself_customer($_SESSION['user_name'] );//每個人撈自己的客戶資料
		$this->load->view('show_db_view',array('data' => $employee_himself_customer));
	}



	public function show_notes()//點更多打開的新視窗
	{
		$id = $_GET['id'];
		$this->load->Model("Show_db_model");
		$data = $this->Show_db_model->show_notes($id);
		$this->load->view('show_db_note',array('data' => $data));
	}


	public function download_excel()//以excel下載查詢結果
	{	
		set_time_limit(0);
		$this->load->Model("Show_db_model");
		if (isset($_POST['download_keyword'])) {
			$keyword = $_POST['download_keyword'];
			$time = date("Y-m-d H:i:s");
			$this->Show_db_model->move_record($_SESSION['user_name'], $time, 'download', $keyword);//動作紀錄
			//判斷content檔案存在與否，存在則刪除
			$file = 'C:\xampp\tmp\content.csv';
			if(file_exists($file)){
				unlink($file);
			}

			$data1 = $this->Show_db_model->show_db($keyword, $_POST['search_type'], $_SESSION['user_name'] );//撈資料

			$this->Show_db_model->put_NewData($data1);//進入新資料庫
			$this->load->helper('download');
			$data2 = file_get_contents('C:\xampp\tmp\content.csv');
			$name = 'content.csv';
			force_download($name, @iconv("UTF-8","Big5//IGNORE", $data2));

		} else {
			echo '<span style="color:#FF0000;"><b>下載失敗</b></span>';
			$this->load->view('show_db_view');
		}
		
	}

	public function login()//登入頁面
	{	
		$this->load->view('login_view');
	}

	public function logout()//登出頁面
	{	
		session_destroy();
		$this->load->view('login_view');
	}

	public function login_check()//登入確認
	{
		if (isset($_POST['acct']) && isset($_POST['pswd'])) {
			$account = $_POST['acct'];
			$password = $_POST['pswd'];
			$error_message = '輸入錯誤，再試一次!';
			$this->load->Model("login_database");
			$data = $this->login_database->login($account, $password);//比對資料庫
			$time = date("Y-m-d H:i:s");			

			if ($data != false) {
				$_SESSION['user_level'] = $data['user_level'];
				$_SESSION['user_account'] = $account;
				$_SESSION['user_name'] = $data['user_name'];
				$this->Show_db_model->move_record($_SESSION['user_name'], $time, 'login','');//動作紀錄
				$this->load->view('show_db_view');
			} else {
				//redirect('/user_authentication/login');
				$this->load->view('login_view',array('error_message' => $error_message));
			}
		} else {
			$this->load->view('login_view');
		}
		
	}

	public function import(){
		set_time_limit(0);
      	if(isset($_POST["Import"])){
      		$this->load->model('show_db_model');
            $filename = $_FILES["file"]["tmp_name"];
            if($_FILES["file"]["size"] > 0){
            	//echo $_FILES["file"]["tmp_name"]."   ".$filename;
            	//echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";

                $file = fopen($filename, "r");//

                $table_source =  $this->Show_db_model->get_table_source(); //抓"來源"

                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){ //抓資料成Array後進資料庫
                	for ($i=0; $i < count($emapData); $i++) { //檢查編碼是否為UTF-8
                		if (mb_detect_encoding($emapData[$i]) != "UTF-8") {
                			$emapData[$i] = iconv(mb_detect_encoding($emapData[$i]), "UTF-8", $emapData[$i]);
                		}
                	}
                	//print_r($emapData);
                	if ($emapData[0]!='日期') { // 避開匯入時的title行
                		$data = array(
                        '日期' => $emapData[0],
                        '買賣' => $emapData[1],
                        'LINE' => $emapData[2],
                        'company_name' => $emapData[3],
                        'customer_name' => $emapData[4],
                        '電話' => $emapData[5],
                        '手機1' => $emapData[6],
                        '手機2' => $emapData[7],
                        '價位' => $emapData[8],
                        '張數' => $emapData[9],
                        '來源' => $emapData[10],
                        '備註' => $emapData[11],
                        '帳號' => $emapData[12],
                        '身分證字號' => $emapData[13],
                        '地址' => $emapData[14],
                        'EMAIL' => $emapData[15],
                        );
	                    //以下修改欄位以便進資料庫OR輸出為EXCEL
	                    if (strlen($data['手機1'])>0 && $data['手機1'][0] == 9) { //判斷是否補上0
	                    	$data['手機1'] = "0".$data['手機1'];
	                    }
	                    $delete_array = array('\b','\t', '?', '\r', '\n', '\r\n', '\n\r', '-', ' '); //欲刪除符號
	                    $data['來源'] = str_replace ($delete_array,"",$data['來源']);
	                    $data['手機1'] = str_replace ($delete_array,"",$data['手機1']);
	                    $data['手機2'] = str_replace ($delete_array,"",$data['手機2']);
	                    $data['company_name'] = str_replace ($delete_array,"",$data['company_name']);
	                    $data['customer_name'] = str_replace ($delete_array,"",$data['customer_name']);
	                    $data['備註'] = str_replace (" ","",$data['備註']); //備註去掉空白就好
	                    $data['日期'] = date("Y-m-d");

	                    $time = date("Y-m-d H:i:s");
						$this->Show_db_model->move_record($_SESSION['user_name'], $time, 'import', '');//動作紀錄
	                    $insertId = $this->show_db_model->insertCSV_to_table_all($data); //進資料庫table_all
	                    $source_exist = 0;
	                    for ($i=0; $i < count($table_source); $i++) { 
	                    	if ($table_source[$i]['source_name'] == $data['來源']) {
	                    		$this->show_db_model->update_source_總筆數($table_source[$i]['source_name']); //更新資料庫source總筆數
	                    		$source_exist = 1;
	                    	}
	                    	$this->show_db_model->insert_source($table_source[$i]['source_name']); //新增資料庫source來源
	                    }
	                    $processed_data = $this->show_db_model->show_db($data['手機1'], 2, $_SESSION['user_name']); //檢查去重複資料庫是否有此號碼
	                    if (empty($processed_data)) {
	                    	$this->show_db_model->insertCSV_to_table_processed($insertId); //進資料庫table_processed
	                    }
                	}
                }
                fclose($file);
                echo '<span style="color:#FF0000;"><b>上傳成功</b></span>';
                $this->load->view('show_db_view');
            } else {
            	echo '<span style="color:#FF0000;"><h1><b>您尚未選取檔案</b></h1></span>';
            	$this->load->view('show_db_view');
            }
            $this->show_db_model->delete_title();
        }
    }

    // 進入分送
    public function assign(){
    	$source_list_and_unassigned_client[] = NULL;
    	$this->load->model('show_db_model');
    	$table_employee = $this->Show_db_model->get_table_employee(); //抓employee資料表
    	$table_source = $this->Show_db_model->get_table_source(); //抓source資料表
    	$this->load->view('assign_view',array('table_source' => $table_source, 'table_employee' => $table_employee));

    }

    // 確認分送
    public function assign_view_submit(){
    	if (isset($_POST['source_name']) && isset($_POST['source_amount']) && isset($_POST['employee_name'])) {
    		$unassigned_client = $this->Show_db_model->use_source_get_unassigned_client($_POST['source_name']);//抓此來源未分配客戶
    		$table_source = $this->Show_db_model->get_table_source(); //抓source資料表
    		$amount = 0; //amount 為 剩餘筆數
    		for ($i=0; $i < count($table_source); $i++) { 
    			if ($_POST['source_name'] == $table_source[$i]['來源']) {
    				$amount = $table_source[$i]['筆數']; //找到筆數
    			}
    		}
    		if ($amount >= $_POST['source_amount']) { // 剩餘筆數$amount 與 欲派送筆數$_POST['source_amount'] 做比較
    			for ($i=0; $i < $_POST['source_amount']; $i++) { 
	    			$this->Show_db_model->update_table_processed_認養人($_POST['employee_name'], $unassigned_client[$i]['id']); //更新table_processed
	    			$this->Show_db_model->update_table_all_認養人($_POST['employee_name'], $unassigned_client[$i]['手機1']); //更新table_all
	    		}
	    		$this->Show_db_model->update_source_未分配筆數($_POST['source_name'], $_POST['source_amount']); 
    		} else {
    			for ($i=0; $i < $amount; $i++) { 
    				$this->Show_db_model->update_table_processed_認養人($_POST['employee_name'], $unassigned_client[$i]['id']); //更新table_processed
    				$this->Show_db_model->update_table_all_認養人($_POST['employee_name'], $unassigned_client[$i]['手機1']); //更新table_all
    			}
    			$this->Show_db_model->update_source_未分配筆數($_POST['source_name'], $amount); 
    		}
    	}
    	//$this->load->view('assign_view');
    	redirect('/Show_db_controller/show_db', 'refresh');
    }
}
