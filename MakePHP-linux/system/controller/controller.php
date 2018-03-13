<?php
namespace system\controller;
require_once(dirname(__FILE__).'/../error/MPException.php');
require_once(dirname(__FILE__).'/../data/dataconvert.php');
use system\data\mk_arr2xml;
	class controller
	{
		protected $m_vars = array();
		public function __construct()
		{
//			echo "new a obj!<br/>";
		}
		protected function display($tagPage)
		{
			$path = dirname(__FILE__).'/../../APP/View/'.$tagPage;
			if(file_exists($path))
			{
				extract($this->m_vars);
				require_once($path);
			}else
			{
				MPException::setException("不存在 ".$tagPage." 页面!");
				require_once(dirname(__FILE__).'/../error/404.php');
				return false;
			}
		}
		function __call($name, $args)  
		{  
		    if($name=='assign')  
		    {  
		        switch(count($args))  
		        {  
		            case 0: ;break;  
		            case 1: $this->assign1($args[0]); break;  
		            case 2: $this->assign2($args[0], $args[1]); break;  
		            default: //do something  
		             break;  
		        }  
		    }  
		}  
		  
		protected function assign1($value)  
		{  
		    // 数组、对象
		    //echo 'var cont:'.count($value).'<br/>';
		    if(is_object($value))
		    	{
		    		MPException::setException('<h1>在调用assign()时，您没有为'.get_class($value).'类的对象命名！</h1><br/><h3>-- assign() 参数为对象时，必须指明对象名！</h3>');
					require_once(dirname(__FILE__).'/../error/exceptions.php');
		    		return false;
		    	}
		     $cVar = count($value);
		    foreach($value as $key => $curValue)    
		    	{
		    		//echo $key.'<br/>';
		    		$this->m_vars[$key] = $curValue;
		    	}
		}  
		  
		protected function assign2($name,$value)  
		{  
		    // 取了别名
		     $cVar = count($value);
		    for($i=0;$i<$cVar;$i++)
		    	{
		    		$this->m_vars[$name]=$value;
		    	}
		}
		protected function ajaxReturn($data,$type='json')
		{
			switch($type)
			{
				case 'json':
				{
						echo json_encode($data);
				}
				break;
				case 'xml':
				{
					$obj = new mk_arr2xml();
					echo $obj->toXML($data);
				}
				break;
				
			}
		}

	}

?>