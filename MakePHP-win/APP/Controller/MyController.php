<?php
namespace APP\Controller;
use system\controller\controller;
	class MyController extends controller
	{
		function MyController()
		{
			echo "This is MyController!"."<br/>";
		}
		function printArgs()
		{
			if(!(isset($_GET['font']) && isset($_GET['psw'])))return false;		
			 //echo "Action of MyController!"."<br/>"."The value of font is :".$_GET['font']." Psw:".$_GET['psw']."<br/>";
			$yes = 'ok';
			$testObj = new testController();
			$this->assign('testObj',$testObj);
			$this->assign('yes',$yes);
			$this->assign(array('yes'=>222,'pid'=>333,'user'=>array('va'=>'tobin')));
			//var_dump($conf);
			//echo '<br/>';
			$db = M('login');
//			for($i = 0;$i<10;$i++)
//				{
//					$data = array(
//						'id'=>$i,
//						'name'=>'admin',
//						'psw'=>'666',
//						'score'=>888
//					);
//					$db->add($data);
//				}
			$reData = $db->where('id=1')->select();
			$this->ajaxReturn($reData,'xml');
			//$db->where('id=2')->delete();
			if($_GET['psw']==1)
			$this->display('view.html');
//				include(dirname(__FILE__)."\../view/view.php");
//			display("view.php");
		}
		function Index()
		{
			echo "The Index action of MyController!"."<br/>";
		}
	}
?>
