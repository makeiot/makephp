<?php
class MPException
{
	private static  $errorMsg;
	public static function setException($msg)
	{
		MPException::$errorMsg = $msg;
		return;
	}
	public static function getErrorMsg()
	{
		return MPException::$errorMsg;
	}
}
?>