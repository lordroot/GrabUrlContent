<?php

	class common
	{
		public static function exceptionTreatement($exception_text, $exception_code)
		{
			switch ($exception_code)
			{
				case 1337; return $exception_text." - ".$exception_code;
				default: return $exception_text." - ".$exception_code;
			}
		}
		
		public static function randomString($length, $string)
		{
			$generatedRandomString = NULL;    

			for ($p = 0; $p < $length; $p++)
				$generatedRandomString .= $characters[mt_rand(0, strlen($string))];

			return $string;
		}
		
		public static function fetchTernaryReturn($string , $code)
		{
			return $string ." - ". $code;
		}
	}