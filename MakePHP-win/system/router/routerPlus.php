<?php
//ob_start();
require_once('pathhelper.php');
header("Content-type: text/html; charset=utf-8");
require_once(dirname(__FILE__).'/../error/MPException.php');
require_once(dirname(__FILE__).'/../model/globalfunctions.php');
require_once(dirname(__FILE__).'/../config/confighelper.php');
//error_reporting(0);
function classLoader($class_name) 
{ 
	$tagFile = dirname(__FILE__).'/../../APP/Controller/'.$class_name.'.php';
	$tagFileDirList = array(
		dirname(__FILE__).'/../../'.$class_name.'.php',
		dirname(__FILE__).'/../../APP/Controller/'.$class_name.'.php',
		dirname(__FILE__).'/../error/'.$class_name.'.php',
		dirname(__FILE__).'/../controller/'.$class_name.'.php',
		dirname(__FILE__).'/../model/'.$class_name.'.php'
	);
	$isExist = false;
	for($i=0;$i<count($tagFileDirList);$i++)
		{
			if(file_exists($tagFileDirList[$i]))
				{
					
			//		require_once($tagFile);
//					echo 'SPL load class:', $tagFileDirList[$i], '<br />'; 
					require_once($tagFileDirList[$i]);
					$isExist = true;
			 		
			 		break;
				}else
				{
					//echo $tagFileDirList[$i].'Not Found!,<br/>';
				}
		}
	if(!$isExist)
	{
//		echo "错误：不存在该控制器！<br/>";
		MPException::setException("不存在 ".$class_name." 控制器!");
		require_once(dirname(__FILE__).'/../error/404.php');
		return false;
	}
} 
spl_autoload_register('classLoader'); 

