<?php
namespace Google\Cloud\Samples\Auth;
require 'vendor/autoload.php';

// Imports the Google Cloud Storage client library.
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\VideoIntelligence\V1\VideoIntelligenceServiceClient;


$projectId = 'petinline-64d57';
$serviceAccountPath = '../key/new-admin/petinline-64d57-firebase-adminsdk-f9hug-f3b5cd665b.json';

$config = [
    'keyFilePath' => $serviceAccountPath,
    'projectId' => $projectId,
];
$storage = new StorageClient($config);

# Make an authenticated API request (listing storage buckets)
foreach ($storage->buckets() as $bucket) {
    printf('Bucket: %s' . PHP_EOL, $bucket->name());
    echo "/n";
}
$db = new FirestoreClient([
    'projectId' => $projectId,
]);



// printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);