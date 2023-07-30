<?php ##Author :Amol Navale 26-12-2017
	class op_curl{
		/*
		$soapUrl = "xx.xxx.xx.xx:81/ws/NavService.asmx"; // asmx URL of WSDL
        $soapUser = "xxx";  //  username
        $soapPassword = "xx"; // password
		$root_url = "http://xxxx.xx/webservices/";
		$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
		<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
		  <soap12:Body>
			<HelloWorld xmlns="http://xxxx.xx/webservices" />
		  </soap12:Body>
		</soap12:Envelope>';   // data from the form, e.g. some ID number
		$SOAPAction = $root_url.'HelloWorld';		
		$ret = soapRequest_curl($soapUrl,$soapUser,$soapPassword,$xml_post_string,$SOAPAction);
		*/
		function soapRequest_curl($soapUrl,$soapUser,$soapPassword,$xml_post_string,$SOAPAction){
		   $headers = array(
						"Content-type: text/xml;charset=\"utf-8\"",
						"Accept: text/xml",
						"Cache-Control: no-cache",
						"Pragma: no-cache",
						"SOAPAction: $SOAPAction", 
						"Content-length: ".strlen($xml_post_string),
					); //SOAPAction: your op URL

			$url = $soapUrl;

			// PHP cURL  for https connection with auth
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// converting			
			$response = curl_exec($ch);  
			$info = curl_getinfo($ch);
			curl_close($ch);
			// converting
			$response1 = str_replace("<soap:Body>","",$response);
			$response2 = str_replace("</soap:Body>","",$response1);
			// convertingc to XML
			$parser = simplexml_load_string($response2);
			// user $parser to get your data out of XML response and to display it.			
			return array("response"=>$parser,"call_info"=>$info); 
		}
		
	} // class op_curl
?>
	