<?PHP

$myCRAN = new myCRAN;
	$myCRAN->dataPath = "R:/project-CRAN/";
	$myCRAN->when = date("Y-m");
	$myCRAN->urlTemplates = array(
								"list" => "https://cran.r-project.org/web/packages/available_packages_by_date.html",
								"packageIndex" => "https://cran.r-project.org/web/packages/{myPackage}/index.html",
								"packageArchive" => "https://cran.r-project.org/src/contrib/Archive/{myPackage}/",
								"packageCheck" => "https://cran.r-project.org/web/checks/check_results_{myPackage}.html",
								"packageFunctions" => "https://www.rdocumentation.org/packages/{myPackage}/versions/{myVersion}",
								"packageFunctionInfo" => "https://www.rdocumentation.org/packages/{myPackage}/versions/{myVersion}/topics/{myFunction}"
								
									);
									# Code of Conduct B.S.
									# https://www.rdocumentation.org/packages/httr/versions/1.4.2
	# https://cran.r-project.org/web/packages/openssl/index.html
	# https://cran.r-project.org/src/contrib/Archive/openssl/
	# https://cran.r-project.org/web/checks/check_results_openssl.html
	
	$myCRAN->currentPath = $myCRAN->dataPath . $myCRAN->when . "/";
		checkFolderRecursive($myCRAN->currentPath);


switch($a)
	{
	default:
	
		echo"<PRE>"; print_r($myCRAN); exit;
	break;
	
	
	
	
	#  php -f run.php p=CRAN a=get-list
	# http://localhost/run/run.php?p=CRAN&a=get-list

	case "get-list":
		$myList = $myCRAN->getList();
		# $myCRAN->parseList();
		echo"<PRE>"; print_r($myList); exit;
	break;
	
	
	# openssl
	#  php -f run.php p=CRAN a=get-one l=openssl
	# http://localhost/run/run.php?p=CRAN&a=get-one&l=openssl
	case "get-one":
		$myPackage = $myCRAN->getOne($l); # [l]ist is the package name to find details
		echo"<PRE>"; print_r($myPackage); exit;
	break;
	
	case "get-all":
		$myList = $myCRAN->getList();
			 shuffle($myList);  # parameter ... 
		$i = 1; $total = count($myList); 
		
		foreach($myList as $package=>$details)
			{
				# echo"<PRE>";print_r($details);exit;
			$package = $details["name"]; # with shuffle()
			# $package = "dplyr";
			$per = myPercent(100*$i/$total, 3, 2);
			echo" [ $per % ] ... $i of $total :: $package \n\n"; flush();
			$myCRAN->getOne($package,$details);
			$i++;
			}
	break;
		
	}


?>