[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Lyft/functions?utm_source=RapidAPIGitHub_LyftFunctions&utm_medium=button&utm_content=RapidAPI_GitHub) 
# Lyft Package
Shipping
* Domain: lyft.com
* Credentials: clientId, clientSecret

## How to get credentials: 
0. Go to [Lyft website](https://www.lyft.com) 
1. Log in or create a new account
2. Register an application
3. Go to [Application page](ttps://www.lyft.com/developers/manage) to get your client Id and client Secret


## Lyft.getAccessToken
Creates a new address object

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id obtained from Lyft.
| clientSecret| credentials| The client secret obtained from Lyft.
| redirectUri | String     | Your redirect URI
| code        | String     | Code from the user.

## Lyft.refreshAccessToken
Creates a new address object

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id obtained from Lyft.
| clientSecret| credentials| The client secret obtained from Lyft.
| refreshToken| String     | Refresh token received previously

## Lyft.getRideTypes
Returns information about what kinds of Lyft rides you can request at a given location.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access Token received from Lyft
| userLatitude | String| The user’s current latitude
| userLongitude| String| The user’s current longitude
| rideTypes    | Array | Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_suv'

## Lyft.getNearbyAvailableDrivers
Returns the location of drivers near a location.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access Token received from Lyft
| userLatitude | String| The user’s current latitude
| userLongitude| String| The user’s current longitude

## Lyft.estimateRideCost
Returns the estimated cost, distance, and duration of a ride between a start location and end location.

| Field                | Type  | Description
|----------------------|-------|----------
| accessToken          | String| Access Token received from Lyft
| userStartingLatitude | String| The user’s starting latitude
| userStartingLongitude| String| The user’s starting longitude
| userEndingLatitude   | String| The user’s ending latitude
| userEndingLongitude  | String| The user’s ending longitude
| rideTypes            | Array | Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_suv'

## Lyft.getMe
Returns the authenticated user's ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft

## Lyft.getMyRides
Returns list of user rides.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| startTime  | String| Restrict to rides starting after this point in time. The earliest supported date is 2015-01-01T00:00:00Z
| endTime    | String| Restrict to rides starting before this point in time. The earliest supported date is 2015-01-01T00:00:00Z
| limit      | Number| The maximum number of rides to return. The default limit is 10 if not specified. The maximum possible value is 50.

## Lyft.getMySingleRide
Returns single ride from the list of user rides.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| rideId     | String| Id of the ride

## Lyft.checkDriverComeTiming
Returns the estimated time in seconds it will take for the nearest driver to reach the specified location.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access Token received from Lyft
| userLatitude | String| The user’s current latitude
| userLongitude| String| The user’s current longitude
| rideTypes    | Array | Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_suv'

## Lyft.requestRide
Allows your application to request a ride on behalf of the user. The user's payment credentials on file will be charged for the ride.

| Field                     | Type  | Description
|---------------------------|-------|----------
| accessToken               | String| Access Token received from Lyft
| userLatitude              | String| The user’s current latitude
| userLongitude             | String| The user’s current longitude
| destinationLatitude       | String| Destination latitude
| destinationLongitude      | String| Destination longitude
| rideTypes                 | Array | Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_suv'
| primetimeConfirmationToken| String| Prime Time confirmation token

## Lyft.cancelRequestedRide
Allows your application to cancel the specified ride.

| Field                  | Type  | Description
|------------------------|-------|----------
| accessToken            | String| Access Token received from Lyft
| rideId                 | String| Id of the ride
| cancelConfirmationToken| String| Cancel confirmation token

## Lyft.updateRideDestination
Updates destination of the ride. Note that the ride state must still be active (not droppedOff or canceled), and that destinations on Lyft Line rides cannot be changed.

| Field                  | Type  | Description
|------------------------|-------|----------
| accessToken            | String| Access Token received from Lyft
| newDestinationLatitude | String| New destination latitude
| newDestinationLongitude| String| New longitude
| rideId                 | String| Id of the ride
| newDestinationAddress  | String| Display address at/near the given location

