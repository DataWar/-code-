<?php	
/*  CUSTOM ERROR HANDLING */	
function getExceptionTraceAsString($exception) {
    $rtn = "";
    $count = 0;
    foreach ($exception->getTrace() as $frame) {
        $args = "";
        if (isset($frame['args'])) {
            $args = array();
	# monte hacks
	if (!isset($frame['file'])) 	{ $frame['file'] = " - file - UNKNOWN";	}
	if (!isset($frame['line'])) 	{ $frame['line'] = " - line - UNKNOWN";	}
	if (!isset($frame['function'])) { $frame['function'] = " - function - UNKNOWN";	}
            foreach ($frame['args'] as $arg) {
                if (is_string($arg)) {
                    $args[] = "'" . $arg . "'";
                } elseif (is_array($arg)) {
                    $args[] = "Array";
                } elseif (is_null($arg)) {
                    $args[] = 'NULL';
                } elseif (is_bool($arg)) {
                    $args[] = ($arg) ? "true" : "false";
                } elseif (is_object($arg)) {
                    $args[] = get_class($arg);
                } elseif (is_resource($arg)) {
                    $args[] = get_resource_type($arg);
                } else {
                    $args[] = $arg;
                }   
            }   
            $args = join(", ", $args);
        }
        $rtn .= sprintf( "#%s %s(%s): %s(%s)\n",
                                 $count,
                                 $frame['file'],
                                 $frame['line'],
                                 $frame['function'],
                                 $args );
        $count++;
    }
    return $rtn;
}

// ----------------------------------------------------------------------------------------------------
// - Shutdown Handler
// ----------------------------------------------------------------------------------------------------
function ShutdownHandler()
{
    if(@is_array($error = @error_get_last()))
    {
        return(@call_user_func_array('ErrorHandler', $error));
    };

    return(TRUE);
};

register_shutdown_function('ShutdownHandler');

// ----------------------------------------------------------------------------------------------------
// - Error Handler
// ----------------------------------------------------------------------------------------------------
function ErrorHandler($type, $message, $file, $line)
{
	
    $_ERRORS = Array(
        0x0001 => 'E_ERROR',
        0x0002 => 'E_WARNING',
        0x0004 => 'E_PARSE',
        0x0008 => 'E_NOTICE',
        0x0010 => 'E_CORE_ERROR',
        0x0020 => 'E_CORE_WARNING',
        0x0040 => 'E_COMPILE_ERROR',
        0x0080 => 'E_COMPILE_WARNING',
        0x0100 => 'E_USER_ERROR',
        0x0200 => 'E_USER_WARNING',
        0x0400 => 'E_USER_NOTICE',
        0x0800 => 'E_STRICT',
        0x1000 => 'E_RECOVERABLE_ERROR',
        0x2000 => 'E_DEPRECATED',
        0x4000 => 'E_USER_DEPRECATED'
    );

    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS))))
    {
        $name = 'E_UNKNOWN';
    };
	
	#$str = '<b>'.print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)).'</b>';
	
	#array_walk(debug_backtrace(),create_function('$a,$b','print "{$a[\'function\']}()(".basename($a[\'file\']).":{$a[\'line\']}); ";'));
	
	$stack = '<PRE>'.getExceptionTraceAsString(new \Exception).'</PRE>';
		
##flush(); ob_flush();  # clears buffer
	return( print(@sprintf('<b>'."%s Error in file \xBB%s\xAB at line %d: %s".'</b>'."\n", $name, @basename($file), $line, $message)) . $stack );
	
};

$old_error_handler = set_error_handler("ErrorHandler");



?>