<?php
$routes = [
    'refreshAccessToken',
    'cancelRequestedRide',
    'requestRide',
    'updateRideDestination',
    'checkDriverComeTiming',
    'getMySingleRide',
    'getMyRides',
    'getMe',
    'estimateRideCost',
    'getNearbyAvailableDrivers',
    'getRideTypes',
    'getAccessToken',
    'metadata'
];
foreach ($routes as $file) {
    require __DIR__ . '/../src/routes/' . $file . '.php';
}

