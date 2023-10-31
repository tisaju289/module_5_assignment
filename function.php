<?php 
// fopen(filename, mode, include_path, context);
function saveTxt($id_file,$id_content,$mode){
	if(!file_exists($id_file)) fopen($id_file,"w");
	$fp = fopen($id_file,$mode) or die ("Error opening file $id_file");
	fputs($fp,$id_content);
	fclose($fp) or die ("Error closing file!");
}
