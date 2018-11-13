<?php

function folderTree ($directory_path) {

	if(!file_exists($directory_path)) {
		die("The file $directory_path is not exists");
	}

	if(!is_dir($directory_path)) {
		die("This directory $directory_path can't open");
	}

	$directory = opendir($directory_path);

	$filenames = [];
	while ($filename = readdir($directory)) {
		if($filename !== '.' && $filename !== '..' ) {
			if(is_dir($directory_path.'/'.$filename)) {
				$filename .= '/';
			}
			$filenames[] = $filename;
		}
	}

	echo "<ul>";
	foreach ($filenames as $filename) {
		echo "<li><a href='{$directory_path}/{$filename}'>";
			echo $filename;
			if(substr($filename, -1) == '/' ) {
				folderTree($directory_path.'/'.substr($filename, 0, -1));
			}
		echo "</a></li>";
	}
	echo "</ul>";
}

$folder_name = 'my-folder';
folderTree($folder_name);