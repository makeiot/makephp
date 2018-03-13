<?php
use system\model\dbhelper;
	function M($table='')
	{
		//返回数据库操作对象
		$obj = dbhelper::getInstance($table);
		return $obj;
	}
?>