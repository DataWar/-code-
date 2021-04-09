<?PHP

class myBLB
	{		
	var $debug = false;

	function myBLB()  # this is constructor , php 8?
		{
		

		}
		
	# do KJV with "strongs" checked ... python
	
	function getVerseInfo()
		{
		$open = "false";
		 $open = "true"; 
		
		
		
			echo"MONTE"; 
		$bible = "kjv";
		$biblepath = 	$this->currentPath . "bible-chapter/". $bible . "/"; checkFolderRecursive($biblepath);
		
		$bibleinfo = str_replace( $bible."/",  $bible . ".json", $biblepath); # summary of chapters and verses ...
		
		echo"\n\n -- $bibleinfo -- \n\n";
		# exit;
		
		if(!file_exists($bibleinfo)) { $this->getChapters("kjv"); }
		
		$binfo = getJSON($bibleinfo);	
		
		# print_r($binfo); exit;
		
		
		
		# gen ... s_1001
		# exo ... s_51001
		# lev ... s_91001
		# num ... s_118001
		# deu ... s_154001
		# jos ... s_188001
		# jdg ... s_212001
		# rth ... s_233001
		# 1sa ... s_237001
		# 2sa ... s_268001
		# 1ki ... s_292001
		# 1ki ... s_314001
		# 1ch ... s_339001
		# 2ch ... s_368001
		# ezr ... s_404001
		# neh ... s_414001
		# est ... s_427001
		# job ... s_437001
		# psa ... s_479001
		# pro ... s_629001
		# ecc ... s_660001
		# sng ... s_672001
		# isa ... s_680001
		# jer ... s_746001
		# lam ... s_798001
		# eze ... s_803001
		# dan ... s_851001
		# hos ... s_863001
		# joe ... s_877001
		# amo ... s_880001
		# oba ... s_889001
		# jon ... s_890001
		# mic ... s_894001
		# nah ... s_901001
		# hab ... s_904001
		# zep ... s_907001
		# hag ... s_910001
		# zec ... s_912001
		# mal ... s_926001
		
		# mat ... s_930001
		# mar ... s_958001
		# luk ... s_974001
		# jhn ... s_998001
		# act ... s_1019001
		# rom ... s_1047001
		# 1co ... s_1063001
		# 2co ... s_1079001
		# gal ... s_1092001
		# eph ... s_1098001
		# phl ... s_1104001
		# col ... s_1108001
		# 1th ... s_1112001
		# 2th ... s_1117001
		# 1ti ... s_1120001
		# 2ti ... s_1126001
		# tit ... s_1130001
		# phm ... s_1133001
		# heb ... s_1134001
		# jas ... s_1147001
		# 1pe ... s_1152001
		# 2pe ... s_1157001
		# 1jo ... s_1160001
		# 2jo ... s_1165001
		# 3jo ... s_1166001
		# jde ... s_1167001
		# rev ... s_1168001
		
		
		$books = array(
						"gen" => "1001",
						"exo" => "51001",
						"lev" => "91001",
						"num" => "118001",
						"deu" => "154001",
						"jos" => "188001",
						"jdg" => "212001",
						"rth" => "233001",
						"1sa" => "237001",
						"2sa" => "268001",
						"1ki" => "292001",
						"1ki" => "314001",
						"1ch" => "339001",
						"2ch" => "368001",
						"ezr" => "404001",
						"neh" => "414001",
						"est" => "427001",
						"job" => "437001",
						"psa" => "479001",
						"pro" => "629001",
						"ecc" => "660001",
						"sng" => "672001",
						"isa" => "680001",
						"jer" => "746001",
						"lam" => "798001",
						"eze" => "803001",
						"dan" => "851001",
						"hos" => "863001",
						"joe" => "877001",
						"amo" => "880001",
						"oba" => "889001",
						"jon" => "890001",
						"mic" => "894001",
						"nah" => "901001",
						"hab" => "904001",
						"zep" => "907001",
						"hag" => "910001",
						"zec" => "912001",
						"mal" => "926001",
						
						"mat" => "930001",
						"mar" => "958001",
						"luk" => "974001",
						"jhn" => "998001",
						"act" => "1019001",
						"rom" => "1047001",
						"1co" => "1063001",
						"2co" => "1079001",
						"gal" => "1092001",
						"eph" => "1098001",
						"phl" => "1104001",
						"col" => "1108001",
						"1th" => "1112001",
						"2th" => "1117001",
						"1ti" => "1120001",
						"2ti" => "1126001",
						"tit" => "1130001",
						"phm" => "1133001",
						"heb" => "1134001",
						"jas" => "1147001",
						"1pe" => "1152001",
						"2pe" => "1157001",
						"1jo" => "1160001",
						"2jo" => "1165001",
						"3jo" => "1166001",
						"jde" => "1167001",
						"rev" => "1168001",
						);
		
		$keys = array(
					"cross-ref" 	=> "t_corr",
					"commentaries" 	=> "t_comms",
					"dictionaries" 	=> "t_refs",
					"misc" 			=> "t_misc",
					"reverse"		=> "t_conc",
					"llx"			=> "t_concl",
					"t_concf"		=> "t_concf"  # also do with python ... check cantilation, vowel points ... 0-1, 1-1, 0-0 
					);
					
		#print_r($binfo);exit;					
			shuffle($binfo);
		#print_r($binfo);exit;		
		# $this->currentPath . "bible-chapter/". $bible . "/"; checkFolderRecursive($biblepath);
		
		
				
		$nchaps = sizeof($binfo);		
		
$cmds = "";		
		$nn = 0;
		foreach($binfo as $mychapter)
			{
			$nn++;
			
			
			
			# $pstr = '';
			
			# $mychapter = "kjv-23-isa-30-33";
			# $mychapter = "kjv-23-isa-4-6";
			# $mychapter = "kjv-23-isa-6-13";
			
			$cinfo = explode("-", $mychapter);
			
			
			
			# exit;
			$bnum = (int) trim($cinfo[1]);
			$new = ($bnum >= 40) ? "true" : "false"; # new testament ?
			
			echo"\n\n -- [ $nn of $nchaps ] .... $mychapter  .... [ $bnum => $new ] -- \n\n"; 
				# sleep(2);
			
				$b = trim($cinfo[2]);
				$c = trim($cinfo[3]);
				$C = str_pad($c,3,"0",STR_PAD_LEFT);
				
				$versecount = trim($cinfo[4]);
				
				$start = str_replace("001", "", $books[$b]);
				$starts = ($c - 1) + (int) $start;
				
				echo"\n\n -- $b -- \n\n";
				echo"\n\n -- $C -- \n\n";
				echo"\n\n -- $start -- \n\n";
				echo"\n\n -- $starts -- \n\n";
				
				
				$chapterpath = $this->currentPath . "bible-verse/" . $b . "/". $c . "/";
				$page_is_complete = $chapterpath . "is.complete";
				if(file_exists($page_is_complete)) { continue; }
				
				
				for($v = 1; $v<=$versecount; $v++)
					{			
					$V = str_pad($v,3,"0",STR_PAD_LEFT);	
					# $versepath = $this->currentPath . "bible-verse/" . $b . "/". $C . "/". $V . "/"; checkFolderRecursive($versepath);	
						
					$versepath = $this->currentPath . "bible-verse/" . $b . "/". $c . "/". $v . "/"; 
					
					
########checkFolderRecursive($versepath);		
					
					
					}
					
					
				$localpath = $chapterpath;
# exit;
				
				$stem = $this->urlTemplates["bible-chapter"];
						$stem = str_replace("{bible}", $bible, $stem);
						$stem = str_replace("{b}", $b, $stem);
						$stem = str_replace("{c}", $c, $stem);
				$remote = $stem;
		
		
				$cmd = "C:/python3/python.exe C:/_git_/__NIC__/run/php/projects/BLB/get.tools.py --remote={remote} --local={local} --sleep=250 --open={open} --new={new}";

				$cmd = str_replace("{remote}", $remote, $cmd);
				$cmd = str_replace("{local}",  $localpath,  $cmd);
				$cmd = str_replace("{open}",  $open,  $cmd);
				$cmd = str_replace("{new}",  $new,  $cmd);
				
				echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 	
				
				
				
$cmds .= $cmd . "\n\n";	
				#$info = passthru($cmd . " 2>&1", $info) ;
				#echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
				#exit;
				
					
			#exit;
			}
		
		
		#exit;
		
		
		## RUNS from CMD line but not from python bash with PHP CLI ...	
		## rumsey broke the driver???
		$todo = $this->currentPath . "bible-verse/" . "todo-".md5(microtime()).".txt";
		$todo = $this->currentPath . "bible-verse/" . "todo-".rand(1,10).".txt";
		
		# $todo = $this->currentPath . "bible-verse/" . "todo-10.txt";
		
		
		$todo = $this->currentPath . "bible-verse/" . "todo-".md5(microtime())."";
		$todo = $this->currentPath . "bible-verse/" . "todo-".rand(1,10)."";
		
		# $todo = $this->currentPath . "bible-verse/" . "todo-10";
		# print($cmds);
		echo"\n\n $todo \n\n";
		storeFile($todo, $cmds);
		# S:
		# cd S:\project-BLB\2021-04\bible-verse
		# cmd < todo-6.txt
		# cmd < todo-6
		
		exit;
		
		
		$j = 0;
		foreach($binfo as $mychapter)
			{
			$cinfo = explode("-", $mychapter);
				$b = trim($cinfo[2]);
				$c = trim($cinfo[3]);
				$C = str_pad($c,3,"0",STR_PAD_LEFT);
				
				$versecount = trim($cinfo[4]);
				
				$start = str_replace("001", "", $books[$b]);
				$starts = ($c - 1) + (int) $start;
				
				echo"\n\n -- $b -- \n\n";
				echo"\n\n -- $C -- \n\n";
				echo"\n\n -- $start -- \n\n";
				echo"\n\n -- $starts -- \n\n";
				
				
				
				for($v = 1; $v<=$versecount; $v++)
					{			
					$V = str_pad($v,3,"0",STR_PAD_LEFT);	
					$versepath = $this->currentPath . "bible-verse/" . $b . "/". $C . "/". $V . "/"; checkFolderRecursive($versepath);
					
					$stem = $this->urlTemplates["bible-extra"];
						$stem = str_replace("{bible}", $bible, $stem);
						$stem = str_replace("{b}", $b, $stem);
						$stem = str_replace("{c}", $c, $stem);
						$stem = str_replace("{v}", $v, $stem);
						$stem = str_replace("{s}", $starts, $stem);
						$stem = str_replace("{vvv}", $V, $stem);
						
					foreach($keys as $what=>$key)
						{
						$remote = str_replace("{key}", $key, $stem);
						$local = $versepath . $what . ".html";
						
						if(!file_exists($local))
							{
								echo"\n\n -- $v -- $key -- $what  \n\n";
							$content = getRemoteAndCache($remote, $local, true);
			
							if(empty(trim($content))) 
								{ 
								unlink($local); 
								doSleep(13, true);
								$content = getRemoteAndCache($remote, $local, true);
								}
							$j++;
							if($j > 45) { doSleep(13, true); $j = 0; }  # seems to stall, so let's pause ... ... 
			
							}
						}
					
					
					echo"\n\n -- $stem -- \n\n";
					
					}
					
					
			print_r($cinfo);exit;
			}
			
		# https://www.blueletterbible.org/kjv/psa/131/1/t_conc_609001	
		# #https://www.blueletterbible.org/kjv/psa/132/1/t_conc_610011
		/*
		# get everything I can for a verse ... cache everything 
		# interlinear do as python ... turn on marks for cantilation/vowel for INTERLINEAR TAB
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_concf_2002
		
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_concr_2002
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_concl_2002
		
		# cross-reff
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_corr_2002
		
		# commentaries
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_comms_2002
		
		# dictionaries
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_refs_2002
		
		# misc
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_misc_2002
		# https://www.blueletterbible.org/Comm/guzik_david/StudyGuide2017-Jer/Jer-31.cfm
		# https://www.blueletterbible.org/assets/images/bibleMedia/eschatalogical/c08.jpg
		# <div onclick="location.href='/images/eschatalogical/imageDisplay/c08_b'" title="'Rightly Dividing the Word of Truth'" style="background-image:url('/assets/images/bibleMedia/eschatalogical/c08_b.jpg');" id="yui-gen31">&nbsp;</div>
		# https://www.blueletterbible.org/nkjv/gen/2/1/t_misc_2002
		# MUSIC: https://www.blueletterbible.org/hymns/H/Hail_Sacred_Day_Of_Earthly_Rest.cfm
		#  Multiple MIDIs
		# use KJV ?
		$myBLB->getVerseInfo();
		*/
		
		}
	function getChapters($w = "KJV")
		{
		$ctemplate = $this->urlTemplates["bible-chapter"];
			$bible = strtolower($w);
			
		echo"\n\n ---   $bible   --- \n\n";
		# let's spider dumbly starting with 
			$current_book = "gen";
			# $notGenesis = false;
			$current_chap = 1;
			
		$biblepath = 	$this->currentPath . "bible-chapter/". $bible . "/"; checkFolderRecursive($biblepath);
		
		$bibleinfo = str_replace( $bible."/",  $bible . ".json", $biblepath); # summary of chapters and verses ...
		
		if(!file_exists($bibleinfo))
		{
		$binfo = array();
		
		$bn = 1;
		$B = str_pad($bn,2,"0",STR_PAD_LEFT);		
		$bookpath = $biblepath . $B."-".$current_book . "/"; checkFolderRecursive($bookpath);
		# $binfo["by-book"][$current_book] = 0;
		
		
		# revelation loops back to genesis
		$i = 0;
		$j = 0;
		#while($current_book == "gen" && !$notGenesis)
		while(TRUE)
			{
			$i++;
			
			# if($current_book != "gen") { $notGenesis = true; }
			
			# "bible-chapter" => "https://www.blueletterbible.org/{bible}/{b}/{c}/1",
			$remote = $ctemplate;
			$remote = str_replace("{bible}", $bible, $remote);
			$remote = str_replace("{b}", $current_book, $remote);
			$remote = str_replace("{c}", $current_chap, $remote);
			
			echo"\n\n ---   [ $i ]  $bible  $current_book $current_chap --- \n\n";
			
			
			
			$C = str_pad($current_chap,3,"0",STR_PAD_LEFT);
			
			$local = $bookpath . $C . ".html";
			
					# echo"\n\n '".$local."' \n\n";
					# echo"\n\n '".$remote."' \n\n";
					
			if(!file_exists($local)) { $j++; }
			
			
			
			$content = getRemoteAndCache($remote, $local, true);
			
			if(empty(trim($content))) 
				{ 
				unlink($local); 
				doSleep(13, true);
				$content = getRemoteAndCache($remote, $local, true);
				}
			
			$info = sliceDice($content, $start = '<div id="contextBarT" class="show-for-large">', $end = '<div class="hidden" id="copyOptions">', $strip=false, $direction="start");
			
			$keys = sliceDiceArray($info, $start='href="', $end = '"', $strip = false, $direction="start"); 
			
			$next = explode("/",$keys[2]);
				$next_book = trim($next[2]);
				$next_chap = trim($next[3]);
				
				
			$verse_count = 0;
			$verses = sliceDiceArray($content, $start='<div id="verse_', $end = '"', $strip = false, $direction="start"); 
			$verse_count = sizeof($verses);
			
			# print_r($verses);exit;
			
			
			
			$binfo[$i] = $bible."-".$B."-".$current_book."-".$current_chap."-".$verse_count;
			
			echo"\n\n ---   $bible  $next_book $next_chap --- \n\n";
			
			#print($info);
			
			if($next_book != $current_book)
				{
				$bn++;
				$B = str_pad($bn,2,"0",STR_PAD_LEFT);	
				if($current_book != "rev")
					{
					$bookpath = $biblepath . $B."-".$next_book . "/"; checkFolderRecursive($bookpath);
					}
				#$bookpath = $biblepath . $next_book . "/"; checkFolderRecursive($bookpath);	
				echo"\n\n -- $bookpath -- \n\n";
				
				# $binfo[$current_book] = $current_chap;
				# $binfo["by-book"][$next_book] = 0;
				}
			
			# if($current_book == "rth" && $current_chapter == 4) { exit; }
			
			$current_book = $next_book;
			$current_chap = $next_chap;
			
			echo"\n\n ---   [ j: $j ] $bible  $current_book $current_chap --- \n\n";
			
			
			# print_r($next);
			# exit;
			
			if($j > 45) { doSleep(13, true); $j = 0; }  # seems to stall, so let's pause ... ... 
			
			if($i > 100 && $current_book == "gen") { break; }
			
			
			if($i > 3000) { break; }
			}
			
		# print_r($binfo); exit;
		storeJSON($bibleinfo, $binfo);
		}
		
		return getJSON($bibleinfo);		
		}
		
	function grabMP3($localpath, $content)
		{
		
		# mp3 if exists ?	
		# lexPronunc
# <div id="lexPronunc" data-pronunc="BA4BC936634F8B96EACD2BAB19093EF729C96BDE619B85D5DE79CB1C35C07E95B32332529F29E93D2869EDA61A23B204F8D14843783306"><img class="show-for-medium parse-speaker" id="pronunciationSpeaker" src="/assets/images/audio/speaker3_a.svg" width="31" height="25" /><span class="hide-for-medium">Listen</span></div>
# https://www.blueletterbible.org/lang/lexicon/lexPronouncePlayer.cfm?skin=BA4BC936634F8B96EACD2BAB19093EF729C96BDE619B85D5DE79CB1C35C07E95B32332529F29E93D2869EDA61A23B204F8D14843783306
# SAVE AS MP3

		$minfo = sliceDice($content, $start='data-pronunc="', $end='">', $strip=false, $direction="start");
			
		# echo($content);
		# print_r($minfo);exit;
		
		$mpurl = "https://www.blueletterbible.org/lang/lexicon/lexPronouncePlayer.cfm?skin=".$minfo;
		
		$mp3 = $localpath . "voice.mp3";
		
		if(!file_exists($mp3))
			{
				echo"\n\n -- $mpurl \n\n";
				echo"\n\n -- $mp3 \n\n";
				
			getRemoteAndCache($mpurl, $mp3);
			}
		}
	
	function doStrongs($which="greek")
		{
		$this->strongsPath = $this->currentPath . "strongs/";  checkFolderRecursive($this->strongsPath);
			$greek = $this->strongsPath . "greek/"; checkFolderRecursive($greek);		
			$gtemplate = $this->urlTemplates["strongs-greek"];
			
			$hebrew = $this->strongsPath . "hebrew/"; checkFolderRecursive($hebrew);		
			$htemplate = $this->urlTemplates["strongs-hebrew"];
		
		if($which == "greek")
		{
		### PLAIN GREEK
		
		
		$glist = array();
		for($g=1; $g<=5624; $g++)
			{
			$glist[] = $g;
			}
			
			# echo"\n\n"; print_r($glist); echo"\n\n"; 
		 shuffle($glist);
			# echo"\n\n"; print_r($glist); echo"\n\n"; 
			
		$i = 0;
		foreach($glist as $g)
			{
			$i++;
			$G = str_pad($g,4,"0",STR_PAD_LEFT);
			$localpath  = $greek . $G . "/"; checkFolderRecursive($localpath);
			
			echo"\n\n -- $g -- $G -- [$i of 5624] \n\n";
			
			$remote = str_replace("{g}",$g, $gtemplate);
			$local  = $greek . $G . ".html";
			
			if(!file_exists($local))
				{
				getRemoteAndCache($remote, $local);
				msleep(0.33);
				}
			$mp3 = $localpath . "voice.mp3";
				if(!file_exists($mp3))
					{
					$content = getRemoteAndCache($remote, $local, true);
					$this->grabMP3($localpath, $content);
					}
			
			
			}
		}
		
		
		
		if($which == "hebrew")
		{
		### PLAIN HEBREW
		
		$hlist = array();
		for($h=1; $h<=8674; $h++)
			{
			$hlist[] = $h;
			}
			
		shuffle($hlist);
			
		$i = 0;
		foreach($hlist as $h)
			{
			$i++;
			$H = str_pad($h,4,"0",STR_PAD_LEFT);
			$localpath  = $hebrew . $H . "/"; checkFolderRecursive($localpath);
			
			echo"\n\n -- $h -- $H -- [$i of 8674] \n\n";
			
			$remote = str_replace("{h}",$h, $htemplate);
			$local  = $hebrew . $H . ".html";
			
			if(!file_exists($local))
				{
				getRemoteAndCache($remote, $local);
				msleep(0.33);
				# exit;
				}
			$mp3 = $localpath . "voice.mp3";
				if(!file_exists($mp3))
					{
					$content = getRemoteAndCache($remote, $local, true);
					$this->grabMP3($localpath, $content);
					}
			}
		}
		
		
		
		if($which == "python")
		{
		### ADVANCED HEBREW
		
		$hlist = array();
		for($h=1; $h<=8674; $h++)
			{
			$hlist[] = $h;
			}
			
		shuffle($hlist);
		
		
		$i = 0;
		
		$cmds = "";
		foreach($hlist as $h)
			{
			$i++;
			# $h = 1234;
			
			$H = str_pad($h,4,"0",STR_PAD_LEFT);
			
			echo"\n\n -- $h -- $H -- [$i of 8674] \n\n";
			
			$remote = str_replace("{h}",$h, $htemplate);
			$local  = $hebrew . $H . ".html";
			
			# $content = getRemoteAndCache($remote, $local, true);
			
			
			
			

			
			
			
			
			
			$localpath  = $hebrew . $H . "/"; checkFolderRecursive($localpath);
			
			echo"\n\n -- $localpath \n\n";
			
			# $local = $localpath . "page.html";
			$local = $localpath . "small.png";
			
			if(!file_exists($local))
				{
					echo"\n\n monte \n\n";
					
							
				
				$cmd = "C:/python3/python.exe C:/_git_/__NIC__/run/php/projects/BLB/get.strongs.py --remote={remote} --local={local} --sleep=250";

				$cmd = str_replace("{remote}", $remote, $cmd);
				$cmd = str_replace("{local}",  $localpath,  $cmd);
				
				echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 	

$cmds .= $cmd . "\n\n";				
				
				
				#$info = shell_exec($cmd . " 2>&1") ;
				#$info = shell_exec($cmd . " 2>&1") ;
				#echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
				#exit;
				}
			
			}
			
		## RUNS from CMD line but not from python bash with PHP CLI ...	
		## rumsey broke the driver???
		$todo = $this->strongsPath . "hebrew5.txt";
		print($cmds);
		echo"\n\n $todo \n\n";
		storeFile($todo, $cmds);
		# S:
		# cd S:\project-BLB\2021-04\strongs
		# cmd < hebrew.txt
		}
		
		## let's just grab hebrew pages ... and "0004.small.jpg"
		# <img id="lexImage" src="lexImage.cfm?tv=1617543476" alt="H333">
		
		## we can look for '<a id="moreTG">' and also grab "0004.python" and "0004.full.jpg"
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=H1&t=KJV
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=H8674&t=KJV
		
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=G1&t=KJV
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=G5624&t=KJV
		
		# greek doesn't need anything?
		
		# $this->strongsPath = $this->currentPath . "strongs/";  checkFolderRecursive($this->strongsPath);
		
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=H1&t=KJV
		/*
		<a id="moreTG"><span id="yui-gen38">Read the Full Entry</span></a>
		*/
		# https://www.blueletterbible.org/lang/lexicon/lexicon.cfm?Strongs=H996&t=KJV
		/*
		<a id="moreTG"><span id="yui-gen32">Read the Full Entry</span></a>
		*/
		
		echo"\n\n"; print_r($this); exit;
		}
		
	}	
?>