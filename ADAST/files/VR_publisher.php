<?php
	function PublishInformation($topic)
	{
		$URLofTopic = $topic;
		$URLtoGet = "http://hub.ccg.tw/?notification=true&topic=".$URLofTopic;

		echo $URLtoGet;

		// Note: Remove comment before send message!
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $URLtoGet);

		$result = curl_exec($ch);

		print_r($result);
		curl_close($ch);
	}


	$sleep_time_second = 3;
	sleep($sleep_time_second);
	PublishInformation("http://vrtestbed.iis.sinica.edu.tw:3000/data/debris_alerts.xml");
?>