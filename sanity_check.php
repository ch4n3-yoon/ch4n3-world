<?php
	// Made by pushesp (pushesp@naver.com)
	error_reporting(0);
	require './lib1.php';

	extract($_GET);
	if(isset($say)){
		if(is_array($say)){
			echo 'no array';
		}elseif(strlen($_GET['say']) > mt_rand(8, 16)){
			echo 'no long';
		}elseif(array_key_exists('say', $_GET)){
			echo 'no get param';
		}elseif(preg_match('/^.*give.me.*$/', $say)){
			echo 'no give me';
		}elseif(preg_match('/^.*flag.*$/', $say)){
			echo 'no flag';
		}elseif(strrpos($say, 'give me the flag') !== false){
			echo $flag;
		}else{
			echo 'what r u doing?';
		}
		echo '<hr>';
	}

	highlight_file(__FILE__);
?>