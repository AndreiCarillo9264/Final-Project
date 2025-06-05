<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

if (isset($_GET['reset'])) {
    unset($_SESSION['access_token']);
}

require '../../vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('https://127.0.0.1/ProdTrack/backend/api/oauth-callback.php');
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $_SESSION['access_token'] = $token;
    } else {
        die('Error fetching access token: ' . $token['error']);
    }
}

header("Location: https://127.0.0.1/ProdTrack/backend/api/export-to-sheet.php");
exit;
?>