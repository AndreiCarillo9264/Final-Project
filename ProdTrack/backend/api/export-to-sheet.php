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
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$client->setRedirectUri('https://127.0.0.1/ProdTrack/backend/api/oauth-callback.php');
$client->setAccessType('offline');
$client->setApprovalPrompt('force');

if (!isset($_SESSION['access_token'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->setAccessToken($_SESSION['access_token']);
    createAndPopulateSheet($client);
}
?>

<?php
function createAndPopulateSheet($client) {
    $service = new Google_Service_Sheets($client);
    $spreadsheet = new Google_Service_Sheets_Spreadsheet([
        'properties' => [
            'title' => 'Production Report - ' . date('Y-m-d')
        ]
    ]);

    $spreadsheet = $service->spreadsheets->create($spreadsheet);
    $spreadsheetId = $spreadsheet->spreadsheetId;

    require "../config/connection.php";
    $result = $connection->query("SELECT week, units_produced, units_target FROM production_reports ORDER BY week ASC");

    $values = [['Week', 'Units Produced', 'Target']];
    while ($row = $result->fetch_assoc()) {
        $values[] = [$row['week'], $row['units_produced'], $row['units_target']];
    }

    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    $range = 'Sheet1';
    $valueInputOption = 'RAW';

    $service->spreadsheets_values->update($spreadsheetId, $range, $body, [
        'valueInputOption' => $valueInputOption
    ]);

    $url = "https://docs.google.com/spreadsheets/d/"  . $spreadsheetId;
    echo "<script>window.open('$url', '_blank');</script>";
}
?>