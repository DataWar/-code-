<?PHP

class myCRAN
	{		
	var $debug = false;

	function myCRAN()  # this is constructor , php 8?
		{
		

		}
		
	function getSizeMB($str)
		{			
		$number = preg_replace('/[A-Z]+/', '', $str);
		$number = preg_replace('/[a-z]+/', '', $number);		
		$which = str_replace($number, '', $str);
		
		$number = (float) $number;
		
		#echo"<PRE>"; print_r($which); echo" monte "; print_r($number); # exit;
		
		switch($which)
			{
			default:
			case "M":
			
			break;
			
			case "K":
				$number = $number / 1000; # maybe 1024
			break;
			
			case "G":
				$number = $number * 1000; # maybe 1024
			break;
			}
		# echo" -- "; echo($number);
		return $number;
		}
	function getVersion($str)
		{
		$str = str_replace( array(".tar",".gz",".zip"), "", $str);
		$str = str_replace( $this->currentPackage, "", $str);
		$str = str_replace( "_", "", $str);
		return trim($str);
		}
	function parseFunctions($str)
		{
		$info = array();
		
		$functions = sliceDice($str, '<input id="filter" type="text" placeholder="Search">', "</table>", FALSE);
		
		## seems to have CloudFlare issues ...
		
		$tmp = explode("<tr>",$functions);
			  echo"<PRE>";print_r($tmp);exit;
			 
			 
		return $info;
		}
	
	function parseCheck($str)
		{
		$checkA = array();
		
		$tmp = explode("<tr>",$str);
			 # echo"<PRE>";print_r($tmp);exit;
			 
			 
			$i = 0;
			foreach($tmp as $line)
				{
				if($i > 2)
					{	
					$data = explode("</td>",$line);
					# echo"<PRE>";print_r($data);exit;
					if(isset($data[1]))
						{
						$flavor = trim(strip_tags($data[0]));
						$version = trim(strip_tags($data[1]));
						
						$install = trim(strip_tags($data[2]));
						$check = trim(strip_tags($data[3]));
						$total = trim(strip_tags($data[4]));
						$status = trim(strip_tags($data[5]));
						$flags = trim(strip_tags($data[6]));
						
						
					$checkA[$flavor] = array("flavor" => $flavor, "version" => $version, "install" => $install, "check" => $check, "total" => $total, "status" => $status, "flags" => $flags);
						}
					#echo"<PRE>";print_r($checkA);exit;
					}
				$i++;				
				}
		
			#echo"<PRE>";print_r($checkA);exit;
		
		return $checkA;
		}
	function parseArchive($str)
		{
		$history = array();
		
			$tmp = explode("<tr>",$str);
			# echo"<PRE>";print_r($tmp);exit;
			
			$i = 0;
			foreach($tmp as $line)
				{
				if($i > 3)
					{	
					$data = explode("</td>",$line);
					# echo"<PRE>";print_r($data);exit;
					if(isset($data[1]))
						{
						$file = trim(strip_tags($data[1]));
							$version = $this->getVersion($file);
						$date = trim(strip_tags($data[2]));
						$size = $this->getSizeMB( trim(strip_tags($data[3])) );
					$history[$date] = array("version" => $version, "file" => $file, "date" => $date, "sizeMB" => $size);
						}
					#echo"<PRE>";print_r($history);exit;
					}
				$i++;				
				}
		
			#echo"<PRE>";print_r($history);
			sort($history);
			#echo"<PRE>";print_r($history);exit;
		return $history;		
		}
		
	function parseIndex($str)
		{
		$index = array();
		
		$index["url"] = "https://CRAN.R-project.org/package=".$this->currentPackage;
		$index["pdf"] = "https://cran.r-project.org/web/packages/".$this->currentPackage.'/'.$this->currentPackage.".pdf";
		
		$index["title"] = sliceDice($str,"<h2>","</h2>");
		$index["description"] = sliceDice($str,"<p>","</p>");
		
		# echo"<PRE>";print_r($index);exit;
#################################################		
		$summary = sliceDice($str, '<table summary="Package ' . $this->currentPackage . ' summary">', "</table>", FALSE);
		
		$mySummary = array();
		$tmp = explode("<tr>",$summary);
			# echo"<PRE>";print_r($tmp);exit;
			
			$i = 0;
			foreach($tmp as $line)
				{
				if($i > 0)
					{	
					$data = explode("</td>",$line);
						$key = trim( str_replace(":","", strip_tags($data[0]) ) );
						$key = str_replace("&nbsp;","_",$key);
						$val = trim(removeWhiteSpace($data[1]));
					switch($key)
						{
						default:
							$val = trim(strip_tags($val));
							$tmp = explode("&#",$val);  # xcode B.S.
							$val = trim($tmp[0]);
						break;						
						case "Imports":
						case "Suggests":
						case "Depends":
						case "SystemRequirements":
							$val = str_replace( array("&ge;","&gt;"), array(">=", ">"), $val);
							$val = trim(strip_tags($val));						
						break;						
						}
					$mySummary[$key] = $val;
					}
				$i++;				
				}
		
		
		$index["summary"] = $mySummary;	
			#echo"<PRE>";print_r($mySummary);exit;
#################################################	

/*
		$downloads = sliceDice($str, '<h4>Downloads:</h4>', "</table>", FALSE, "start");
					
		$myDownload = array();
		
		$tmp = explode("<tr>",$downloads);
			  echo"<PRE>";print_r($tmp);exit;
			  
			  
	*/		  
			  
		
		
		$reverse = sliceDice($str, '<h4>Reverse dependencies:</h4>', "</table>", FALSE, "start");
		
		#$tmp = explode("<tr>",$reverse);
		
		$myReverse = array();
		$tmp = explode("<tr>",$reverse);
			# echo"<PRE>";print_r($tmp); # exit;
			
			$i = 0;
			foreach($tmp as $line)
				{
				if($i > 0)
					{	
					$data = explode("</td>",$line);
						$key = trim( str_replace(":","", strip_tags($data[0]) ) );
						$key = str_replace("&nbsp;","_",$key);
						$val = trim(removeWhiteSpace($data[1]));
					switch($key)
						{
						default:
							$val = trim(strip_tags($val));
							$tmp = explode("&#",$val);  # xcode B.S.
							$val = trim($tmp[0]);
						break;						
						case "Reverse_imports":
						case "Reverse_suggests":
						case "Reverse_depends":
							$val = str_replace( array("&ge;","&gt;"), array(">=", ">"), $val);
							$val = trim(strip_tags($val));						
						break;						
						}
					$myReverse[$key] = $val;
					}
				$i++;				
				}
		
		#echo"<PRE>";print_r($myReverse);exit;
		
		$index["reverse"] = $myReverse;	
		
		
		
			
		return $index;		
		}
		
	function getOne($package="openssl",$details=array())
		{
		$mypath = $this->currentPath . $package . "/";
			checkFolderRecursive($mypath);
			
		$this->currentPackage = $package;
		$this->currentPackageDetails = $details;
			
		$json = $mypath . "details.json";
		if(file_exists($json))
			{
			return getJSON($json);	
			}
		
		# we need to build it ...
		$myOne = array();
		
		$myOne["package"] = $this->currentPackage;
		$myOne["details"] = $this->currentPackageDetails;
			
		$remote = str_replace("{myPackage}", $package, $this->urlTemplates["packageIndex"]);
		$local = $mypath . "index.html";
			$strIndex = getRemoteAndCache($remote,$local, TRUE);
		$myOne["index"] = $this->parseIndex($strIndex);
		
			$this->currentVersion = (isset($myOne["index"]["summary"]["Version"])) ? $myOne["index"]["summary"]["Version"] : "";
		
			
		$remote = str_replace("{myPackage}", $package, $this->urlTemplates["packageArchive"]);
		$local = $mypath . "archive.html";
			$strArchive = getRemoteAndCache($remote,$local, TRUE);
		$myOne["history"] = $this->parseArchive($strArchive);
			# $myOne["details"]["version"]["first"] = 
			
		
			
		$remote = str_replace("{myPackage}", $package, $this->urlTemplates["packageCheck"]);
		$local = $mypath . "check.html";
			$strCheck = getRemoteAndCache($remote,$local, TRUE);
		$myOne["check"] = $this->parseCheck($strCheck);  # flags ?  # dplyr
		
		
			
		
		$functions = array();
		/* # cloud flare issues? 
		if(!empty($this->currentVersion))
			{
			$remote = str_replace("{myPackage}", $package, $this->urlTemplates["packageFunctions"]);
			$remote = str_replace("{myVersion}", $this->currentVersion, $remote);
			$local = $mypath . "functions.html";
				$strFunctions = getRemoteAndCache($remote,$local, TRUE);
			$functions = $this->parseFunctions($strFunctions);
			}
		*/
		$myOne["functions"] = $functions;		
			
		# echo"<PRE>";print_r($myOne);		exit;

		storeJSON($json, $myOne);
		}
	function parseList()
		{
		$html = $this->currentPath . "list.html";	
			$local = str_replace("list.html", "list.json", $html);
		$str = file_get_contents($html);
		$myList = array();
			$tmp = explode("<tr>",$str);
			$i = 0;
			foreach($tmp as $line)
				{
				if($i > 1)
					{	
					$data = explode("<td>",$line);
						$date = trim(strip_tags($data[1]));
						$name = trim(strip_tags($data[2]));
						$desc = trim(strip_tags($data[3]));
					$myList[$name] = array("name" => $name, "date" => $date, "description" => $desc);
					#echo"<PRE>";print_r($data);exit;
					}
				$i++;				
				}
			#echo"<PRE>";print_r($myList);exit;
		
		storeJSON($local, $myList);
		}
	function getList()
		{
		$local = $this->currentPath . "list.json";
		$remote = $this->urlTemplates["list"];
		
		if(file_exists($local))
			{
			$myList = getJSON($local);	
			} else {
					$html = str_replace("list.json", "list.html", $local);
						getRemoteAndCache($remote,$html);
					# parse this ...
					$this->parseList();					
					$myList = getJSON($local);	
					}
		return $myList;
		}
	}	
?>