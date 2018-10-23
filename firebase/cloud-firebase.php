<?php


require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase;


$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../firebase-key/petinlinever1-adaff558f03f.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();
