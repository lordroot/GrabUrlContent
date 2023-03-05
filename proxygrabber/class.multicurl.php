<?php
	
	class proxyChecker
	{
		private $curlInstance = NULL;
		private $handleBuffer = NULL;
		
		private $proxyAddr	  = array();
		private $proxyAmount  = NULL;
		
		public function __construct(array $proxyList)
		{
			$this->proxyAddr    = $proxyList;
			$this->proxyAmount  = count($proxyList);
			$this->curlInstance = curl_multi_init();
		}
		
		public function setCurlHandle()
		{
			for($nodeIndex = 0 ; $nodeIndex < $this->proxyAmount ; $nodeIndex++) 
			{
				$this->handleBuffer[$nodeIndex] = curl_init($this->proxyAddr[$nodeIndex]);
				curl_setopt($this->handleBuffer[$nodeIndex] , CURLOPT_URL	 , "http://www.google.com/" );
				curl_setopt($this->handleBuffer[$nodeIndex] , CURLOPT_PROXY  , $proxy				    );
				curl_multi_add_handle($this->curlInstance   , $this->handleBuffer[$nodeIndex]);
			}
		}
		
		public function getProxyReturn()
		{
			do 
			{ curl_multi_exec($this->curlInstance , $runningInstance);
			} while($runningInstance);

			for($nodeIndex = 0 ; $nodeIndex < $this->proxyAmount ; $nodeIndex++) 
			{
				if ($this->handleBuffer[$nodeIndex])
					$this->availableProxy[$nodeIndex] = $this->proxyAddr[$nodeIndex];
					
				curl_multi_remove_handle($this->curlInstance , $this->handleBuffer[$nodeIndex]);
			}
			
			curl_multi_close($this->curlInstance);
			return $this->availableProxy;
		}
	}