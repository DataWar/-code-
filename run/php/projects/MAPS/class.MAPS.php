<?PHP
# https://www.reaconverter.com/convert/jp2_to_jpg.html
# https://www.reaconverter.com/features/command-line.html  # $99

# https://imagemagick.org/script/download.php#windows
# https://legacy.imagemagick.org/discourse-server/viewtopic.php?t=22097

class myMAPS
	{		
	var $debug = false;

	function myMAPS()  # this is constructor , php 8?
		{
		

		}
	

	# function buildTiles($folder, $jp2)
	function buildTiles()
		{
		$tile = 360;
		$tileby = $tile."x".$tile;
		
		# C:\ImageMagick\-monte-\11623061
		$folder = "C:/ImageMagick/-monte-/11623061/";
		$jp2 = "11623061.jp2";
		
		$file = $folder.$jp2;
		$file2 = str_replace(".jp2", ".jpg", $file);
		
		
		if(!file_exists($file2))
			{
			echo("<PRE>"); echo"\n\n"; print_r("MAIN CONVERT"); echo"\n\n"; 
			$cmd = "convert $file $file2";
				$info = shell_exec($cmd . " 2>&1") ;
			echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 			
			}
			
		$file3 = str_replace(".jp2", ".json", $file);
		if(!file_exists($file3))
			{
			echo("<PRE>"); echo"\n\n"; print_r("-IMAGE SIZE-"); echo"\n\n"; 
			
			$cmd = "convert $file2 -format '%[w]x%[h]' info:";
				$info = shell_exec($cmd . " 2>&1") ;
				
				$info = str_replace("'", "", $info);
				
			echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
				
			$tmp = explode("x", $info);
				$res = array();
					$res["w"] = (int) $tmp[0];
					$res["h"] = (int) $tmp[1];
					
					$res["tile"] = $tile;
					$res["tileby"] = $tileby;
					
			$tw = floor( $res["w"] / $tile  );
			$th = floor( $res["h"] / $tile  );
					$res["tw"] = $tw;
					$res["th"] = $th;
			
			echo("<PRE>"); echo"\n\n"; print_r($tw); echo"\n\n"; 
			echo("<PRE>"); echo"\n\n"; print_r($th); echo"\n\n"; 

			$nw = ($tile * $tw  );
			$nh = ($tile * $th  );
					$res["nw"] = $nw;
					$res["nh"] = $nh;
			
			echo("<PRE>"); echo"\n\n"; print_r($nw); echo"\n\n"; 
			echo("<PRE>"); echo"\n\n"; print_r($nh); echo"\n\n"; 
			
			$trimw = $res["w"] - $nw;
			$trimh = $res["h"] - $nh;
					$res["trimw"] = $trimw;
					$res["trimh"] = $trimh;
			
			echo("<PRE>"); echo"\n\n"; print_r($trimw); echo"\n\n"; 
			echo("<PRE>"); echo"\n\n"; print_r($trimh); echo"\n\n"; 
			
			$ltrimw = floor($trimw / 2);
			$rtrimw = $trimw - 2*$ltrimw;
					$res["ltrimw"] = $ltrimw;
					$res["rtrimw"] = $rtrimw;
			echo("<PRE>"); echo"\n\n"; print_r($ltrimw); echo"\n\n"; 
			echo("<PRE>"); echo"\n\n"; print_r($rtrimw); echo"\n\n"; 
			
			$ltrimh = floor($trimh / 2);
			$rtrimh = $trimh - 2*$ltrimh;
					$res["ltrimh"] = $ltrimh;
					$res["rtrimh"] = $rtrimh;
			echo("<PRE>"); echo"\n\n"; print_r($ltrimh); echo"\n\n"; 
			echo("<PRE>"); echo"\n\n"; print_r($rtrimh); echo"\n\n"; 
			
			storeJSON($file3, $res );
				
			} else { $res = getJSON($file3); }
		
		echo("<PRE>"); echo"\n\n"; print_r($res); echo"\n\n"; 	
		
		extract($res);
		
		
		
		$file4 = str_replace(".jp2", "-rectangle.jpg", $file);
		if(!file_exists($file4))
			{
			echo("<PRE>"); echo"\n\n"; print_r("-IMAGE SHAVE-"); echo"\n\n"; 
			$cmd = "convert $file2 -shave ".$ltrimw."x".$ltrimh	. " -chop ".$rtrimw. "x0 -chop 0x".$rtrimh. " $file4 ";
			
			$info = shell_exec($cmd . " 2>&1") ;
			
			echo("<PRE>"); echo"\n\n"; print_r($info); echo"\n\n"; 
			}
		
		$nfolder = $folder . "web/"; checkFolderRecursive($nfolder);
		
		$rfolder = $nfolder . "raw/"; checkFolderRecursive($rfolder);
		
		# needs to be a multiple of $tile = 360
		#	$tmpw = ceil($nw / $tile / 9);			
		#$nnw = 9 * $tile * $tmpw;
		#	$tmph = ceil($nh / $tile / 9);	
		#$nnh = 9 * $tile * $tmph;
		
		$nnw = $nw;
		$nnh = $nh;
		
		# last tiles for the smaller pieces are not perfect squares ...
		# right edge is truncated ...
		
		# echo"\n\n w: $tmpw \t\t h: $tmph \n\n";
		# echo"\n\n w: $nnw \t\t h: $nnh \n\n";
		
		$file5 = $rfolder . str_replace(".jp2", ".jpg", $jp2);
		if(!file_exists($file5))
			{
			echo("<PRE>"); echo"\n\n"; print_r("-RAW ORIGINAL-"); echo"\n\n"; 
			copy($file4, $file5);
			
			// sleep(1);
			// echo("<PRE>"); echo"\n\n"; print_r("-RAW ORIGINAL-"); echo"\n\n";
			// $cmd = "set MAGICK_OCL_DEVICE=off && convert $file4 -resize " . ($nnw/1) ."x". ($nnh/1) . "! -trim +repage $file5 ";
			// $info = shell_exec($cmd . " 2>&1") ;
			
			// echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			
			sleep(1);
			$sfolder = $nfolder . "TILES-1/"; checkFolderRecursive($sfolder);
			$cmd = "cd $sfolder && convert $file5 -crop $tileby -strip -set filename:tile \"r_%[fx:page.y/".$tile."+1]-c_%[fx:page.x/".$tile."+1]\" +repage +adjoin \"".str_replace(".jp2","",$jp2)."^%[filename:tile].jpg\"";
			
			$info = shell_exec($cmd . " 2>&1") ;
			
			echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			}
			
		$file6 = str_replace(".jpg", "-3.jpg", $file5);  # medium
		# https://imagemagick.org/script/convert.php
		# https://imagemagick.org/script/command-line-options.php#resize
		# https://imagemagick.org/script/command-line-processing.php#geometry		
		if(!file_exists($file6))
			{
			sleep(1);
			echo("<PRE>"); echo"\n\n"; print_r("-RAW ORIGINAL/3-"); echo"\n\n";
			$cmd = "set MAGICK_OCL_DEVICE=off && convert $file5 -resize " . ($nnw/3) ."x". ($nnh/3) . "! -trim +repage $file6 ";
			$info = shell_exec($cmd . " 2>&1") ;
			
			echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			
			sleep(1);
			$sfolder = $nfolder . "TILES-3/"; checkFolderRecursive($sfolder);
		
			
			$cmd = "cd $sfolder && convert $file6 -crop $tileby -strip -set filename:tile \"r_%[fx:page.y/".$tile."+1]-c_%[fx:page.x/".$tile."+1]\" +repage +adjoin \"".str_replace(".jp2","",$jp2)."^%[filename:tile].jpg\"";
			
			$info = shell_exec($cmd . " 2>&1") ;
			
			echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			}
		
		
		
		
		$file7 = str_replace(".jpg", "-9.jpg", $file5);  # small		
		if(!file_exists($file7))
			{
			sleep(1);
			# https://github.com/ImageMagick/ImageMagick/discussions/3494
			echo("<PRE>"); echo"\n\n"; print_r("-RAW ORIGINAL/9-"); echo"\n\n";
			$cmd = "set MAGICK_OCL_DEVICE=off && convert $file5 -resize " . ($nnw/9) ."x". ($nnh/9) . "! -trim +repage $file7 ";
			$info = shell_exec($cmd . " 2>&1") ;
			
			echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			$sfolder = $nfolder . "TILES-9/"; checkFolderRecursive($sfolder);
		
			
			$cmd = "cd $sfolder && convert $file7 -crop $tileby -strip -set filename:tile \"r_%[fx:page.y/".$tile."+1]-c_%[fx:page.x/".$tile."+1]\" +repage +adjoin \"".str_replace(".jp2","",$jp2)."^%[filename:tile].jpg\"";
			
			$info = shell_exec($cmd . " 2>&1") ;
				
				echo("<PRE>"); echo"\n\n"; print_r($cmd); echo"\n\n"; 
			
			}
		
		
		
			
			
		
		}
	



	function parseMapPage($str, $which="rumsey")
		{
		# $str = removeWhiteSpace($str);
		$json = array();
			$json["all"] = jsonFromSlice($str, 'var allCollections = ');
			$json["context"] = jsonFromSlice($str, 'var collectionsInContext = ');
			$json["image"] = jsonFromSlice($str, 'var imageInfo = ');
			
			# print_r($json);exit;
		return $json;
		}
		
		
	function parsePages($which = "rumsey", $randomize = true, $skip = 0)
		{
			
		# $method = "casper"; if($which == "rumsey") { $method = "PHP"; }		
		$method = "casper";
		$method = "python";
		
		# assumes master exists ... 
		$url = $this->sites[$which] . $this->urlTemplates["X-browse"];
			$this->browsePath = $this->currentPath . $which . "/";
		checkFolderRecursive($this->browsePath);
		
		
		$json = $this->browsePath . "browse.json";
		if(file_exists($json)) { $master =  getJSON($json); } else { $this->parseBrowse($which); }
		
		$random = $this->randomizeMaster($master, $randomize);
		
		$res = $random["array"];
		$keys = $random["keys"]; # this has been shuffled ...
				
		
		$nkeys = sizeof($keys);
		$c = 0;
		foreach($keys as $i=>$id)
			{
			$c++;
			if($i > $skip)
				{
				echo"\n\n -- $i -- $id -- [$c of $nkeys] \n\n";
				
				$info = $res[$id];
				
				$localpath = $this->browsePath . "maps" . "/" . $id . "/";
					checkFolderRecursive($localpath);
					
					$local = $localpath . "index.html";
					
					$jlocal = $localpath . "index.json";
					$jimage = $localpath . "image.jpg";
					$jinfo = $localpath . "image.json";
					# $jp2 	= $localpath . "image.jp2";
					# $zip 	= $localpath . "image.zip";
					
					
					echo"\n\n '".$jlocal."' \n\n";
					# if(file_exists($jlocal)) { echo"monte"; exit; }
					
					if(!file_exists($jlocal))
					{
					echo"\n\n -- $i -- $id -- [$c of $nkeys] \n\n"; msleep(0.33);
					$remote = $this->cleanupRemote($info["link"]["url"]);
					
					
					echo"\n\n '".$local."' \n\n";
					echo"\n\n '".$remote."' \n\n";
					
					$content = getRemoteAndCache($remote, $local, true, $method);
					
					$info = $this->parseMapPage($content);
					
					### echo"\n\n"; print_r($info); echo"\n\n"; 
					
	if(!is_null($info["image"]["json"]))
		{
					$out = array();
					$out["id"] = $info["image"]["json"]["id"];
					$out["localpath"] = $localpath;
					$out["remote"] = $remote;
					$out["media"] = $info["image"]["json"]["mediaCollectionId"];
					$out["image"] = $info["image"]["json"]["largestUrlAvailable"];
						getRemoteAndCache($out["image"], $jimage);
					$out["max-level"] = $info["image"]["json"]["maxLevel"];
					
						$zip = $this->sites[$which]."luna/servlet/detail/export?mediaId=".$out["id"]."&xres=".$out["max-level"]."&rand=".rand(0,100000)/100000;
						
					$out["zip"] = $zip;  # takes about 30 seconds ... 
					# https://jcb.lunaimaging.com/luna/servlet/detail/export?mediaId=JCBMAPS~3~3~3594~101755&xres=7&rand=0.8734827875665045
					
					# https://www.php.net/manual/en/function.rand.php
					
					
					
						$tiles = $this->sites[$which]."luna/servlet/iiif/".$out["id"]."/info.json";
					$out["tiles"] = json_decode( getRemoteAndCache($tiles, $jinfo, true), true);
					
					
						
						
						
					# rumsey ... https://www.davidrumsey.com/rumsey/download.pl?image=/D5005/6388007.sid	
						
					$out["raw"] = $info;
					
					
					# info["image"]["image"] or info["image"]["pdf"] or "video"?
					
					// echo"\n\n"; print_r($info); echo"\n\n"; 
					// echo"\n\n"; print_r($out); echo"\n\n"; 
					
					// exit;
					
					storeJSON($jlocal, $out ); 
					# exit;
		} # ELSE log, we have a bad record ... 
		# 825 -- JCBBOOKS~1~1~1208~101318 ... bad thumb?
		#  -- 844 -- JCBBOOKS~1~1~1382~101337 -- [845 of 12816] ... bad image.json

		
		
					}

				# if(file_exists($jlocal)) { echo"monte"; exit; }
				
				# echo"\n\n $local \n\n";
				# exit;
				}
			}
		
		
		}












	
	function getTotalMapCount($str, $which="rumsey")
		{
		$info = sliceDice($str, $start='<div id="PageRange">', $end='</div>', $strip=true, $direction='start');
			$tmp = explode("of", $info);
			$tmp1 = explode("-", $tmp[0]);
			
		$return = array();
			$return["page-start"] = (int) $tmp1[0];
			$return["page-end"]   = (int) $tmp1[1];
			$return["total-maps"] = (int) str_replace(",", "", $tmp[1]);
		
		
		return ($return);			
		
		echo"<PRE>"; print_r($return);exit;
		/*
		<div id="PageRange">
         1-50 of 12,816
      </div>
	  */
		}
		
	
	function parseBrowsePage($str, $which="rumsey")
		{
		$res = array();
		
		if($which == "jcb")
		{
			$str = removeWhiteSpace($str);
			$tmp = explode('<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">', $str);
		
		echo"<PRE>";
		$search = '<div class="mediaContainer">';
		$ntmp = array();
		
			foreach($tmp as $idx=>$tm)
				{
				if(is_substring($search, $tm))
					{
					$ntmp[] = $tm;
					
					# echo"\n\n -- TMP -- $idx -- \n\n";
					# print_r($tmp[$idx]);
					
					$row = array();
					
					
					$id = sliceDice($tm, $start='<table id="summary-', $end='" class="st">', $strip=false, $direction="start");
					
					
					$row = array("id" => $id);
					
					$row["info"] = array();
					$tmp2 = explode('title="', $tm);
					foreach($tmp2 as $i=>$tm2)
						{
						$tm3 = explode('">', $tm2);
						if(!is_substring('"', $tm3[0]))
							{
							$tm4 = explode('-', $tm3[0]);
							if(isset($tm4[1]))
								{
									$rkey = trim($tm4[0]);
									$rval = trim($tm4[1]);
								$row["info"][$rkey] = $rval;
								}
							# print_r($tm4);
							}
						}
						
						
					$link = sliceDice($tm, $start='servlet/detail/', $end='">', $strip=false, $direction="start");
					
					$linkA = explode(":",$link);
					
					$row["link"] = array();
						$row["link"]["id"] = trim($linkA[0]);
						$row["link"]["title"] = "";
						if(isset($linkA[1]))
							{ 
							$row["link"]["title"] = trim($linkA[1]); 
							}
					$href = sliceDice($tm, $start='href="', $end='"', $strip=false, $direction="start");
						$row["link"]["url"] = trim($href);
					
					$src = sliceDice($tm, $start='src="', $end='"', $strip=false, $direction="start");
					
					# $src = str_replace("Size2", "Size4", $src);
					$srctmp = explode("?",$src);
					$src = trim($srctmp[0]);
					
					$row["image"] = $src;
					
					# other page is not needing casper?  imageInfo json ... 
					
					
					$res[$id] = $row;
					}
				}
			
			# echo"\n\n -- ntmp -- size -- \n\n";
			# print_r(sizeof($ntmp));
			
			# print_r($res);
			# exit;
		}
		
		
		if($which == "rumsey")
		{
			$str = removeWhiteSpace($str);
			$tmp = explode('<div class="thumbnailItem resolution1 ultraWide">', $str);
		
		echo"<PRE>";
		$search = '<div class="mediaContainer">';
		$ntmp = array();
		
			foreach($tmp as $idx=>$tm)
				{
				if(is_substring($search, $tm))
					{
					$ntmp[] = $tm;
					
					## echo"\n\n -- TMP -- $idx -- \n\n";
					## print_r($tmp[$idx]);
					
					$row = array();
					
					
					$id = sliceDice($tm, $start='id="', $end='" border="0">', $strip=false, $direction="start");
					
					
					$row = array("id" => $id);
					
					$row["info"] = array();
					$tmp2 = explode('title="', $tm);
					foreach($tmp2 as $i=>$tm2)
						{
						$tm3 = explode('">', $tm2);
						if(!is_substring('"', $tm3[0]))
							{
							$tm4 = explode('-', $tm3[0]);
							if(isset($tm4[1]))
								{
									$rkey = trim($tm4[0]);
									$rval = trim($tm4[1]);
								$row["info"][$rkey] = $rval;
								}
							# print_r($tm4);
							}
						}
						
						
					$link = sliceDice($tm, $start='servlet/detail/', $end='">', $strip=false, $direction="start");
					
					$linkA = explode(":",$link);
					
					$row["link"] = array();
						$row["link"]["id"] = trim($linkA[0]);
						$row["link"]["title"] = "";
						if(isset($linkA[1]))
							{ 
							$row["link"]["title"] = trim($linkA[1]); 
							}
					$href = sliceDice($tm, $start='href="', $end='"', $strip=false, $direction="start");
						$row["link"]["url"] = trim($href);
					
					$src = sliceDice($tm, $start='src="', $end='"', $strip=false, $direction="start");
					
					# $src = str_replace("Size2", "Size4", $src);
					$srctmp = explode("?",$src);
					$src = trim($srctmp[0]);
					
					$row["image"] = $src;
					
					# other page is not needing casper?  imageInfo json ... 
					
					
					$res[$id] = $row;
					
					# break;
					}
				}
			
			# echo"\n\n -- ntmp -- size -- \n\n";
			# print_r(sizeof($ntmp));
			
			# print_r($res);
			# exit;
		}
		
		
		
		return $res;
		}
	
	function randomizeMaster($master, $randomize = true)
		{
		$res = array();
			$keys = array();
			foreach($master as $page=>$details)
				{
				foreach($details as $id=>$info)
					{
					$keys[] = $id;
					$res[$id] = $info;
					}
				}
			if($randomize)
				{
				shuffle($keys);
				}
		# echo"<PRE>"; print_r($keys); exit;
		$random = array("keys" => $keys, "array" => $res);
		return $random;
		}
		
	function cleanupRemote($remote)
		{
		# weird white-space issue ...
		$remote = removeWhiteSpace($remote);
			$remote = str_replace(array(" ", "&amp;"), "", $remote);
			
			# $remote = rawurlencode($remote);
			$remote = urlencode($remote);
			$remote = str_replace("%00","",$remote); # white space not removing ...
			$remote = urldecode($remote);
		return $remote;
		}
	
	
		
	function downloadPages($which = "rumsey", $randomize = true, $skip = 0)
		{
		# $method = "casper"; if($which == "rumsey") { $method = "PHP"; }		
		$method = "casper";
		$method = "python";
		
		/*
		$myMaps->sites = array(
							"rumsey" => "https://www.davidrumsey.com/", # 106,164

							"jcb" => "https://jcb.lunaimaging.com/",  # 12,816
		$myMAPS->urlTemplates = array(
								"X-browse" => "luna/servlet/view/all?os={os}",
								"X-map" => "luna/servlet/detail/{mid}:{mextra}",
								);
									
		*/
		
		# assumes master exists ... 
		$url = $this->sites[$which] . $this->urlTemplates["X-browse"];
			$this->browsePath = $this->currentPath . $which . "/";
		checkFolderRecursive($this->browsePath);
		
		
		$json = $this->browsePath . "browse.json";
		if(file_exists($json)) { $master =  getJSON($json); } else { $this->parseBrowse($which); }
		
		$random = $this->randomizeMaster($master, $randomize);
		
		$res = $random["array"];
		$keys = $random["keys"]; # this has been shuffled ...
		
		# print_r($keys);exit;
		
		$j = 0;
		foreach($keys as $i=>$id)
			{
			if($i > $skip)
				{
				echo"\n\n -- $i -- $id -- \n\n";
				
				$info = $res[$id];
				
				$localpath = $this->browsePath . "maps" . "/" . $id . "/";
					checkFolderRecursive($localpath);
					
					$local = $localpath . "index.html";
					
					
					if(!file_exists($local))
							{
					$remote = $this->cleanupRemote($info["link"]["url"]);
					
					echo"\n\n [ $j :: $i ] \n\n '".$remote."' \n\n";
					
					$content = getRemoteAndCache($remote, $local, true, $method);
					
					if(empty(trim($content))) 
								{ 
								unlink($local); 
								doSleep(13, true);
								getRemoteAndCache($remote, $local, true, $method);
								}
							$j++;
							if($j > 22) { doSleep(13, true); $j = 0; }  # seems to stall, so let's pause ... ... 
							}
					
					

				# echo"\n\n $local \n\n";
				# exit;
				}
			}
		
		
		}
	
	function parseBrowse($which = "rumsey")
		{
		# $url = $this->urlTemplates[$which."-browse"];
		$url = $this->sites[$which] . $this->urlTemplates["X-browse"];
			$this->browsePath = $this->currentPath . $which . "/";
		checkFolderRecursive($this->browsePath);
		
		
		$json = $this->browsePath . "browse.json";
		if(file_exists($json)) { return getJSON($json); }
		
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=00
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=50
		# guianans
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=12800
		
		$os = 0;  # $os += 50;
		$page = 1;
		$myPage = str_pad($page,4,"0",STR_PAD_LEFT);
		
		# get page 1
		$remote = str_replace("{os}", $os, $url);
		$localpath = $this->browsePath . "pages" . "/" . $myPage . "/";
			checkFolderRecursive($localpath);
		$local = $localpath . "index.html";
		$jlocal = str_replace("index.html", "index.json", $local);
		
		
		$content = getRemoteAndCache($remote, $local, true, "casper");
		$info = $this->getTotalMapCount($content, $which);
		
		$pages = ceil($info["total-maps"] / 50);
		
		$master = array();
		
		
		$details = $this->parseBrowsePage($content, $which);
		storeJSON($jlocal, $details );	
		
		$master[$page] = $details;
		
		
		for($page = 2; $page <= $pages; $page++)
			{
			$os = 50 * ($page - 1);
			$myPage = str_pad($page,4,"0",STR_PAD_LEFT);
			
			$remote = str_replace("{os}", $os, $url);
				$localpath = $this->browsePath . "pages" . "/" . $myPage . "/";
					checkFolderRecursive($localpath);
			$local = $localpath . "index.html";
			$jlocal = str_replace("index.html", "index.json", $local);
			
			echo"\n\n PAGE: ". $page. " of " . $pages . "\n\n";
			$content = getRemoteAndCache($remote, $local, true, "casper");
			
			$details = $this->parseBrowsePage($content, $which);
			
			storeJSON($jlocal, $details );	
			
			
			$master[$page] = $details;
		
			}
			
		
		
		// echo"<PRE>"; 
			// echo"\n\n";print_r($local);
			// echo"\n\n";print_r($info);
			// echo"\n\n";print_r($details);
			// echo"\n\n";print_r($master);
		// exit;
		
		storeJSON($json, $master );	
		# sleep(5);
		
		return $master;
		}
		
		
	function doBrowse($which="rumsey")
		{
		# $url = $this->urlTemplates[$which."-browse"];
		$url = $this->sites[$which] . $this->urlTemplates["X-browse"];
			$this->browsePath = $this->currentPath . $which . "/";
		checkFolderRecursive($this->browsePath);
		
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=00
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=50
		# guianans
		# https://jcb.lunaimaging.com/luna/servlet/view/all?os=12800
		
		$os = 0;  # $os += 50;
		$page = 1;
		$myPage = str_pad($page,4,"0",STR_PAD_LEFT);
		
		# get page 1
		$remote = str_replace("{os}", $os, $url);
		$localpath = $this->browsePath . "pages" . "/" . $myPage . "/";
			checkFolderRecursive($localpath);
		$local = $localpath . "index.html";
		
		
		$content = getRemoteAndCache($remote, $local, true, "casper");
		$info = $this->getTotalMapCount($content, $which);
		
		$pages = ceil($info["total-maps"] / 50);
		
		for($page = 2; $page <= $pages; $page++)
			{
			$os = 50 * ($page - 1);
			$myPage = str_pad($page,4,"0",STR_PAD_LEFT);
			
			$remote = str_replace("{os}", $os, $url);
				$localpath = $this->browsePath . "pages" . "/" . $myPage . "/";
					checkFolderRecursive($localpath);
			$local = $localpath . "index.html";
			echo"\n\n PAGE: ". $page. " of " . $pages . "\n\n";
			$content = getRemoteAndCache($remote, $local, true, "casper");
			}
		
		
		
		
		echo"<PRE>"; 
			echo"\n\n";print_r($pages);
		
			echo"\n\n";print_r($remote);
			
			echo"\n\n";print_r($local);
			
			echo"\n\n";print_r($info);
		
		exit;
		
		
		
		}
		
	}	
?>