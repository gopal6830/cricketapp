<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://cricket-live-data.p.rapidapi.com/series",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: cricket-live-data.p.rapidapi.com",
		"X-RapidAPI-Key: ebdc970169mshe34e44c7ff2ac7dp108700jsn1564b1541f69"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response=json_decode($response,true);
    echo "<pre>";
    print_r($response);
     echo "</pre>";