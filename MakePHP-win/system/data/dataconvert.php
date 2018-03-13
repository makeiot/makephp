<?php
namespace system\data;
class mk_arr2xml {
  private static $xml;
  function __construct()
  {
  	mk_arr2xml::$xml = simplexml_load_string('<request />');
  }
  public function toXML($arr)
  {
  	$this->create($arr,mk_arr2xml::$xml);
  	return mk_arr2xml::$xml->saveXML();
  }
  private function create($ar, $xml) {
    foreach($ar as $k=>$v) {
        if(is_array($v)) {
            $x = mk_arr2xml::$xml->addChild($k);
            $this->create($v, $x);
        }else mk_arr2xml::$xml->addChild($k, $v);
    						}
	}
}
?>
