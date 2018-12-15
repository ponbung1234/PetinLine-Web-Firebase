<?php
// require_once('Navbar.php');
require_once('firestore/connect.php');

$citiesRef = $db->collection('cities');
$query = $citiesRef->where('state', '=', 'CA');
$snapshot = $query->documents();
foreach ($snapshot as $document) {
    printf('Document %s returned by query state=CA' . PHP_EOL, $document->id());
    $name = $document->id();
}
echo $name;
?>
