<?php
namespace Back\Controller;

use Think\Controller;

class UploadController extends Controller {

	//登录系统
	public function upload() {

		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.IOFactory");

		if ($_FILES) {

			$upload           = new \Think\Upload();// 实例化上传类
			$upload->maxSize  = 134217728;// 设置附件上传大小
			$upload->exts     = array('xlsx', 'xls');// 设置附件上传类型
			$upload->rootPath = './Upload/';// 设置附件上传根目录
			$upload->savePath = '';// 设置附件上传（子）目录
			// 上传文件
			$info = $upload->upload();
			if (!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			} else {// 上传成功 获取上传文件信息
				foreach ($info as $file) {
					$this->assign('info', '/Upload/'.$file['savepath'].$file['savename']);
					$ifile = '/Applications/MAMP/htdocs'.__ROOT__.'/Upload/'.$file['savepath'].$file['savename'];
				}
			}
			//dump(__ROOT__);
			//dump('/Applications/MAMP/htdocs'.__ROOT__.$ifile);
			//dump($info);
			$objreader     = \PHPExcel_IOFactory::createReader('Excel5');
			$objphpexcel   = $objreader->load($ifile, "utf-8");
			$sheet         = $objphpexcel->getSheet(0);
			$highestrow    = $sheet->getHighestRow();
			$highestcolumn = $sheet->getHighestColumn();
			for ($i = 2; $i <= $highestrow; $i++) {
				$idnumber      = $objphpexcel->getActiveSheet()->getCell("D".$i)->getValue();//身份证号
				$term          = $objphpexcel->getActiveSheet()->getCell("C".$i)->getValue();//学期学年
				$iterm         = $term."-".($term+1);
				$iuser         = $objphpexcel->getActiveSheet()->getCell("E".$i)->getValue();//用户名，录取通知书编号
				$passwd        = substr($idnumber, -6);
				$iname         = $objphpexcel->getActiveSheet()->getCell("A".$i)->getValue();//姓名
				$sex           = $objphpexcel->getActiveSheet()->getCell("B".$i)->getValue();//性别
				$college       = $objphpexcel->getActiveSheet()->getCell("G".$i)->getValue();//学院
				$professional  = $objphpexcel->getActiveSheet()->getCell("H".$i)->getValue();//专业
				$ichange       = new UploadController();
				$collegebranch = $ichange->CollegeBranch($professional);//本科分科
				$istatus       = 0;//答题状态
				$model         = M('student');
				$sql           = "insert into think_student (idnumber,iterm,iuser,passwd,iname,sex,college,professional,collegebranch,istatus) values ('".$idnumber."','".$iterm."','".$iuser."','".$passwd."','".$iname."','".$sex."','".$college."','".$professional."','".$collegebranch."','".$istatus."')";
				echo "$sql<br>";
				$model->execute($sql);
				unset($idnumber);
				unset($term);
				unset($itrem);
				unset($iuser);
				unset($passwd);
				unset($iname);
				unset($sex);
				unset($college);
				unset($professional);
				unset($ichange);
				unset($collegebranch);
				unset($istatus);
				unset($model);
				unset($sql);
			}
		}

		$this->display();
	}

	public function CollegeBranch($professional) {
		if (strstr($professional, "通信") !== false || strstr($professional, "网络") !== false || strstr($professional, "软件") !== false || strstr($professional, "计算机") !== false || strstr($professional, "电子") !== false || strstr($professional, "数字媒体") !== false || strstr($professional, "光电") !== false || strstr($professional, "自动化") !== false || strstr($professional, "信息工程") !== false) {
			$cb = 0;
		} else {
			$cb = 1;
		}
		return $cb;
	}
}
