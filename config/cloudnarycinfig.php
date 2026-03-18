<?php
function uploadToCloudnary($fileTmpPath){

    $cloudName = "dd9xgs1tz";

    $url = "https://api.cloudinary.com/v1_1/$cloudName/image/upload";

    $data = [
        'file' => new CURLFile($fileTmpPath), 
        'upload_preset' => 'poiuytrewq'
    ];

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
        exit;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['secure_url'])) {
        echo "Cloudinary Upload Failed<br>";
        echo "<pre>";
        print_r($result);
        exit;
    }

    return $result['secure_url'];

}