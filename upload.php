<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code " . $file['error']);
    }

    // Retrieve keys from POST data
    $apiKey = $_POST['apiKey'];
    $apiSecret = $_POST['apiSecret'];
    $jwt = $_POST['jwt'];

    // Ensure all keys are provided
    if (empty($apiKey) || empty($apiSecret) || empty($jwt)) {
        die("API Key, API Secret, and JWT must be provided.");
    }

    $client = new Client();
    
    try {
        $response = $client->request('POST', 'https://api.pinata.cloud/pinning/pinFileToIPFS', [
            'headers' => [
                'Authorization' => 'Bearer ' . $jwt,
                'pinata_api_key' => $apiKey,
                'pinata_secret_api_key' => $apiSecret,
            ],
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($file['tmp_name'], 'r'),
                    'filename' => $file['name']
                ]
            ]
        ]);

        // Decode the response
        $responseBody = json_decode($response->getBody(), true);
        
// Assuming you have your upload logic here
$originalFileName = $_FILES['file']['name']; // Get the original filename
$fileTmpPath = $_FILES['file']['tmp_name']; // Temporary file path
// Calculate SHA-256 hash
$sha256Hash = hash_file('sha256', $fileTmpPath);
$ipfsHash = $responseBody['IpfsHash']; // Your logic to get IPFS hash
// Get current date and time
$currentDate = date("Y-m-d H:i:s");

        // Store IPFS Hash in local storage
        echo json_encode([
    "success" => true,
    "ipfsHash" => $ipfsHash,
    "fileName" => $originalFileName, // Return the original filename
    "sha256Hash" => $sha256Hash, // Return SHA-256 hash
    "uploadDate" => $currentDate // Return upload date
]);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Error uploading file: " . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "No file uploaded."]);
}
?>