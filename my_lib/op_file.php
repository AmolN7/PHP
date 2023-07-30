<?php ##Author :Amol Navale 01-12-2017
class op_file{
	function read_csv($filename,$seperator=','){
		ini_set('max_execution_time', 0);
		$headers 	= get_headers($filename, 1);	
		$filetime 	= strtotime($headers['Last-Modified']);
		$file_size	= $headers['Content-Length'];
		
		$itr_temp = array();
		$file_handle = fopen($filename,"r");
		while ($csv = fgetcsv($file_handle,$file_size,$seperator)) {
			//$itr_temp[] = $csv;
			$itr_temp[] = array_map("utf8_encode", $csv); //$csv;
		}
		return $itr_temp;
	}
	
	function create_file($path='./',$filename='',$permission='0755',$filemode="w"){
		if(!is_dir($path)){
		mkdir($path,$permission,TRUE);
		  if(!file_exists($path.$filename) && filename!=''){
			fopen($path.$filename,$filemode);
		  }	  
		} 	
	}
	function read_file($path='./',$filename=''){
		$contents = '';
		 if(file_exists($path.$filename) && filename!=''){
			$file_handle_read = fopen($path.$filename,"r");
			$contents = fread($file_handle_read, filesize($path.$filename));		
			fclose($file_handle_read);
		  }	  
		return $contents;
	}
}
?>