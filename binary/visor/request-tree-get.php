<?php

function send($data) {
    $url = 'http://oxigeno.local/binary/api/tree.php';
    $bearerToken = '6XkYzwJCkEoWEbUgOEeEjL45QpIE8ZMvRvNbf3GC7i8lL/wu+yjsIqYFbbamJE2bRkhGxb6jHpMLExOoosW83g==';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' , sprintf('Authorization: Bearer %s', $bearerToken)]);
    $response = json_decode(curl_exec($curl));
    return $response;
}

function testMyNetworkSuccess () {
  $params = [
  ];

  return  send($params);
}

$source_tree = testMyNetworkSuccess();

$my_id = '61ae8165a7d82e44282d34f0';

//  var_dump(testMyNetworkSuccess());
