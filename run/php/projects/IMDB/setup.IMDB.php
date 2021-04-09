<?PHP

$myIMDB = new myIMDB;
	$myIMDB->dataPath = "R:/project-IMDB/";
	$myIMDB->when = date("Y-m");
	$myIMDB->urlTemplates = array(
	# https://www.imdb.com/search/title/?title_type=feature&year=1973-01-01,1973-12-31&start=51&ref_=adv_nxt
								"movie-list-by-year" => "https://www.imdb.com/search/title/?title_type=feature&year={date-start},{date-stop}&start={start}&sort={sort}",
								
								"movie-info" => "https://www.imdb.com/title/{ttid}/",
								"movie-crew" => "https://www.imdb.com/title/{ttid}/fullcredits",
								"movie-companies" => "https://www.imdb.com/title/{ttid}/companycredits",
								
								
								"movie-boxoffice" => "https://www.boxofficemojo.com/title/{ttid}/",
								
								"movie-boxoffice-release" => "https://www.boxofficemojo.com/release/{rlid}/weekend/",
								
								## for top actors across lots of movies
								"actor-info" => "https://www.imdb.com/name/{nmid}/",
								
								"actor-bio" => "https://www.imdb.com/name/{nmid}/bio"
								
									);

	
	$myIMDB->currentPath = $myIMDB->dataPath . $myIMDB->when . "/";
		checkFolderRecursive($myIMDB->currentPath);


switch($a)
	{
	default:
	
		echo"<PRE>"; print_r($myIMDB); # exit;
	break;
	
	
	#  384861 x 4 pages ...
	#  12 instances running ... 735 - 547 = 188 (x 4) pages per minute
	# 384861/188 = 2047.133 minutes
	# 34 hours for 1.54 million pages (assuming we don't get flagged)
	# 384,861 folders in one place would break Windows some time ago.  Not anymore.
	# 1GB = 1000 folders ... 384 GB
	
	# php -f run.php p=IMDB a=download-all-movies-random
	case "download-all-movies-random":
		# more RAM
		$start = 1874;
		$end   = 2020;
			$json = $myIMDB->currentPath."movies-list_".$start."-".$end.".json";
		$list = getJSON($json);	
			$shuffleme = TRUE;
		if($shuffleme) { shuffle($list); }
		$i = 1; $total = count($list);
		foreach($list as $ttid)
				{
				echo"\n\n $ttid [ $i of $total ] ... ".myPercent(100*$i/$total,3,5)." \n\n"; flush();	
				$myIMDB->downloadMovieInfo($ttid);
				$i++;
				}
		
	break;
	
	# php -f run.php p=IMDB a=download-all-movies
	case "download-all-movies":
		$mysleep = 0;
		$shuffleme = FALSE;
		
		# $start = 1874;
		$start = 2015;
		# $start = 2018;
		$end   = 2020;
			
		$years = fillArray($start,$end);
			  if($shuffleme) { shuffle($years); }
			  
		foreach($years as $year)
			{
			$movies = $myIMDB->getMovieListForYear($year);	
			$list = $movies["list"];
			if($shuffleme) { shuffle($list); }
			foreach($list as $ttid)
				{
				echo"\n\n $ttid from $year ... \n\n"; flush();	
				$myIMDB->downloadMovieInfo($ttid);
				}
			}
			
			 
	break;
	
	case "parse-one-movie":
	
	break;
	
	# php -f run.php p=IMDB a=download-one-movie l=tt0052618		# tt0000941
	# http://localhost/run/run.php?p=IMDB&a=download-one-movie&l=tt0000941
	#
	case "download-one-movie":
		$ttid = $l;
		$myIMDB->downloadMovieInfo($ttid);
	
	break;
	
	# php -f run.php p=IMDB a=get-movies-list-all
	case "get-movies-list-all":
		$mysleep = 0;
		$shuffleme = FALSE;
		
		$start = 1874;
		$end   = 2020;
			$json = $myIMDB->currentPath."movies-list_".$start."-".$end.".json";
			if(file_exists($json))
				{
				return getJSON($json);	
				}
			
		$years = fillArray($start,$end);
			  if($shuffleme) { shuffle($years); }
		
		$all = array();
		foreach($years as $year)
			{
			echo"\n\n #########  YEAR [ $year ] ############ \n\n";
				sleep($mysleep);
			$movies = $myIMDB->getMovieListForYear($year);
			$all = array_merge($all, $movies["list"]);
			}
# https://stackoverflow.com/questions/3654295/remove-empty-array-elements
			$all = array_filter($all, 'strlen');
		storeJSON($json, $all);	
		echo"\n\n $start -- $end \n\n";
		echo"<PRE>";print_r($years); print_r($myIMDB);
		
	break;
	
	# php -f run.php p=IMDB a=movies-year y=1985
	# http://localhost/run/run.php?p=IMDB&a=movies-year&y=1995
	case "get-movie-list-for-year":
	case "movies-year":
		# y is the year 
		echo"<PRE>";
		$movies = $myIMDB->getMovieListForYear($y);
		
		print_r($movies["list"]);
		
		#echo"hi nic $y";
		
	
	break;
	
	
	#  php -f run.php p=CRAN a=get-list
	# http://localhost/run/run.php?p=CRAN&a=get-list
/*
	case "get-list":
		$myList = $myIMDB->getList();
		# $myIMDB->parseList();
		echo"<PRE>"; print_r($myList); exit;
	break;
*/	
	
		
	}


?>