<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>后台管理中心</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?php echo (C("BACK_CSS_URL")); ?>styles.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo (C("BACK_CSS_URL")); ?>menustyles.css" type="text/css" rel="stylesheet" media="all">
    <script type="text/javascript" src="<?php echo (C("BACK_JS_URL")); ?>jquery.min.js"></script>
    <script src="<?php echo (C("BACK_JS_URL")); ?>echarts.min.js"></script>
</head>
<body>
<!--头部-->
<table cellspacing=0 cellpadding=0 width="100%"
       background="<?php echo (C("BACK_IMG_URL")); ?>header_bg.jpg" border=0>
    <tr height=56>
        <td width=260><img height=56 src="<?php echo (C("BACK_IMG_URL")); ?>header_left.jpg"
                           width=260></td>
        <td style="font-weight: bold; color: #fff; padding-top: 20px" align=middle><?php echo ($username); ?>
            &nbsp;
            <a style="color: #fff"
               onclick="if (confirm('确定要退出吗？')) return true; else return false;"
               href="<?php echo U('Admin/layout');?>?username=<?php echo ($username); ?>"
               target=_top>退出系统</a>
        </td>
        <td align=right width=268>
            <img height=56 src="<?php echo (C("BACK_IMG_URL")); ?>header_right.jpg" width=268>
        </td>
    </tr>
</table>
<div id="w">
    <nav>
        <ul id="ddmenu">
            <li><a href="<?php echo U('Admin/index');?>">管理中心</a></li>
            <li><a href="<?php echo U('Upload/upload');?>">上传信息</a></li>
            <li><a href="<?php echo U('ShowData/echarts');?>">问卷数据分析</a></li>
            <li><a href="<?php echo U('ShowData/suggest');?>">学生建议数据</a></li>
            <li><a href="<?php echo U('ShowData/searchData');?>">学生信息搜索</a></li>
            <li><a href="<?php echo U('User/adduser');?>">新建账号</a></li>
            <li><a href="<?php echo U('User/modify');?>">修改密码</a>

            </li>
        </ul>
    </nav>
</div>
<style type="text/css" media="screen">
	input[type=text],
    input[type=password] {
        font-size: 13px;
        min-height: 32px;
        margin: 0;
        padding: 7px 8px;
        outline: none;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        transition: all 0.15s ease-in;
        vertical-align: middle;
    }
    .button {
        position: relative;
        display: inline-block;
        margin: 0;
        padding: 8px 15px;
        font-size: 13px;
        font-weight: bold;
        color: #333;
        text-shadow: 0 1px 0 rgba(255,255,255,0.9);
        white-space: nowrap;
        background-color: #eaeaea;
        background-image: -moz-linear-gradient(#fafafa, #eaeaea);
        background-image: -webkit-linear-gradient(#fafafa, #eaeaea);
        background-image: linear-gradient(#fafafa, #eaeaea);
        background-repeat: repeat-x;
        border-radius: 3px;
        border: 1px solid #ddd;
        border-bottom-color: #c5c5c5;
        box-shadow: 0 1px 3px rgba(0,0,0,.05);
        vertical-align: middle;
        cursor: pointer;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-appearance: none;
    }
    .button:focus,
    input[type=text]:focus,
    input[type=password]:focus {
        outline: none;
        border-color: #51a7e8;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.075), 0 0 5px rgba(81,167,232,.5);
    }

    #search input[type=text] {
        font-size: 18px;
        width: 500px;
    }
    #search .button {
        padding: 10px;
        width: 90px;
    }
    .container {
        position:absolute;
        left: 400px;
        top: 250px;
    }
    .stuinfo{
        position:absolute;
        left: 400px;
        top: 300px;
    }
    .stu_div{
        font-size: 35px;

        margin-top: 25px;
    }
</style>
<div class="container">
	<h1>用户名：<?php echo ($iname); ?></h1>
    <div id="search">
        <form action="<?php echo U('User/modify');?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
            旧 密 码：<input type="password" name="passwd_old" value="" placeholder="旧密码"><br>
            <br>
            新 密 码：<input type="password" name="passwd_new" value="" placeholder="密码不少于8位"><br>
            <br>
            确认一次：<input type="password" name="confirm" value="" placeholder="确认一次"><br>
            <br>
            <input class="button" type="submit" name="" value="确定">
        </form>
    </div>
    <div>
        <div>
            <h2 style="color: green"><?php echo ($manage_success); ?></h2>
        </div>
        <div>
            <h2 style="color: red"><?php echo ($manage_error); ?></h2>
        </div>
    </div>
</div>


</body>

</html>