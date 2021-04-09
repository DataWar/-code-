<?php	

# https://www.php.net/manual/en/function.sleep.php
# sleep as a fraction ... 
function msleep($time)
{
    usleep($time * 1000000);
}

function doSleep($intsec, $verbose=TRUE)
	{
	if(!$verbose)
		{
		sleep($intsec);
		} else {
				echo"\n\n SLEEPING : \t ";
				for($i = 1; $i <= $intsec; $i++)
					{
					sleep(1); echo" . $i . \t";
					}
				echo"\n\n";
				}
	
	}

$_debug = isset($_GET["debug"]) ? $_GET["debug"] : false;
	$_debug = (md5($_debug) == "ae442b3ec02781e25f556cee2bb3eec3") ? true : false;
	# ?debug="219926afe0c5fc0d0a7c89566fcfb46d"
	# debug=219926afe0c5fc0d0a7c89566fcfb46d

function doDebug($myString)
		{
		global $_debug;
			/* add debug levels */ 
		if($_debug == true)
			{
			echo($myString); echo"\n";
			flush();
			ob_flush();
			}
		}
		
		
function parseArgs($argv)
	{
   # array_shift($argv);
    $out = array();
	if(isset($argv))
		{
		foreach ($argv as $arg)
			{
			$tA = explode("=",$arg);
			if(isset($tA[1]))
				{
				$myK = trim($tA[0]);
				$myV = trim($tA[1]);
				$out[$myK]=$myV;
				}
			}
		}
		# echo"<PRE>";print_r($out);exit;
    return $out;
	}



function fillArray($start,$end)
	{
	$arr = array();
	for($i = $start; $i<=$end; $i++)
		{
		$arr[$i] = $i;
		}
	return $arr;
	}


?>