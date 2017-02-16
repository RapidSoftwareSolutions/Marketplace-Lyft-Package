<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');
class LyftTest extends BaseTestCase {

    public function testListMetrics() {

        $routes = [
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

        ];

        foreach($routes as $file) {
            $var = '{  
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/Lyft/'.$file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in '.$file.' method');
        }
    }

}
