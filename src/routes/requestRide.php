<?php
$app->post('/api/Lyft/requestRide', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'userLatitude', 'userLongitude']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] ."sandbox/rides";


    $body['origin']['lat'] = $post_data['args']['userLatitude'];
    $body['origin']['lng'] = $post_data['args']['userLongitude'];

    if (isset($post_data['args']['destinationLatitude']) && strlen($post_data['args']['destinationLatitude'])>0) {
        $body['destination']['lat'] = $post_data['args']['destinationLatitude'];
    };
    if (isset($post_data['args']['destinationLongitude']) && strlen($post_data['args']['destinationLongitude'])>0) {
        $body['destination']['lng'] = $post_data['args']['destinationLongitude'];
    };

    if (isset($post_data['args']['rideTypes']) && strlen($post_data['args']['rideTypes'])>0) {
        $body['ride_type'] = $post_data['args']['rideTypes'];
    };

    if (isset($post_data['args']['primetimeConfirmationToken']) && strlen($post_data['args']['primetimeConfirmationToken'])>0) {
        $body['primetime_confirmation_token'] = $post_data['args']['primetimeConfirmationToken'];
    };


    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('POST', $query_str, [
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