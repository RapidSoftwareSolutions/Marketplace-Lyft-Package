<?php
$app->post('/api/Lyft/updateRideDestination', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'rideId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . "rides/" . $post_data['args']['rideId'] . '/destination';

    if (isset($post_data['args']['newCoordinate'])) {

        $body['lat'] = explode(',', $post_data['args']['newCoordinate'])[0];
        $body['lng'] = explode(',', $post_data['args']['newCoordinate'])[1];

    } else {
        $body['lat'] = $post_data['args']['newDestinationLatitude'];
        $body['lng'] = $post_data['args']['newDestinationLongitude'];
    }

    if (isset($post_data['args']['newDestinationAddress']) && strlen($post_data['args']['newDestinationAddress']) > 0) {
        $body['address'] = $post_data['args']['newDestinationAddress'];
    };

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('PUT', $query_str, [
            'headers' => ['Authorization' => 'Bearer ' . $post_data['args']['accessToken']],
            'json' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});