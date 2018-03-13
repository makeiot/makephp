<?php
namespace APP\Controller;
use system\controller\controller;
	class IndexController extends controller
	{
		function IndexController()
		{
			
		}
		function Index()
		{
			$this->display('index.html');
		}
	}
?>