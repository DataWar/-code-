<?PHP

$myBLB = new myBLB;
	$myBLB->dataPath = "S:/project-BLB/";
	$myBLB->when = date("Y-m");
	$myBLB->bibles = array("KJV", "NKJV", "NLT", "NIV", "ESV", "CSB", "NASB20", "NASB95", "NET", "RSV", "ASV", "YLT", "DBY", "WEB", "HNV", "RVR60", "VUL", "WLC", "LXX"); # NEW TESTAMENTS ONLY ?? , "mGNT", "TR");
	
	# https://www.blbclassic.org/
	# https://www.blbclassic.org/versions.cfm#esv
	# masoretic, interlinear, reverse interlinear
	# ajax calls for "tabs"?
	# http://self.gutenberg.org/articles/Joseph_Smith_Translation
	# http://self.gutenberg.org/articles/Old_English_Bible_translations
	# https://www.thehistoryofenglish.com/mp3s/lords.html
	# German?  Chinese?  Gutenberg? Wycliff? 
	# https://github.com/tyndale
	# https://github.com/tyndale/STEPBible-Data
	# https://raw.githubusercontent.com/tyndale/STEPBible-Data/master/TBESG%20-%20Tyndale%20Brief%20lexicon%20of%20Extended%20Strongs%20for%20Greek%20-%20STEPBible.org%20CC%20BY.txt #TYNDALE STRONGS
	# https://www.stepbible.org/html/en-29.html
	# https://valera1602.org/
	# http://valera1602.org/bibliabible/genesis # each book is on the one page, hidden ...
	# lexImage.cfm?tv=1612651254
	# lexImage.cfm?tv=1612672853732&a
	# https://www.blueletterbible.org/assets/scripts/blb.js?tv=1612542616
	# https://www.blueletterbible.org/assets/scripts/lexiconPage.js?tv=1612542616
	# https://www.blueletterbible.org/lang/lexicon/lexImage.cfm?tv=1612673404770&a
	# https://www.blueletterbible.org/lang/lexicon/lexImage.cfm?tv=1612651368
	/*
	# cookie ?  
	CFGLOBALS
	CFCLIENT_GENERAL_BLBV31
	CFTOKEN
	BLB__UID
	CFID

curl_setopt( $curl_handle, CURLOPT_COOKIESESSION, true );
curl_setopt( $curl_handle, CURLOPT_COOKIEJAR, uniquefilename );
curl_setopt( $curl_handle, CURLOPT_COOKIEFILE, uniquefilename );


	Event.addListener('moreTG', 'click', function() {
						var d = new Date();
						var n = d.getTime();
						Dom.get('lexImage').src='lexImage.cfm?tv='+n+'&a';
						Dom.setStyle(this.parentNode, 'display', 'none');
				});
	*/
	$myBLB->urlTemplates = array(
	# https://www.imdb.com/search/title/?title_type=feature&year=1973-01-01,1973-12-31&start=51&ref_=adv_nxt
								"strongs-hebrew" => "https://www.blueletterbible.org/lang/Lexicon/Lexicon.cfm?strongs=H{h}",
								"strongs-greek" => "https://www.blueletterbible.org/lang/Lexicon/Lexicon.cfm?strongs=G{g}",
								
								
								"bible-chapter" => "https://www.blueletterbible.org/{bible}/{b}/{c}/1",
								
								"bible-extra" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/{key}_{s}{vvv}",
								
								
								
								
								"dictionary-letter" => "https://www.blueletterbible.org/search/dictionary/viewentries.cfm?letter={one}",
								"dictionary-letter-two" => "https://www.blueletterbible.org/search/dictionary/viewentries.cfm?letter={one}&twoletter={two}",
								
								
								"bible-concordance" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_conc_{c}{vvv}",  ## vvv is zero padded ... 001
								"bible-verse-compare" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_bibles_{c}{vvv}",  ## vvv is zero padded ... 001
								"bible-see-also" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_corr_{c}{vvv}",  ## vvv is zero padded ... 001
								"bible-commentaries" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_comms_{c}{vvv}",  ## vvv is zero padded ... 001
								"bible-references" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_refs_{c}{vvv}",  ## vvv is zero padded ... 001
								"bible-misc" => "https://www.blueletterbible.org/{bible}/{b}/{c}/{v}/t_misc_{c}{vvv}",  ## vvv is zero padded ... 001
								
								
									);

	
	$myBLB->currentPath = $myBLB->dataPath . $myBLB->when . "/";
		checkFolderRecursive($myBLB->currentPath);


switch($a)
	{
	default:
	
		echo"<PRE>"; print_r($myBLB); # exit;
	break;
	
	case "verses":
	case "verse":
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
		
		#  php -f run.php p=BLB a=verses w=KJV
		$myBLB->getVerseInfo();
	break;
	
	# $myBLB->bibles = array("KJV", "NKJV", "NLT", "NIV", "ESV", "CSB", "NASB", "NET", "RSV", "ASV", "YLT", "DBY", "WEB", "HNV", "RVR60", "VUL", "WLC", "LXX", "mGNT", "TR");
	case "chapters":
	case "chapter":
		# get chapters
		#  php -f run.php p=BLB a=chapters w=KJV
		
		#  php -f run.php p=BLB a=chapters w=NKJV
		#  php -f run.php p=BLB a=chapters w=NLT
		#  php -f run.php p=BLB a=chapters w=NIV
		#  php -f run.php p=BLB a=chapters w=ESV
		#  php -f run.php p=BLB a=chapters w=CSB
		
		#  php -f run.php p=BLB a=chapters w=NASB20
		#  php -f run.php p=BLB a=chapters w=NASB95
		#  php -f run.php p=BLB a=chapters w=NET
		#  php -f run.php p=BLB a=chapters w=RSV
		#  php -f run.php p=BLB a=chapters w=ASV
		
		#  php -f run.php p=BLB a=chapters w=DBY  		## 1980.010 ... 33 minutes
		#  php -f run.php p=BLB a=chapters w=WEB		## 2142.554 ... 35.7092333
		#  php -f run.php p=BLB a=chapters w=HNV  		## 1994.221 ... 33.23 minutes
		#  php -f run.php p=BLB a=chapters w=RVR60		## 2122.081 ... 35.36
		#  php -f run.php p=BLB a=chapters w=VUL		## 2080.267 ... 34.67
		
		#  php -f run.php p=BLB a=chapters w=WLC
		#  php -f run.php p=BLB a=chapters w=LXX

		$w	=	"KJV";  
			if(isset($_GET["w"])){$w=$_GET["w"];}
			if(isset($_ARG["w"])){$w=$_ARG["w"];}
		if(!in_array($w, $myBLB->bibles)) { $w = "KJV"; }
		$myBLB->getChapters($w);
	break;
	
	case "strongs":
	case "strong":
		#  php -f run.php p=BLB a=strongs w=greek
		#  php -f run.php p=BLB a=strongs w=hebrew
		#  php -f run.php p=BLB a=strongs w=python

			$w	=	"greek";  # or hebrew or python
			if(isset($_GET["w"])){$w=$_GET["w"];}
			if(isset($_ARG["w"])){$w=$_ARG["w"];}
		$myBLB->doStrongs($w);
	break;
	
		
	}


?>