<?php ##Author :Amol Navale 20-12-2017
	class op_dateTime{
		/////////////////////////////////////////////////////////////////////
		//PARA: Date Should In YYYY-MM-DD Format
		//RESULT FORMAT:
		// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds' =>1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
		// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
		// '%m Month %d Day'                                            =>  3 Month 14 Day
		// '%d Day %h Hours'                                            =>  14 Day 11 Hours
		// '%d Day'                                                        =>  14 Days
		// '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
		// '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
		// '%h Hours                                                    =>  11 Hours
		// '%a Days                                                        =>  468 Days
		//$differenceFormat = '%a' 
		//////////////////////////////////////////////////////////////////////
		function dateDifference($date_1 , $date_2 , $differenceFormat = '' ){
			$datetime1 = date_create($date_1);
			$datetime2 = date_create($date_2);	   
			$interval = date_diff($datetime1, $datetime2);	   
			return ($differenceFormat!='')?$interval->format($differenceFormat):$interval;	   
		}
		/////////////////////////////////////////////////////////////////////		
		//Add days to datetime.
		//Add hours to datetime.
		//Add minutes to datetime.
		//Add seconds to datetime.
		//$startTime = date("Y-m-d H:i:s");
		//$obj_dateTime->dateAdd($startTime,1,1,50,30)
		////////////////////////////////////////////////////////////////////
		function dateAdd($startTime,$day=0,$hours=0,$minutes=0,$seconds=0){
			return date('Y-m-d H:i:s',strtotime("+$day day +$hours hour +$minutes minutes +$seconds seconds",strtotime($startTime)));
		}
	}
		
		$obj_dateTime = new op_dateTime();
		$date_1 = '2017-12-18 12:10:03';
		$date_2 = '2017-12-18 13:11:03'; 
		$interval = $obj_dateTime->dateDifference($date_1, $date_2,'%a:%h:%i:%s');
		echo '<pre>';print_r($interval); echo '</pre>';

		$date_1='2017-12-19 13:11:03';
		echo	$cenvertedTime = $obj_dateTime->dateAdd($date_1,0,1,1,0);


			


		


?>