<?php

use GuzzleHttp\Client;

function getRandomImage($path)
{
    $client = new Client();

    $headers = [
        'headers' => [
            "Authorization" => "Client-ID 3wIOnMkmYfqggvtz_YugNp__OWeeC9vF9C2fhDRJHXg"
        ]
    ];

    // execute the request
    $response = $client->get('https://api.unsplash.com/photos/random', $headers);

    // extract the response
    $response_injson = $response->getBody();

    // purge the client since we dont need it anymore
    unset($client);

    // parse the response into associative array
    $response_parsed = json_decode($response_injson);

    // initialize curl chanel using the image url
    $ch = curl_init($response_parsed->urls->regular);

    // set the headers
    $ch_headers = array(
        'Authorization: Client-ID 3wIOnMkmYfqggvtz_YugNp__OWeeC9vF9C2fhDRJHXg',
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $ch_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // execute the request.
    $result = curl_exec($ch);

    // close the connection
    curl_close($ch);

    // generate random name and upload location
    $post_image_randomname = md5(uniqid()) . '.jpg';
    define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/assets/images/{$path}/$post_image_randomname");

    // create the directory if the folder doesn't exists
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/assets/images/{$path}")) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/assets/images/{$path}");
    }

    // create a dummy jpg that will be overwr   itten
    $my_img = imagecreate(200, 80);
    imagejpeg($my_img, UPLOAD_LOCATION, 100);

    // overwrite into the file
    file_put_contents(
        UPLOAD_LOCATION,
        $result
    );

    return $post_image_randomname;
}
