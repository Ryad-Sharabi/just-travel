<?php
// whitelist لمسارات آمنة
$path = $_GET['p'] ?? '';
if (!preg_match('#^(profile_images|hotels|cars)/[A-Za-z0-9_\-\/\.]+$#', $path)) {
    http_response_code(400); exit('Bad path');
}

$remote = "https://admin.justtravel.pro/storage/" . $path;
$ch = curl_init($remote);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_SSL_VERIFYPEER => true,
]);
$img = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$ctype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: 'image/jpeg';
curl_close($ch);

if ($code === 200 && $img) {
  header('Content-Type: '.$ctype);
  header('Cache-Control: public, max-age=86400');
  header('Access-Control-Allow-Origin: *');
  echo $img;
} else {
  http_response_code(404);
}
