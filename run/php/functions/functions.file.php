<?php

# https://stackoverflow.com/questions/5425891/how-do-i-check-if-a-directory-exists-is-dir-file-exists-or-both
/**
 * Checks if a folder exist and return canonicalized absolute pathname (sort version)
 * @param string $folder the path being checked.
 * @return mixed returns the canonicalized absolute pathname on success otherwise FALSE is returned
 */
function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    return ($path !== false AND is_dir($path)) ? $path : false;
}


function writeLine($str, $file, $append=TRUE, $end = "\n")
	{
	if($append)
		{
		file_put_contents($file, $str . $end, FILE_APPEND);
		} else {
				file_put_contents($file, $str . $end);
				}
	}		

#functions.file.php
function checkFolderRecursive($dir, $perm=0777)
		{		
		if (!folder_exist($dir))
			{
			mkdir ($dir , $perm , true); 
			}
		}

function getRemoteAndCache($remote,$local, $return=FALSE, $method="PHP")
	{
	echo("\n\n getRemoteAndCache :: " . $method . "\n\n");
	switch($method)
		{
		default:
		
			if(!file_exists($local))
				{
				$str = file_get_contents($remote);
					if($str === FALSE) { $str = ""; }
				file_put_contents($local, $str);
				if($return) { return $str; }
				} else {
						if($return) { $str = file_get_contents($local); return $str; }
						}
		break;
		
		case "casper":
		# C:\casperjs\bin\casperjs.exe get.remote.html.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html --sleep=250
		
		# C:/casperjs/bin/casperjs.exe C:/_git_/__NIC__/run/php/projects/MAPS/get.remote.html.js --remote=https://jcb.lunaimaging.com/luna/servlet/view/all?os=0 --local=Q:/project-MAPS/2021-04/jcb/pages/0001/index.html --sleep=250
			if(!file_exists($local))
				{
				putenv("PHANTOMJS_EXECUTABLE=C:/phantomjs/bin/phantomjs.exe");
					
				# https://www.php.net/manual/en/function.exec.php
				$cmd = "C:/casperjs/bin/casperjs.exe C:/_git_/__NIC__/run/php/projects/MAPS/get.remote.html.js --remote={remote} --local={local} --sleep=250";
				
				# $cmd = "C:/casperjs/bin/casperjs get.remote.html.js --remote={remote} --local={local} --sleep=1250";
				
				$cmd = str_replace("{remote}", $remote, $cmd);
				$cmd = str_replace("{local}",  $local,  $cmd);
				
				# $cmd = "dir /w"; 
				
				echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
				
				# exec($cmd . " 2>&1", $output, $retval) ;				
				#echo("<PRE>"); echo"\n\n"; print_r($output); echo"\n\n"; 
				#echo("<PRE>"); echo"\n\n"; print_r($retval); echo"\n\n"; 
				
				
				
				
				$info = shell_exec($cmd . " 2>&1") ;
				echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
				
				# sleep(1);
				} 
						
			if($return) 
				{ 
				if(!file_exists($local)) { echo"\n\n local NOT FOUND: $local \n\n"; return false; }
				$str = file_get_contents($local); 
				return $str; 
				}
				
		break;



		case "python":
		if(!file_exists($local))
				{
					
				# https://www.php.net/manual/en/function.exec.php
				$cmd = "C:/python3/python.exe C:/_git_/__NIC__/run/php/projects/MAPS/get.remote.html.py --remote={remote} --local={local} --sleep=500";

				$cmd = str_replace("{remote}", $remote, $cmd);
				$cmd = str_replace("{local}",  $local,  $cmd);
				
				echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 				
				
				
				$info = shell_exec($cmd . " 2>&1") ;
				echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
				# exit;
				
				# sleep(1);
				} 
						
			if($return) 
				{ 
				if(!file_exists($local)) { echo"\n\n local NOT FOUND: $local \n\n"; return false; }
				$str = file_get_contents($local); 
				return $str; 
				}
				
		break;	
		}
	}

# https://stackoverflow.com/questions/31115982/malformed-utf-8-characters-possibly-incorrectly-encoded-in-laravel
function convert_to_utf8_recursively($dat){
                      if( is_string($dat) ){
                         # return mb_convert_encoding($dat, 'UTF-8', 'UTF-8');
						 return mb_convert_encoding($dat, "UTF-8", mb_detect_encoding($dat, "UTF-8, ISO-8859-1, ISO-8859-15", true));
                      }
                      elseif( is_array($dat) ){
                         $ret = [];
                         foreach($dat as $i => $d){
                           $ret[$i] = convert_to_utf8_recursively($d);
                         }
                         return $ret;
                      }
                      else{
                         return $dat;
                      }
                }

# https://stackoverflow.com/questions/14523846/convert-unicode-from-json-string-with-php
# Be careful that some of these characters, which probably come from an editor such as Word are not translatable to ISO-8859-1, therefore will appear as '?' after ut8_decode.

# https://www.php.net/manual/en/function.json-encode.php
function storeJSON($myFile, $myArray = array(), $flags = JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE )
	{
	$myArray = convert_to_utf8_recursively($myArray);
	// # https://stackoverflow.com/questions/41972084/php-json-encode-not-working
		// echo"\n\n storeJSON $myFile \n\n";
		// echo"<PRE>";print_r($myArray);
		// $json = json_encode($myArray, $flags);
		// print_r( json_last_error_msg() );
		// echo"\n\n json $json \n\n";
		$json = json_encode($myArray, $flags);
	file_put_contents($myFile, $json);
	}
function getJSON($myFile, $depth = 512, $flags = JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE )
	{
	$json = json_decode(file_get_contents($myFile), TRUE, $depth, $flags);	
	return $json;
	}

function storeFile($myFile, $myString="",$mode="wb")
		{
		doDebug("\t STORING FILE [$myFile]");
		$h = fopen($myFile,$mode);
			fwrite($h, $myString);
			fclose($h);					
		}

?>