<?php
// File to store ping results
$file = 'ping_results.json';
$expirationTime = 60; // Results expire after 60 seconds (1 minute)

// Function to ping an IP address
function pingIP($ip) {
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return "Invalid IP address.";
    }

    $pingCmd = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? "ping -n 4 " : "ping -c 4 ";
    $escapedIp = escapeshellarg($ip);
    $command = $pingCmd . $escapedIp;

    $output = [];
    $return_var = 0;
    exec($command, $output, $return_var);

    return [
        'ip' => $ip,
        'status' => $return_var === 0 ? 'successful' : 'failed',
        'output' => implode("\n", $output)
    ];
}

// Function to ping the IPs and save the results with a timestamp to a file
function runPingAndSaveResults($file) {
    $ips = ['8.8.8.8', '1.1.1.1', '192.168.1.1', '10.19.20.30']; // Example IPs
    $results = [];

    foreach ($ips as $ip) {
        $results[] = pingIP($ip);
    }

    $dataToSave = [
        'timestamp' => time(),
        'results' => $results
    ];

    file_put_contents($file, json_encode($dataToSave, JSON_PRETTY_PRINT));
}

// Check if the file has expired
function isFileExpired($file, $expirationTime) {
    if (!file_exists($file)) {
        return true;
    }

    $fileContents = file_get_contents($file);
    $data = json_decode($fileContents, true);

    return (time() - $data['timestamp']) > $expirationTime;
}

// Respond to a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isFileExpired($file, $expirationTime)) {
        runPingAndSaveResults($file);
    }

    $fileContents = file_get_contents($file);
    echo $fileContents;  // Output JSON directly
}
?>
