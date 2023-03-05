<?php

	class grabUrlContent
	{
		#! Curl Struct & Curl Options

		private $curlStruct 	  = NULL;
		private $curlHeader 	  = array();
		private $curlReturnedData = NULL;
		private $targetUrl 		  = NULL;

		#!	Cookie Options

		private $cookieTempFile   = NULL;
		private $cookieRecipient  = NULL;

		#! Proxy Options

		private $proxyAddress 	  = NULL;
		private $proxyPort	 	  = NULL;

		#! Header Options

		private $referer 		  = NULL;
		private $userAgent 		  = NULL;
		private $curlPostOpt 	  = NULL;
		private $timeOut 		  = 30;

		#! Header Constant Options

		const allowCurlPost 	  = TRUE;
		const allowOutputHeader	  = TRUE;
		const followLocation 	  = TRUE;
		const httpProxyTunnel	  = TRUE;
		const connexion 		  = "keep-alive";
		const keepAlive 		  = 300;

		public function __construct( requestStructure $arrayData )
		{
			$this->curlStruct = curl_init($arrayData->targetUrl);
			
			$this->targetUrl 	    = $arrayData->targetUrl;
			$this->referer 	 	    = $arrayData->referer;
			$this->userAgent 	    = $arrayData->userAgent;
			$this->timeOut    	    = $arrayData->timeOut;
			
			$this->proxyAddress     = $arrayData->proxyAddress;
			$this->proxyPort  	    = $arrayData->proxyPort;
			$this->cookieTempFile   = $arrayData->cookieJar;
			$this->cookieRecipient  = $arrayData->cookieFile;
		}

		public function getTargetUrlContent()
		{
			$this->curlReturnedData = curl_exec( $this->curlStruct );
			curl_close($this->curlStruct);
			
			return $this->curlReturnedData;
		}

		public function setCurlOptions()
		{
			$this->curlHeader = array(
				'User-Agent'		=> $this->userAgent,
				'Referer'			=> $this->referer,
				'Host'				=> $this->targetUrl,
				'Connection'		=> self::connexion
			);

			curl_setopt( $this->curlStruct , CURLOPT_HTTPHEADER 	 , $this->curlHeader 	  );
			curl_setopt( $this->curlStruct , CURLOPT_HEADER	   		 , TRUE 				  );
			curl_setopt( $this->curlStruct , CURLOPT_TIMEOUT 		 , $this->timeOut 		  );
			curl_setopt( $this->curlStruct , CURLOPT_FOLLOWLOCATION  , self::followLocation   );
			curl_setopt( $this->curlStruct , CURLOPT_COOKIEFILE 	 , $this->cookieRecipient );
			curl_setopt( $this->curlStruct , CURLOPT_COOKIEJAR  	 , $this->cookieTempFile  );
			curl_setopt( $this->curlStruct , CURLOPT_POST 			 , self::allowCurlPost 	  );
			curl_setopt( $this->curlStruct , CURLOPT_POSTFIELDS  	 , $this->curlPostOpt	  );
			curl_setopt( $this->curlStruct , CURLOPT_PROXY 			 , $this->proxyAddress 	  );
			curl_setopt( $this->curlStruct , CURLOPT_PROXYPORT 		 , $this->proxyPort		  );
			curl_setopt( $this->curlStruct , CURLOPT_PROXYAUTH 	     , CURLAUTH_BASIC		  );
			curl_setopt( $this->curlStruct , CURLOPT_HTTPPROXYTUNNEL , self::httpProxyTunnel  );
		}
	}