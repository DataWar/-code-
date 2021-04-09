<?php	

function is_substring($find, $str)
	{
	if (strpos($str, $find) !== false) 
		{
		return TRUE;
		}
	return FALSE;
	}

function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

function jsonFromSlice($str, $var, $next="var ")
	{
	$info = sliceDice($str, $start=$var, $end=$next, $strip=false, $direction='start');
	# echo"\n\n $var \n\n ============== \n\n $info \n\n";
	$raw = trim(rtrim(trim($info)),";");
	
	# https://stackoverflow.com/questions/10199017/how-to-solve-json-error-utf8-error-in-php-json-decode/17182431#17182431
	$raw = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($raw));
	# https://stackoverflow.com/questions/24001410/php-json-decode-not-working
	# $raw = stripslashes(html_entity_decode($raw));
	# https://stackoverflow.com/questions/22158888/php-json-decode-not-working
	# $raw = stripslashes($raw);
	# $raw = remove_utf8_bom($raw);
	$json = json_decode($raw, TRUE);
	return(array("raw"=>$raw,"json"=>$json));
	}
function sliceDice($str, $start="<h2>",$end="</h2>", $strip=TRUE, $direction="end")
		{		# what if <h2 without >
		if($direction == "end")
			{
			$tmp = explode($end,$str);
				$tmp1 = explode($start,$tmp[0]);
				if(!isset($tmp1[1])) { $tmp1[1] = ""; }
			$str = $tmp1[1];
			} else { # start .... 
					$tmp = explode($start,$str);
					if(!isset($tmp[1])) { $tmp[1] = ""; }
						$tmp1 = explode($end,$tmp[1]);
					$str = $tmp1[0];
					}

			if($strip) { $str = trim(strip_tags($str)); }
		return $str;
		}

function sliceDiceArray($str, $start="<h2>",$end="</h2>", $strip=TRUE, $direction="end")
		{		# what if <h2 without >
		$res = array();
		if($direction == "end")
			{
				# not coded yet
			$tmp = explode($end,$str);
				$tmp1 = explode($start,$tmp[0]);
				if(!isset($tmp1[1])) { $tmp1[1] = ""; }
			$str = $tmp1[1];
			} else { 
					$tmp = explode($start, $str);
					$n = sizeof($tmp);
					if($n > 1)
						{
						for($i=2;$i<=$n;$i++)
							{
							$row = $tmp[$i-1];
							$tmp2 = explode($end, $row);
							$str = trim($tmp2[0]);
							if($strip) { $str = trim(strip_tags($str)); }
							if(!empty($str)) { $res[] = $str; }
							}
					
						}
					
					}

			
			
		return $res;
		}
		
		
function removeWhiteSpace($text)
	{
	$text = preg_replace("/\s+/", ' ', $text);
	$text = trim($text);
	
	return($text);
	}

function myPercent($num, $left=3, $right=3)
	{
	# convert to string with left SPACE and right ZEROES
	$num = round($num, $right);
	$tmp = explode(".",$num);
	
	# echo"<PRE>"; print_r($tmp); # exit;
	
	if(!isset($tmp[1])) { $tmp[1] = ""; }
	
	$whole = str_pad(trim($tmp[0]), $left, " ", STR_PAD_LEFT); 
	$frac  = str_pad(trim($tmp[1]), $right, "0", STR_PAD_RIGHT); 
	
	$new = $whole . "." . $frac;
	
	# echo($new); exit;
	
	return $new;
	}

?>