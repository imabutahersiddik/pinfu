<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['files'])) {
    $files = $_FILES['files'];
    $uploadedFiles = [];
    
    // Check for upload errors
    foreach ($files['error'] as $error) {
        if ($error !== UPLOAD_ERR_OK) {
            die("Upload failed with error code " . $error);
        }
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
        // Loop through each file and upload
        foreach ($files['tmp_name'] as $index => $tmpName) {
            // Get the original filename
            $originalFileName = $files['name'][$index];

            // Calculate SHA-256 hash
            $sha256Hash = hash_file('sha256', $tmpName);

            // Upload file to Pinata
            $response = $client->request('POST', 'https://api.pinata.cloud/pinning/pinFileToIPFS', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $jwt,
                    'pinata_api_key' => $apiKey,
                    'pinata_secret_api_key' => $apiSecret,
                ],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($tmpName, 'r'),
                        'filename' => $originalFileName
                    ]
                ]
            ]);

            // Decode the response
$responseBody = json_decode($response->getBody(), true);
$ipfsHash = $responseBody['IpfsHash']; // Your logic to get IPFS hash

// Get current date and time
$currentDate = date("Y-m-d H:i:s");

// Assuming you have access to the original file name and size
$originalFileName = $_FILES['files']['name'][$index]; // Adjust index as necessary
$fileSize = $_FILES['files']['size'][$index]; // Get the size of the uploaded file

// Store uploaded file information
$uploadedFiles[] = [
    "success" => true,
    "ipfsHash" => $ipfsHash,
    "fileName" => $originalFileName,
    "sha256Hash" => $sha256Hash,
    "uploadDate" => $currentDate,
    "fileSize" => $fileSize // Add file size here
];
        }

        // Return all uploaded files information as a JSON response
        echo json_encode($uploadedFiles);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Error uploading files: " . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "No files uploaded."]);
}
?>