if( !isset( $_SERVER['PATH_INFO'] ) ){
    $pathinfo = 'default';
}else{
    $pathinfo =  explode('/', $_SERVER['PATH_INFO']);
}
$cField = count($pathinfo);
if($pathinfo[1]=="__SRC__")
{
	//SRC重定向
	$filename = dirname(__FILE__).'/../../APP/public'.substr($_SERVER['PATH_INFO'],strlen("__SRC__")+1,strlen($_SERVER['PATH_INFO'])-strlen("__SRC__"));
//	echo $filename;
//	print_r(pathinfo($filename,PATHINFO_EXTENSION ));
	$hts = require_once(dirname(__FILE__).'/../config/headerTypeHelper.php');
	$ht ="Content-type:".$hts[pathinfo($filename,PATHINFO_EXTENSION )];
//	$fp=fopen($filename, "rb"); //二进制方式打开文件 
//	if ($fp) { 
	header("$ht"); 
//	header ("Content-Length: ".filesize($filename));
//	header('Content-Disposition: inline;');
//	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//	fpassthru($fp); // 输出至浏览器 
//	fclose($fp);
//	exit; 
//	} else { 
//	// error 
//	} 
$size = filesize ( $filename );
$time = date ( 'r', filemtime ( $filename ) );
 
$fm = @fopen ( $filename, 'rb' );
if (! $fm) {
    header ( "HTTP/1.1 505 Internal server error" );
    return;
}
 
$begin = 0;
$end = $size - 1;
 
if (isset ( $_SERVER ['HTTP_RANGE'] )) {
    if (preg_match ( '/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER ['HTTP_RANGE'], $matches )) {
        // 读取文件，起始节点
        $begin = intval ( $matches [1] );
 
        // 读取文件，结束节点
        if (! empty ( $matches [2] )) {
            $end = intval ( $matches [2] );
        }
    }
}
 
if (isset ( $_SERVER ['HTTP_RANGE'] )) {
    header ( 'HTTP/1.1 206 Partial Content' );
} else {
    header ( 'HTTP/1.1 200 OK' );
}
 
header ( 'Cache-Control: public, must-revalidate, max-age=0' );
header ( 'Pragma: no-cache' );
header ( 'Accept-Ranges: bytes' );
header ( 'Content-Length:' . (($end - $begin) + 1) );
 
if (isset ( $_SERVER ['HTTP_RANGE'] )) {
    header ( "Content-Range: bytes $begin-$end/$size" );
}
 
header ( "Content-Disposition: inline; filename=$filename" );
header ( "Content-Transfer-Encoding: binary" );
header ( "Last-Modified: $time" );
 
$cur = $begin;
 
// 定位指针
fseek ( $fm, $begin, 0 );
 
while ( ! feof ( $fm ) && $cur <= $end && (connection_status () == 0) ) {
    print fread ( $fm, min ( 1024 * 16, ($end - $cur) + 1 ) );
    $cur += 1024 * 16;
}

}else if($cField == 1)
{
		
	//直接访问
	//var_dump($pathinfo);
	return false;
}else if($cField == 2)
{
	if($pathinfo[1]=="")
	{
		//有可能没有任何字段
//		include_once('../../APP/Controller/IndexController.php');
		$tagClass = APP_CTRL_NS.'IndexController';
		$obj = new $tagClass;
		$obj->Index();
//		echo "没有指定控制器！"."<br/>";
	}else
	{
		//只指定了控制器，没有指定方法
//		include_once("../../APP/Controller/".$pathinfo[1]."Controller.php");
		$tagClass = APP_CTRL_NS.$pathinfo[1]."Controller";
		$obj = new $tagClass;
		
		$tagAction="Index";
		call_user_func(array($obj,$tagAction));
//		echo '控制器：',$pathinfo[1]."<br/>";
	}
	
}else if($cField == 3)
{
	if($pathinfo[2]!="")
	{
		//指定了方法，没有任何参数
//		include_once("../../APP/Controller/".$pathinfo[1]."Controller.php");
		$tagClass = APP_CTRL_NS.$pathinfo[1]."Controller";
		$obj = new $tagClass;
		$tagAction=$pathinfo[2];
		if(method_exists($obj,$tagAction))
		call_user_func(array($obj,$tagAction));
		else
		{
			MPException::setException("不存在 ".$tagAction." 方法!");
			require_once(dirname(__FILE__).'/../error/404.php');
			return false;
		}
//		echo '控制器：',$pathinfo[1]."<br/>";
//		echo '方法：',$pathinfo[2]."<br/>";
	}else
	{
		//没有指定方法，而是用/代替
//		include_once("../../APP/Controller/".$pathinfo[1]."Controller.php");
		$tagClass = $pathinfo[1]."Controller";
		try{
			$obj = new $tagClass;
			$tagAction="Index";
			if(method_exists($obj,$tagAction))
				call_user_func(array($obj,$tagAction));
			else
			{
			MPException::setException("不存在 ".$tagAction." 方法!");
			require_once(dirname(__FILE__).'/../error/404.php');
			return false;				
			}
		}catch(exception $e)
		{
			
		}
	
//		echo '控制器：',$pathinfo[1]."<br/>";
	}
}else
{
	//	echo '控制器：',$pathinfo[1]."<br/>";
	//	echo '方法：',$pathinfo[2]."<br/>";
		$args = array_slice($pathinfo,3);
		$cArgs = count($args);
		if($args[$cArgs-1]=="")
			array_pop($args);
		$cArgs = count($args);
		for($i=0;$i<$cArgs-1;$i+=2)
		{
				$_GET[$args[$i]] = $args[$i+1];
		}
	//	echo '参数：',var_dump($args)."<br/>";
//		include_once("../../APP/Controller/".$pathinfo[1]."Controller.php");
		$tagClass = APP_CTRL_NS.$pathinfo[1]."Controller";
		$obj = new $tagClass;
		$tagAction=$pathinfo[2];
		if(method_exists($obj,$tagAction))
			call_user_func(array($obj,$tagAction));
		else
		{
			MPException::setException($tagClass."不存在 ".$tagAction." 方法!");
			require_once(dirname(__FILE__).'/../error/404.php');
			return false;			
		}
}
?>