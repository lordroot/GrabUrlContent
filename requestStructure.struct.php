<?php

	class requestStructure
	{
		public $targetUrl    = NULL;
		public $referer      = NULL;
		public $userAgent    = NULL;
		public $timeOut   	 = NULL;
		public $proxyAddress = NULL;
		public $proxyPort    = NULL;
		public $cookieJar    = NULL;
		public $cookieFile   = NULL;
		
		public function __construct($a , $b , $c , $d , $e , $f , $g , $h)
		{
			$this->targetUrl	= $a;
			$this->referer		= $b;
			$this->userAgent	= $c;
			$this->timeOut		= $d;
			$this->proxyAddress = $e;
			$this->proxyPort	= $f;
			$this->cookieJar	= $g;
			$this->cookieFile	= $h;
		}
	}