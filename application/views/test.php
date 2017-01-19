<?php

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'excel') {
	    header('Content-type:application/vnd.ms-excel');  //宣告網頁格式
	    header('Content-Disposition: attachment; filename=myexcel.xls');  //設定檔案名稱
	}
}

?>



<?php

$file = 'C:\xampp\tmp\content.csv';

header('Content-type:application/force-download'); //告訴瀏覽器 為下載 
header('Content-Transfer-Encoding: Binary'); //編碼方式
header('Content-Disposition:attachment;filename='.$file); //檔名
@readfile($file);

?>