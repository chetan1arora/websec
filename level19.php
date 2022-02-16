<?php
require 'vendor/autoload.php';

# Use http for setting host url request parameter
$bu = 'https://websec.fr/level19/';

#Imitating server
function generate_random_text ($length) {
    $chars  = "abcdefghijklmnopqrstuvwxyz";
    $chars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $chars .= "1234567890";

    $text = '';
    for($i = 0; $i < $length; $i++) {
        $text .= $chars[rand () % strlen ($chars)];
    }
    return $text;
}

# Get request and session id
$DOM = new DOMDocument();
$headers = ['headers' => ['Host' => 'www.psk3n.com']];
while(true){
	$cl = new GuzzleHttp\Client([
		"base_uri" => $bu,
		"cookies" => true
	]);
	srand(microtime(true)+1);
	$res = $cl->request("GET","index.php",$headers);
	// print_r($res->getHeaders());
	# Get response body and token
	$r = $res->getBody();
	$r = (string) $r;
	// $DOM->validateOnParse = true;
	@$DOM->loadHTML($r);
	$token = $DOM->getElementById('token')->getAttribute('value');
	echo($token."\n");	
	$generatedToken = generate_random_text(32);
	echo($generatedToken."\n");
	if(!hash_equals($generatedToken,$token)){
		continue;
	}
	echo("Matching the captcha now...");
	# Send post request with token and captcha
	$captcha = generate_random_text(255/ 10.0);

	$res = $cl->request("POST","index.php", [
		'headers' => [
			'Host' => 'www.psk3n.com'
		],
	    'form_params' => [
	        'captcha' => $captcha,
	        'token' => $token,
	    ]
	]);
		// 'referer' => "http://psk3n.com/",
	$r =(string)($res->getBody());
	echo($r."\n");
	// @$DOM->loadHTML($r);
	// $mes = $DOM->getElementsByTagName('p')->item(1)->nodeValue;
	// print($mes);
	break;
}