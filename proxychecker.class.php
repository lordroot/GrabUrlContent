<?php
	
	class proxyChecker
	{
		# Instance & Buffer
		private $curlInstance = NULL;
		private $handleBuffer = NULL;
		
		#! Proxy Settings
		private $proxyAddr	  = NULL;
		private $proxyAmount  = NULL;
		
		#! Global Time Out
		const CONNEX_TIMEOUT  = 5;
		
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
				$this->handleBuffer[$nodeIndex] = curl_init("http://www.google.com/?lang=fr");
					curl_setopt($this->handleBuffer[$nodeIndex] , CURLOPT_PROXY  		  , $this->proxyAddr[$nodeIndex] );
					curl_setopt($this->handleBuffer[$nodeIndex] , CURLOPT_CONNECTTIMEOUT  , self::CONNEX_TIMEOUT		 );
					curl_setopt($this->handleBuffer[$nodeIndex] , CURLOPT_TIMEOUT  		  , self::CONNEX_TIMEOUT 		 );
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
				$this->temporaryStatus = curl_getinfo($this->handleBuffer[$nodeIndex]);
				
				if ($this->temporaryStatus['http_code'] >= 200 && $this->temporaryStatus['http_code'] < 300)
					$this->availableProxy[$nodeIndex] = $this->proxyAddr[$nodeIndex] 
					. " total time =  " . $this->temporaryStatus['total_time']
					. " http code =  " . $this->temporaryStatus['http_code']
					. " speed download = " . $this->temporaryStatus['speed_download']
					. " speed upload = " . $this->temporaryStatus['speed_upload'];
				else $this->availableProxy[$nodeIndex] = "unavailable proxy";
					
				$this->fetchedUrlData = curl_multi_getcontent($this->handleBuffer[$nodeIndex]);
				curl_multi_remove_handle($this->curlInstance , $this->handleBuffer[$nodeIndex]);
			}
			
			curl_multi_close($this->curlInstance);
			return $this->availableProxy;
		}
	}