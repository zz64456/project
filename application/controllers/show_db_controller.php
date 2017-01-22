<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class show_db_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');     
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
		$this->load->view('test');
	}

	public function test()
	{	
		
		$this->load->view('test');
	}

	//一般搜尋
	public function show_db()
	{	
		set_time_limit(0);

		$original_or_processed = 1;

		if (isset($_POST['keyword'])) {
			$keyword=$_POST['keyword'];
		} else if (isset($_GET['cellphone1'])) {
			$keyword = $_GET['cellphone1'];
		} else {
			$keyword='';
		}
		

		if (strlen($keyword)>0) {
			$this->load->Model("Show_db_model");
			
			$data = $this->Show_db_model->show_db($keyword);//撈資料

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
			$this->load->view('show_db_view',array('data' => $data, 'keyword'=> $keyword, 'original_or_processed'=> $original_or_processed));
		}
		else {
			$this->load->view('show_db_view');
		}
	}


	//搜尋...篩選過後無重複
	public function show_all_number_processed()
	{	
		set_time_limit(0);

		$original_or_processed = 2;

		if (isset($_POST['keyword'])) {
			$keyword = $_POST['keyword'];
		} else {
			$keyword = '';
		}
		

		if (strlen($keyword)>0) {
			$keyword=$_POST['keyword'];
			$this->load->Model("Show_db_model");
			$data = $this->Show_db_model->show_all_number_processed($keyword);


			//判斷content檔案存在與否，存在則刪除
			$file = 'C:\xampp\tmp\content.csv';
			if(file_exists($file)){
				unlink($file);
			}

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
			$this->load->view('show_db_view',array('data' => $data, 'keyword'=> $keyword, 'original_or_processed'=> $original_or_processed));
		}
		else {
			$this->load->view('show_db_view');
		}
	}


	//點更多打開的新視窗
	public function show_notes()
	{
		$id = $_GET['id'];
		$this->load->Model("Show_db_model");
		$data = $this->Show_db_model->show_notes($id);
		$this->load->view('show_db_note',array('data' => $data));
	}


	public function download_excel()
	{	
		$this->load->Model("Show_db_model");
		if (isset($_POST['download_keyword'])) {
			$keyword = $_POST['download_keyword'];
			//判斷content檔案存在與否，存在則刪除
			$file = 'C:\xampp\tmp\content.csv';
			if(file_exists($file)){
				unlink($file);
			}
			if ($_POST['original_or_processed'] == 1) {
				$data1 = $this->Show_db_model->show_db($keyword);//撈資料
			} else {
				$data1 = $this->Show_db_model->show_all_number_processed($keyword);//撈資料
			}
			
			$this->Show_db_model->put_NewData($data1);//進入新資料庫
			$this->load->helper('download');
			$data2 = file_get_contents('C:\xampp\tmp\content.csv');
			$name = 'content.csv';
			force_download($name, @iconv("UTF-8","Big5//IGNORE", $data2));

		} else {
			echo "fail";
		}
		
	}


	public function login()
	{	
		$this->load->view('login_view');
	}

}
