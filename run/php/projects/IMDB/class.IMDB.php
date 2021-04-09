<?PHP

class myIMDB
	{		
	var $debug = false;

	function myIMDB()  # this is constructor , php 8?
		{
		

		}
		
	function downloadMovieInfo($ttid)
		{
		$keys = array("movie-info", "movie-crew", "movie-companies", "movie-boxoffice");
		
		$this->ttid = $ttid;
		$this->moviePath = $this->currentPath . "movies/".$ttid."/";
			checkFolderRecursive($this->moviePath);
		
		$complete = $this->moviePath . ".complete";
		if(!file_exists($complete))
			{	
			$j=0;
			foreach($keys as $key)
				{
				$j++;
				echo" $j \t"; flush();
				$local = $this->moviePath . $key . ".html";
				if(!file_exists($local))
					{
					$remote = $this->urlTemplates[$key];
					$remote = str_replace("{ttid}", $ttid, $remote);				
					getRemoteAndCache($remote, $local);
					
					$size = round(filesize($local)/1000,1);
					
					echo" [".$size. "] ...";
					if($size == 0) { exit; }
					}
				}
				#exit;
			storeFile($complete, date("Y-m-d H:i:s"));	
			}			
		}
		
		
	function parseMovieListPage($str)
		{
		$info = array();
		###### count at top
		$tmp = sliceDice($str, '<div class="desc">', '</span>', FALSE, "start");
			$total = (int) str_replace(",","",sliceDice($tmp, 'of', 'title', TRUE, "start"));
			
		if($total == 0) { return false; }	
			
			$range = sliceDice($tmp, '<span>', 'of', TRUE, "start");
		$tmp2 = explode("-",$range);
			$start = (int) trim($tmp2[0]);
			$end = (int) trim($tmp2[1]);
			
		$info["count"] = array("total"=>$total, "range"=>$range, "start"=>$start,"end"=>$end);
		###### movies on page
		
		$tmp = sliceDice($str, '<div class="lister-list">', '<br class="clear">', FALSE, "start");
		
		# echo" $tmp ";
		
		$movies = explode('<h3', $tmp);
		
		$diff = 1+ ($end - $start);
		$diff = 50;
		$i = 0;
			foreach($movies as $line)
				{
				if($i > 0)
					{	
					$data = sliceDice($line, '<a href="/title/', '/', FALSE, "start");
					
					$info["movies"][$i] = $data;
					}
				if($i == $diff) { break; }
				$i++;	
				
				}
				
		
		
		# print_r($info); exit;
		
		# <a href="/title/tt0114369/?ref_=adv_li_tt">Se7en</a>
	
		
			
		
		#echo"<PRE>"; print_r($info); 
		#exit;
		#print_r($count);exit;
	
		return $info;
		}
	function getMovieListForYear($year)
		{
		$this->movieListPath = $this->currentPath . "movie-list/".$year."/";
			checkFolderRecursive($this->movieListPath);
			
		$this->currentYear = $year;
			
		$movies = array();
			# caching mechanism ... 
			$json = $this->movieListPath . "movies.json";
			if(file_exists($json))
				{
				return getJSON($json);	
				}
			
			
		$template = $this->urlTemplates["movie-list-by-year"];		
		#  https://www.imdb.com/search/title/?title_type=feature&year={date-start},{date-stop}&start={start}&sort={sort} 
		
		$dateStart = $year."-01-01";  # {date-start}
		$dateEnd = $year."-12-31"; # {date-stop}
		$start = 1; # increments in 50 # {start}
		$sort = ""; # no need to sort ... # {sort} 
		
		$thislist = array();
		
		$page = 1;
		$myPage = str_pad($page,3,"0",STR_PAD_LEFT);
### page loop		
		$pageOneHTML = str_replace(array("{date-start}","{date-stop}","{start}","{sort}"), array($dateStart,$dateEnd,$start,$sort), $template);		
		$pageOneFile = $this->movieListPath . "page_" . $myPage . ".html";		
			$pageOneStr = getRemoteAndCache($pageOneHTML, $pageOneFile, TRUE);
		$info = $movies[$page] =  $this->parseMovieListPage($pageOneStr);
		
		if(!$info) 
			{ 
			storeJSON($json, array("list" => array(), "details"=> array()) ); 
			return getJSON($json);
			}
		
		$thislist = array_merge($thislist, $info["movies"]);
		
		$totalmovies = $info["count"]["total"];
		$totalpages = ceil($totalmovies/50);
		
###
		for($page = 2; $page <= $totalpages; $page++)
			{
			$myPage = str_pad($page,3,"0",STR_PAD_LEFT);
			$start = 1 + (50 * ($page - 1) );
			
			echo"\n\n $myPage of $totalpages ... $start of $totalmovies \t [".$this->currentYear."] \n\n"; flush();
			
			$pageOneHTML = str_replace(array("{date-start}","{date-stop}","{start}","{sort}"), array($dateStart,$dateEnd,$start,$sort), $template);		
			$pageOneFile = $this->movieListPath . "page_" . $myPage . ".html";		
				$pageOneStr = getRemoteAndCache($pageOneHTML, $pageOneFile, TRUE);
			$info = $movies[$page] =  $this->parseMovieListPage($pageOneStr);
			
			$thislist = array_merge($thislist, $info["movies"]);
			}

		
		/*
		echo"\n $totalmovies \n";
		echo"\n $totalpages \n";
		
		echo"<PRE>"; print_r($thislist); print_r($movies);exit;
		
		echo"\n $template \n";
		echo"\n $pageOneHTML \n";
		echo"\n $pageOneFile \n";
		*/
		
		# print_r($this);								
		storeJSON($json, array("list" => $thislist, "details"=> $movies) );
		return getJSON($json);						
		}
		
	}	
?>