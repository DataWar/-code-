<?PHP
$start = microtime(true); 		## start the clock on script execution

$path = realpath( dirname(__FILE__) ). DIRECTORY_SEPARATOR;
	# set as constant # https://www.php.net/manual/en/function.define.php
	define("PHP_INCLUDE", $path . "php" . DIRECTORY_SEPARATOR);
	define("PHP_LIBS", str_replace("run","libs", $path));
	define("PHP_DATA", str_replace("run","data", $path));

# error_reporting(0);						## no warnings!
 set_time_limit(0);							## let's script run indefinitely
 ini_set("memory_limit",1024*1024*1024*2);	## RAM (2 GB)
		
		
# echo"<PRE>";print_r($path);exit;
# phpinfo(); exit;

require_once(PHP_INCLUDE . "functions/functions.error.php");
require_once(PHP_INCLUDE . "functions/functions.system.php");
require_once(PHP_INCLUDE . "functions/functions.file.php");
require_once(PHP_INCLUDE . "functions/functions.parse.php");

if(!isset($argv)) { $argv = array(); }
$_ARG = parseArgs($argv);
# echo"<PRE>"; print_r($_ARG);exit;

# [p]roject, [a]ction, [l]ist
# php -f run.php a=forward p=heather l=doOF
# http://localhost/run/run.php?a=forward&p=heather&l=doOF
$p	= "project";
	if(isset($_GET["p"])){$p=$_GET["p"];} # from URL: http://
	if(isset($_ARG["p"])){$p=$_ARG["p"];} # from cli argv (command line)
$a	= "action";
	if(isset($_GET["a"])){$a=$_GET["a"];}
	if(isset($_ARG["a"])){$a=$_ARG["a"];}
$l	=	"myList";
	if(isset($_GET["l"])){$l=$_GET["l"];}
	if(isset($_ARG["l"])){$l=$_ARG["l"];}
$y	=	"myYear";
	if(isset($_GET["y"])){$y=$_GET["y"];}
	if(isset($_ARG["y"])){$y=$_ARG["y"];}
	
echo" Project [ $p ] ... action [ $a ] ... list [ $l ] ... year [ $y ] ...";	
	
switch($p)
	{
	default:
		echo"<PRE>";print_r($_GET);
		echo"<PRE>";print_r($_ARG);
	break;
	
	case "cran":
	case "CRAN":  # download the CRAN stuff (figure out linkages among packages)
		require_once(PHP_INCLUDE . "projects/CRAN/class.CRAN.php");
		require_once(PHP_INCLUDE . "projects/CRAN/setup.CRAN.php");  # actions		
	break;
	
	case "imdb":  # download the IMDB stuff
	case "IMDB":
		require_once(PHP_INCLUDE . "projects/imdb/class.IMDB.php");
		require_once(PHP_INCLUDE . "projects/imdb/setup.IMDB.php");  # action
	break;	
	
	case "maps":  
	case "MAPS":
		require_once(PHP_INCLUDE . "projects/MAPS/class.MAPS.php");
		require_once(PHP_INCLUDE . "projects/MAPS/setup.MAPS.php");  # action
	break;	
	
	
	case "blb":  
	case "BLB":
		require_once(PHP_INCLUDE . "projects/BLB/class.BLB.php");
		require_once(PHP_INCLUDE . "projects/BLB/setup.BLB.php");  # action
	break;
	
	}
	

$end = microtime(true); 
$diff = round($end - $start, 3);
echo"\n\n Script executed in $diff seconds \n\n";
echo" Project [ $p ] ... action [ $a ] ... list [ $l ] ... year [ $y ] ...";	
exit;

?>