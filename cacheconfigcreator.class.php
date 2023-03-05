<?php

	class cacheConfigCreator
	{
		public static function setUpConfigFileSystem(PDO $instance, array $path)
		{
			if (!file_exists($path['directory'])) mkdir($path['directory']);
            
			fopen($path['directory'].$path['filename'], "w") 
				? $temp = fopen($path['directory'].$path['filename'], "w") 
				: common::fetchTernaryReturn("Cannot open file : ". $path['filename'],001);
			
			$to_return = $instance->query("SELECT sys_stg_key, sys_stg_value FROM system_settings")->fetchAll(PDO::FETCH_ASSOC);
			
			fwrite($temp, '<?php'."\r\n".'$_SYSCONF = '.var_export($to_return, true).';'."\r\n");
			fclose($temp);
		}
	}