<?php
namespace Back\Controller;

use Think\Controller;

/**
 *
 */

class UserController extends Controller {

	//增加管理员
	public function adduser() {
		$new_iuser  = $_POST['new_iuser'];
		$new_passwd = $_POST['new_passwd'];
		$admin_pwd  = $_POST['admin_pwd'];

		$adminsql = "SELECT passwd FROM think_management WHERE iuser = 'admin' ";
		$adminpwd = D()->query($adminsql)[0]["passwd"];
		if ($new_iuser || $new_passwd || $admin_pwd) {
			if ($admin_pwd === $adminpwd) {
				if (strlen($new_passwd) > 7) {
					$model = M('management');
					$sql   = " INSERT INTO think_management (iuser,passwd) VALUES ('".$new_iuser."','".$new_passwd."') ";
					$model->execute($sql);
					$this->assign('manage_sucess', '管理员建立成功');
				} else {
					$this->assign('manage_error', '管理员密码长度不够');
				}

			} else {
				$this->assign('manage_error', 'Admin密码错误');
			}
		}

		$this->display();
	}

	//修改密码
	public function modify() {
		$session = $_SESSION['username'];
		$this->assign('iname', $session);
		if ($_POST['passwd_old'] || $_POST['passwd_new'] || $_POST['confirm']) {
			$pwd_old = $_POST['passwd_old'];
			$pwd_new = $_POST['passwd_new'];
			$confirm = $_POST['confirm'];

			$sql    = "SELECT passwd FROM think_management WHERE iuser = '".$session."' ";
			$oldpwd = D()->query($sql)[0]["passwd"];
			if ($pwd_old === $oldpwd) {
				if (preg_match("/^[0-9a-zA-Z]{4,21}$/", $pwd_new)) {
					if ($pwd_new === $confirm) {
						if ($pwd_old !== $pwd_new) {
							if (strlen($pwd_new) > 7) {
								$sql2 = "UPDATE think_management SET passwd = '".$pwd_new."' WHERE iuser = '".$session."' ";
								D()->execute($sql2);
								$this->assign('manage_sucess', '修改成功');
							} else {
								$this->assign('manage_error', '新密码长度不够');
							}

						} else {
							$this->assign('manage_error', '密码未改动');
						}
						$this->assign('manage_sucess', '修改成功');
					} else {
						$this->assign('manage_error', '新密码不一致');
					}

				} else {
					$this->assign('manage_error', '新密码	含有非法字符');
				}
			} else {
				$this->assign('manage_error', "原密码错误");
			}

		}

		$this->display();
	}

	//判断是否登录
	public function islogin() {
		if (!isset($_SESSION['username'])) {
			$this->error('对不起,您还没有登录!请先登录再进行浏览', U('Admin/login'), 2);
		} else {
			$session = $_SESSION['username'];
			$this->assign('username', $session);

		}
	}
}