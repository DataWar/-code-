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
		
		
	function buildSQL()
		{
		# read-in XLS
		
		$table = PHP_DATA . "database-schema/table.xlsx";
		$xls = PHP_LIBS . "PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
		# require_once($xls);
		
		
		
		echo"<PRE>";
		
		print($table);
		
		# $data = PHPExcel_IOFactory::load($table);
		#  print_r($data);
		
		
		# $this->XLS = new PHPExcel;
		# https://github.com/PHPOffice/PHPExcel/blob/1.8/Examples/20readexcel5.php
		
		# require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
		# $objPHPExcel = PHPExcel_IOFactory::load("05featuredemo.xlsx");


		
		}
		
		
	function parseMaintainer($info, $mstr)
		{
		$mstr = str_replace('"', '', $mstr);	# StandardizeText
			
		$tmp = explode(",", $mstr);
			# echo"<PRE>"; 			print_r($tmp); 			print_r($info); # exit;			
		$rank = 1;
		foreach($tmp as $author)
			{
			$author = trim($author);
			$author = rtrim($author, ".");
			if(!empty($author))
				{
				if(!isset($info[$author])) { $info[$author] = array(); }
				$roles = array();
				$roles[] = "maint";
				# $info[$author][] = "maint";
				$info[$author]["maintain"] = array("rank"=>$rank, "roles"=>$roles);	
				$rank++;
				}				
			}			
		return $info;
		}
	function parseAuthors($astr, $mstr,  $method = "roles")
		{
		#echo"<PRE>"; echo"\n\n"; print_r( explode(",", $astr) ); echo"\n\n"; print_r($astr); echo" ---> "; print_r($mstr); echo"\n\n"; # exit; 
		
		# echo"<PRE>"; echo"\n $method \n"; print_r($astr); echo" ---> "; print_r($mstr); echo"\n\n"; # exit; 
		
		# print_r($astr); echo"\n\n";
require(PHP_INCLUDE . "projects/CRAN/includes/require.author.cleanup.php");


		
		# print_r($astr); echo"\n\n";
		
# count () paranthesis and append to each author ... idiociy of the package
		
			
		# https://journal.r-project.org/archive/2012-1/RJournal_2012-1_Hornik~et~al.pdf
		# "aut" (Author):
		# "com" (Compiler):
		# "ctb" (Contributor):
		# "cph" (Copyright holder):
		# "cre" (Creator):
		# "ths" (Thesis advisor):
		# "trl" (Translator):
		# "maint" (Maintainer): # monte adds ...
		# "auth" (Author): # monte adds ... not explicit
		$info = array();
		

		
		switch($method)
			{
			default:
			case "roles":
			
			# echo"\n\n $astr \n\n";
			$tmp = explode("]", $astr);
			#echo"<PRE>";print_r($tmp);
			$rank = 1;
			foreach($tmp as $line)
				{
				$line = str_replace("]","",$line);
				$tmp2 = explode("[", $line);
				#echo"<PRE>";print_r($tmp2);
				
				$author = trim($tmp2[0]);
				$author = rtrim($author, ".");
				$author = rtrim($author, ",");
				$author = ltrim($author, ",");
				$author = trim($author);
				#echo"\n\n $author \n\n";
				
				if(!empty($author))
					{
					# bipartite
					# timeROC
					# rpinterest
					# seqRFLP
					# tbdiag
					# omopr
					# MDSMap
					# "Author": "Mikko Vihtakari  [aut, cre] (Institute of Marine Research), Hadley Wickham [ctb], Simon O'Hanlon [ctb], Roger Bivand [ctb]",
					#if(!isset($tmp2[1])) { echo"<PRE>"; print_r($astr); print_r($line); exit; }
					
					if(!isset($tmp2[1])) { return $this->parseAuthors($astr, $mstr, "oldschool"); }
					
					$tmp3 = explode(",", $tmp2[1]);
					#echo"<PRE>";print_r($tmp3);
					
					if(!isset($info[$author]["author"]))
						{
						$info[$author]["author"] = array("rank"=>$rank, "roles"=>array(), "parenthesis"=>$numberOfIdiots, "parenthesis-length"=>$strLengthIdiots);
						}
					
					$roles = array();
					foreach($tmp3 as $role)
						{
						$role = trim($role);
						$roles[] = $role;
						}
					$info[$author]["author"]["roles"] = array_merge($info[$author]["author"]["roles"], $roles);
					$rank++;
					}
				}
				
			# echo"<PRE>";print_r($info);
			
			
			$info = $this->parseMaintainer($info, $mstr);
			
			#if($this->currentPackage == "healthyR.ts")
				{
				#echo"<PRE>";print_r($info); exit;
				}
			
			break;
			
			# ggOceanMaps
			
			case "oldschool":
				
				# ggenealogy 
				# bipartite
					$replaces = array();
									
					# nlreg 
					$replaces[] = "S original by";
					$replaces[] = "R port by";					
					$replaces[] = "following earlier work by";
					
					
					# quadprog 
					$replaces[] = "Fortran contributions from";
					$replaces[] = "(dposl/LINPACK and (a modified version of) dpodi/LINPACK)";
					
					$replaces[] = "with additional code from";
					$replaces[] = "also based on C-code developed by";	
					$replaces[] = "with contributions from";		 # RXMCDA 	
					
					$replaces[] = "port by";
					
				
				$astr = str_replace($replaces, " , ", $astr);
				$astr = str_replace("/", " , ", $astr);
				$astr = str_replace(" and ", " , ", $astr);
				# with additional code from
				# also based on C-code developed by
				# replace "and" with ","
				# replace / with " " space
				# echo("\n "); print_r($astr);
				$tmp = explode("," , $astr);
				# print_r($tmp);
				$rank = 1;
				foreach($tmp as $author)
					{
					$author = trim($author);
					$author = rtrim($author, ".");
					if(!empty($author))
						{
						if(!isset($info[$author])) { $info[$author] = array(); }
						# $info[$author][] = "auth";
						$roles = array("auth");
						
						if(!isset($info[$author]["author"]))
							{						
							$info[$author] = array("author"=> array("rank"=>$rank, "roles"=>$roles));
							} else {
									$info[$author]["author"]["roles"] = array_merge($info[$author]["author"]["roles"], $roles);
									}
						# $info[$author]["maintain"] = array("rank"=>$rank, "roles"=>$roles);	
						$rank++;
						}
					}
				
				$info = $this->parseMaintainer($info, $mstr);
			break;			
			}
		return $info;
		}
	
	function summarizeCRAN($l="myList")
		{
		$myList = $this->getList();
		$i = 1; $total = count($myList); 
		
		
			## shuffle($myList);  
			
			if($l == "myList") # default value, normal run
			{
			
			$this->summaryPath = PHP_DATA . "CRAN".DIRECTORY_SEPARATOR."summary".DIRECTORY_SEPARATOR;
				checkFolderRecursive($this->summaryPath);
		
			# is this not doing the "piped" thing???
			$this->authorFile = $this->summaryPath . "authors.txt";
			$header = "package|author|rank.a|rank.m|n.roles|total.authors|total.roles|total.extra|total.extra2|cph";
			writeLine($header, $this->authorFile, FALSE);
			
			
			$this->packageFile = $this->summaryPath . "packages.txt";
			$header = "child|parent|parent.type|parent.version";
			writeLine($header, $this->packageFile, FALSE);
			
			
			$this->summaryFile = $this->summaryPath . "summary.txt";
			$header = "package|current.version|current.date|n.versions|first.date|last.date|first.size|last.size|compile|n.compile.checks|n.compile.checks.ok|n.compile.checks.note|n.compile.checks.warn|n.compile.checks.error|n.compile.checks.other| n.depends|n.depends.version|n.imports|n.imports.version|n.suggests|n.suggests.version|n.enhances|n.enhances.version|n.system.requires|n.system.requires.version|system.requires.strlen|n.licenses|n.licenses.GPL|n.licenses.MIT|first.author|first.maintainer|title|desc";
			writeLine($header, $this->summaryFile, FALSE);
			}
			
			# $header = "package|n.authors|n.extra";  # n.authors is total with maintainers, n.extra are these idiot () extra elements
			
		#$this->authorCount = array();
		#$packageInfo = array();
		
		echo"<PRE>";
		
		foreach($myList as $details)
			{
			$package = $details["name"]; # with shuffle()
			# $package = "Rmpfr";  # "ggOceanMaps";   # "ggenealogy";  ggOceanMaps
			# $package = "casebase";
			# $package = "quantreg";
			if($l != "myList") # test run
				{
				$package = $l;
				}
			
			$per = myPercent(100*$i/$total, 3, 2);
			echo" [ $per % ] ... $i of $total :: $package \n\n"; flush();
			
				$badOnes = array("mfbvar");
			# if($i > 10400) # skip these
				{
				if(!in_array($package, $badOnes))
					{
					$info = $this->getOne($package,$details);
					$authors = $this->parseAuthors($info["index"]["summary"]["Author"], $info["index"]["summary"]["Maintainer"]);
					
					
					
					if($l != "myList") # test run
						{
						echo"<PRE>";print_r($authors);   exit;
						}
						
					$this->writeAuthorInfo($authors, $info);
					
					$this->summarizeOnePackage($info, $authors);
					
					# $this->updateAuthors($authors);
						
					#echo"<PRE>"; print_r($this->authorCount);exit;
					}
				}
				
				
			$i++;
			}
			
		#echo"<PRE>";
		#arsort($this->authorCount);
		#print_r($this->authorCount);exit;	

		
		}			
	
	function isCPH($roles)
		{
		foreach($roles as $role)
			{
			if($role == "cph") { return TRUE; }
			}
		return FALSE;
		}
	function writeAuthorInfo($authors, $info)
		{		
		$totalRoles = $totalExtra = $totalExtra2 = $nAuthors = 0;
		
		foreach($authors as $author=>$ainfo)
			{
			$nAuthors++;
			if(isset($ainfo["parenthesis"])) { $totalExtra = $ainfo["parenthesis"]; }
			if(isset($ainfo["parenthesis-length"])) { $totalExtra2 = $ainfo["parenthesis-length"]; }
			if(isset($ainfo["author"]))
				{
				$totalRoles += count($ainfo["author"]["roles"]);
				}
			if(isset($ainfo["maintain"]))
				{
				$totalRoles += count($ainfo["maintain"]["roles"]);	
				}
			}
		
		# echo"\n totalExtra :: $totalExtra ... nAuthors :: $nAuthors ... totalRoles :: $totalRoles \n";
		
		
		foreach($authors as $author=>$ainfo)
			{
			$rankA = $rankM = "NA";	$nRoles = 0;
			$cph = 0;
			
			if(isset($ainfo["author"]))
				{
				$nRoles += count($ainfo["author"]["roles"]);	
				$rankA = $ainfo["author"]["rank"];
				if($this->isCPH($ainfo["author"]["roles"])) { $cph=1; }
				}
			if(isset($ainfo["maintain"]))
				{
				$nRoles += count($ainfo["maintain"]["roles"]);	
				$rankM = $ainfo["maintain"]["rank"];
				}
				

				
			$line = $this->currentPackage . "|" . $author . "|" . $rankA . "|" . $rankM . "|" . $nRoles . "|" . $nAuthors . "|" . $totalRoles . "|" . $totalExtra .  "|" . $totalExtra2 ."|" . $cph; 	
			writeLine($line, $this->authorFile, TRUE);	
			}
		
		
		#echo"<PRE>"; print_r($authors); print_r($info); exit;
		
		
		#$header = "package|author|rank.a|rank.m|n.roles|total.authors|total.roles|total.extra";
			#writeLine($header, $this->authorFile, TRUE);
			
			
		}
		
	function summarizeOnePackage($info, $authors)
		{
		echo"<PRE>"; # print_r($info); print_r($authors);  # print_r($this); 
		
		
		$line = $this->currentPackage;
		
		$currentDate = $info["index"]["summary"]["Published"];
		$currentVersion = $info["index"]["summary"]["Version"];
		
		$line .= "|" . $currentVersion;
		$line .= "|" . $currentDate;		
				
		$nVersions = count($info["history"]);
		
		$firstSize = $lastSize = "NA";
		$firstDate = $lastDate = "NA";
		if($nVersions > 0)
			{
			$firstDate = $info["history"][0]["date"];
			$firstSize = $info["history"][0]["sizeMB"];
			
			$lastDate = $info["history"][($nVersions-1)]["date"];
			$lastSize = $info["history"][($nVersions-1)]["sizeMB"];
			}

		$line .= "|" . $nVersions;	
		$line .= "|" . $firstDate;	
		$line .= "|" . $lastDate;	
		$line .= "|" . $firstSize;	
		$line .= "|" . $lastSize;	
		
		$nCompile = 0;
		$cStr = strtoupper($info["index"]["summary"]["NeedsCompilation"]);
		if($cStr == "YES") { $nCompile = 1; }
		
		$line .= "|" . $nCompile;		
		
		$checks = array("OK", "NOTE", "WARN", "ERROR");
		
		$counts = array();			
		foreach($checks as $status)
			{
			$counts[$status] = 0;
			}
		$counts["OTHER"] = 0;
		$tcount = 0;
		
		foreach($info["check"] as $check)
			{
			$tcount++;
			$status = $check["status"];
			if(in_array($status, $checks))
				{
				$counts[$status]++;
				} else {
						$counts["OTHER"]++;
						}			
			}

		$line .= "|" . $tcount;
		
		foreach($counts as $mcount)
			{
			$line .= "|" . $mcount;
			}
		
		
		

## Dependency Network 
		
		$keys = array("Depends", "Imports", "Suggests", "Enhances", "SystemRequirements");
		$sysComplex = 0;
		
		foreach($keys as $key)
			{
			$nCount = $vCount = 0;
			if(isset($info["index"]["summary"][$key]))
				{
				$ninfo =	trim($info["index"]["summary"][$key]);
				if($key=="SystemRequirements")
					{
					$sysComplex = strlen($ninfo);
					}
						
require(PHP_INCLUDE . "projects/CRAN/includes/require.system.cleanup.php");
				 
				$narr = explode(",", $ninfo);
				foreach($narr as $nline)
					{
					$nline = trim($nline);
					$nline = rtrim($nline, ".");
					if(!empty($nline))
						{
						$nCount++;
						$pkgversion = "NA";
						preg_match_all('/\((.*?)\)/', $nline, $matches);
						$nmatches = count($matches[0]);
						
						if( $nmatches > 0)
							{
								# echo"\n\n"; print_r($matches); echo"\n\n"; 
							$pkg = trim( str_replace($matches[0][0], "", $nline) );
								$replaces = array("(",")",">","=", "&le;", "&le;");
							$pkgversion = trim( str_replace($replaces, "", $matches[0][0]) );
							$vCount++;
							} else {
									$pkg = trim($nline);
									}
						$pkline = $this->currentPackage . "|" . $pkg . "|" . $key . "|" . $pkgversion;
						writeLine($pkline, $this->packageFile, TRUE);	
						}						
					}
				
				$line .= "|" . $nCount;
				$line .= "|" . $vCount;				
				}
			
			
			}
			
		$line .= "|" . $sysComplex;
		
		####### LICENSES #######	
		$tmp = explode("|", $info["index"]["summary"]["License"]);
		$nLicenses = $nGPL = $nMIT = 0;
		foreach($tmp as $license)
			{
			$license = trim($license);
			if(!empty($license))
				{
				$nLicenses++;
				if(is_substring("GPL", strtoupper($license)))
					{
					$nGPL++;
					}
				if(is_substring("MIT", strtoupper($license)))
					{
					$nMIT++;
					}
				}
			}
			
				
		
		$name = $this->currentPackage;
		$title = $info["details"]["description"];
		
		$desc = removeWhiteSpace($info["index"]["description"]);
		$desc = str_replace("\r\n", " ", $desc);
		$desc = str_replace("\n", " ", $desc);
		
		
		$firstAuthor = $firstMaintainer = "NA";
		foreach($authors as $author=>$ainfo)
			{
			if(isset($ainfo["author"]))
				{
				if($ainfo["author"]["rank"] == 1) { $firstAuthor = $author; break; }
				}
			}
		if($firstAuthor == "NA") { print_r($authors); exit; }	
			
			
		foreach($authors as $author=>$ainfo)
			{
			if(isset($ainfo["maintain"]))
				{
				if($ainfo["maintain"]["rank"] == 1) { $firstMaintainer = $author; break; }
				}
			}

		
		$line .= "|" . $nLicenses;
		$line .= "|" . $nGPL;
		$line .= "|" . $nMIT;
		$line .= "|" . $firstAuthor;
		$line .= "|" . $firstMaintainer;
		$line .= "|" . $title;
		$line .= "|" . $desc;
		
		# bipartite|Carsten F. Dormann|NA|1|1|14|1|0
		
		
		writeLine($line, $this->summaryFile, TRUE);	
		# exit;
		}
		
		
	function summarizeSVN()
		{
			/*
			------------------------------------------------------------------------
r79996 | kalibera | 2021-02-12 04:27:23 -0800 (Fri, 12 Feb 2021) | 4 lines

Fix usage help for Rterm: it does not support <,> redirection arguments,
those are implemented by the shell.  Related to 77926, before which
redirection arguments were interpreted by a shell used internally in R.exe.
*/
		$this->summaryPath = PHP_DATA . "CRAN".DIRECTORY_SEPARATOR."summary".DIRECTORY_SEPARATOR;
				checkFolderRecursive($this->summaryPath);
		
			# is this not doing the "piped" thing???
			$this->svnFile = $this->summaryPath . "svn.txt";
			$header = "svn.id|username|date|lines.edited|description";
			writeLine($header, $this->svnFile, FALSE);
			
		$file = "C:\_git_\svn\CRAN.svn.log";
		$lines = explode("------------------------------------------------------------------------", trim(file_get_contents($file)));
		
		#echo"<PRE>"; print_r($lines); exit;
		$nlines = count($lines);
		echo"<PRE>";  # 56283 
		
		foreach($lines as $k=>$line)
			{
			$per = myPercent(100*$k/$nlines, 3, 2);
			echo" [ $per % ] ... $k of $nlines \n\n"; flush();
			
			if($k > 0)
				{
				$tmp = explode("\n", trim($line));
					$info = explode("|", $tmp[0]);
						$id = trim($info[0]);
						$user = trim($info[1]);
						$d = trim($info[2]);
							$dt = explode(" ",$d);
							# echo"<PRE>"; print_r($dt); exit;
							$df = trim($dt[0]). " ". trim($dt[1]);
						$n = trim($info[3]);
							$n = trim(str_replace(array("lines","line"), "", $n));
						
				$desc = "";
				foreach($tmp as $j=>$tm)
					{
					if($j > 0)
						{
						$tm = trim($tm);
						if(!empty($tm)) { $desc .= $tm . " [n] "; }
						}
					}
				$desc = substr($desc,0,-4);
				$desc = trim($desc);
				
				# "svn.id|username|date|lines.edited|description";
				$out = $id . "|" .  $user . "|" . $df . "|" . $n . "|" . $desc;
				writeLine($out, $this->svnFile, TRUE);	
				# echo"<PRE>"; print_r($info); print_r($tmp); exit;
				
				}
			}
			
		}
		
	}


































/*
function updateAuthors($authors)
		{
		return FALSE;
		# append counts to $this->authorCount;
		if($authors != FALSE)
			{
			foreach($authors as $author=>$roles)
				{
				$count = count($roles);
				
				#echo"<PRE>";
				#print_r($authors);
				#print_r($author);
				#print_r($this->authorCount);
				#print_r($this->authorCount[$author]);
				#
				if(isset($this->authorCount[$author]))
					{
					$this->authorCount[$author] += $count;
					} else { 
							$this->authorCount[$author] = $count;		
							}
				}	
			}			
		}
*/

?>