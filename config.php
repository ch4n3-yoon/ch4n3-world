<?php

/*
 * The config file for ch4n3-world
 *
*/


/* send alert message */
function msg($msg, $back=1)
{
	if ($back == 1)
	{
		echo "<script> 
				alert('{$msg}'); 
				history.back(); 
			</script>";
	}

	else
	{
		echo "<script> alert('{$msg}'); </script>";
	}
}


?>