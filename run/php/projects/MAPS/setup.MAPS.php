<?PHP

$myMAPS = new myMAPS;
	$myMAPS->dataPath = "Q:/project-MAPS/";
	$myMAPS->when = date("Y-m");
	
	# 100,000
	# https://www.davidrumsey.com/luna/servlet/detail/RUMSEY~8~1~235467~5510519
	#  12,000
	# https://jcb.lunaimaging.com/luna/servlet/view/all
	# https://jcb.lunaimaging.com/luna/servlet/detail/JCBMAPS~3~3~3593~101754:JRB001?qvq=&mi=0&trs=12816
	# https://www.davidrumsey.com/luna/servlet/view/all?sort=Pub_List_No_InitialSort%2CPub_Date%2CPub_List_No%2CSeries_No&os=50
	
	# "https://www.davidrumsey.com/luna/servlet/view/all?sort=Pub_List_No_InitialSort%2CPub_Date%2CPub_List_No%2CSeries_No&os={os}",
	
	# jid has title in "extra" ... 
	// $myMAPS->urlTemplates = array(
								// "rumsey-browse" => "https://www.davidrumsey.com/luna/servlet/view/all?os={os}",
								// "rumsey-map" => "https://www.davidrumsey.com/luna/servlet/detail/{rid}",
								
								// "jcb-browse" => "https://jcb.lunaimaging.com/luna/servlet/view/all?os={os}",
								// "jcb-map" => "https://jcb.lunaimaging.com/luna/servlet/detail/{jid}:{jextra}"
								
									// );
	
	# HOOVER INSTITUTE - RUSSIAN POSTERS SEEM TO BE IN MULTIPLE COLLECTIONS
	
	$myMAPS->sites = array(
							"rumsey" => "https://www.davidrumsey.com/", # 106,164

							"jcb" => "https://jcb.lunaimaging.com/",  # 12,816
							"cinci" => "https://digital.libraries.uc.edu/", # 24,100 (~676 indians)
							"sarah" => "http://luna.slc.edu/", # 240,680
							"stanford" => "http://stanford.lunaimaging.com/", # 9,315  (africa)
							"china" => "http://lunamap.must.edu.mo/", #5,001
							"umass" => "http://umassamherst.lunaimaging.com/", # 4,971
							"umassd" => "https://luna.umassd.edu/", # 2,254
							"wmich" => "https://luna.library.wmich.edu/", # 3,563
							"idaho" => "https://rhd.thecommunitylibrary.org/", # 2,895
							"wyoming" => "https://digitalcollections.uwyo.edu/", # 148,667
							"mon" => "https://mon.academyart.edu/", # 379,136 [ replicates of rumsey, but more 145,568 ]
							"gmu" => "http://images.gmu.edu/", # 64,795
							"kansas" => "https://luna.ku.edu/", # 6,537



							);
							
	$myMAPS->urlTemplates = array(
								"X-browse" => "luna/servlet/view/all?os={os}",
								"X-map" => "luna/servlet/detail/{mid}:{mextra}",
								);

	
	$myMAPS->currentPath = $myMAPS->dataPath . $myMAPS->when . "/";
		checkFolderRecursive($myMAPS->currentPath);



## ADD LUNA
/*
- LIST: http://www.lunaimaging.com/luna-collections
- add to setup


*/

switch($a)
	{
	default:	
		echo"<PRE>"; print_r($myMAPS); # exit;
	break;
	
	
	# php -f run.php p=MAPS a=browse l=jcb		# tt0000941
	# http://localhost/run/run.php?p=MAPS&a=browse&l=jcb
	#
	# php -f run.php p=MAPS a=browse l=rumsey
	case "browse":
		# $l = "rumsey";  $l = "jcb";
		$myMAPS->doBrowse($l);
	break;
	
	# php -f run.php p=MAPS a=parse-browse l=jcb	
	# php -f run.php p=MAPS a=parse-browse l=rumsey
	case "parse-browse":
		# $l = "rumsey";  $l = "jcb";
		$myMAPS->parseBrowse($l);
	break;
	
	# php -f run.php p=MAPS a=download-pages l=jcb	
	# php -f run.php p=MAPS a=download-pages l=rumsey
	# php -f run.php p=MAPS a=download-pages l=jcb r=false s=400
# randomize = r ... skip = lines to skip 
	case "download-pages":
		# randomize
		$r	=	true;
		if(isset($_GET["r"])){$r=$_GET["r"];}
		if(isset($_ARG["r"])){$r=$_ARG["r"];}
		if($r != "false") { $r = true; } else { $r = false; }
		# echo"\n\n $r \n\n"; exit;
		# if(($r)) { $r = true; }
		# skip
		$s	=	0;
		if(isset($_GET["s"])){$s=$_GET["s"];}
		if(isset($_ARG["s"])){$s=$_ARG["s"];}
	
		$myMAPS->downloadPages($l, $r, $s);
	break;
	
	# php -f run.php p=MAPS a=parse-pages l=jcb r=false s=0
	case "parse-pages":
		# randomize
		$r	=	true;
		if(isset($_GET["r"])){$r=$_GET["r"];}
		if(isset($_ARG["r"])){$r=$_ARG["r"];}
		if($r != "false") { $r = true; } else { $r = false; }
		# echo"\n\n $r \n\n"; exit;
		# if(($r)) { $r = true; }
		# skip
		$s	=	0;
		if(isset($_GET["s"])){$s=$_GET["s"];}
		if(isset($_ARG["s"])){$s=$_ARG["s"];}
	
		$myMAPS->parsePages($l, $r, $s);
	break;
	
	
	# php -f run.php p=MAPS a=tiles l=11623061
	case "tiles":
		$myMAPS->buildTiles();
	break;
	
	
	
		
	}


?>