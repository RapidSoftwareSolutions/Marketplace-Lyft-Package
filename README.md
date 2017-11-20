[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Lyft/functions?utm_source=RapidAPIGitHub_LyftFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Lyft Package
Lyft's API enables developers to programmatically interact with Lyft's rider and driver network, enabling them to transport their customers with a smile.
* Domain: [Lyft](http://lyft.com)
* Credentials: clientId, clientSecret

## How to get credentials: 
0. Go to [Lyft website](https://www.lyft.com) 
1. Log in or create a new account
2. Register an application
3. Go to [Application page](https://www.lyft.com/developers/manage) to get your client Id and client Secret


## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## Lyft.getAccessToken
Get accessToken

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id obtained from Lyft.
| clientSecret| credentials| The client secret obtained from Lyft.
| redirectUri | String     | Your redirect URI
| code        | String     | Code from the user.

## Lyft.refreshAccessToken
Refresh existing accessToken

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client id obtained from Lyft.
| clientSecret| credentials| The client secret obtained from Lyft.
| refreshToken| String     | Refresh token received previously

## Lyft.getRideTypes
Returns information about what kinds of Lyft rides you can request at a given location.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| coordinate | Map   | The user’s current latitude and longitude coma separated
| rideTypes  | Select| Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_premier', 'lyft_lux', 'lyft_luxsuv' 

## Lyft.getNearbyAvailableDrivers
Returns the location of drivers near a location.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| coordinate | Map   | The user’s current latitude and longitude coma separated

## Lyft.estimateRideCost
Returns the estimated cost, distance, and duration of a ride between a start location and end location.

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Access Token received from Lyft
| startCoordinate| Map   | The user’s starting latitude and logintude coma separated
| endCoordinate  | Map   | The user’s ending latitude and logintude coma separated
| rideTypes      | Select| Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_premier', 'lyft_lux', 'lyft_luxsuv' 

## Lyft.getMe
Returns the authenticated user's ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft

## Lyft.getMyRides
Returns list of user rides.

| Field      | Type      | Description
|------------|-----------|----------
| accessToken| String    | Access Token received from Lyft
| startTime  | DatePicker| Restrict to rides starting after this point in time. The earliest supported date is 2015-01-01T00:00:00Z
| endTime    | DatePicker| Restrict to rides starting before this point in time. The earliest supported date is 2015-01-01T00:00:00Z
| limit      | Number    | The maximum number of rides to return. The default limit is 10 if not specified. The maximum possible value is 50.

## Lyft.getMySingleRide
Returns single ride from the list of user rides.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| rideId     | String| Id of the ride

## Lyft.checkDriverComeTiming
Returns the estimated time in seconds it will take for the nearest driver to reach the specified location.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token received from Lyft
| coordinate | Map   | The user’s current latitude nad longitude coma separated
| rideTypes  | Select| Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_premier', 'lyft_lux', 'lyft_luxsuv' 

## Lyft.requestRide
Allows your application to request a ride on behalf of the user. The user's payment credentials on file will be charged for the ride.

| Field                     | Type  | Description
|---------------------------|-------|----------
| accessToken               | String| Access Token received from Lyft
| startCoordinate           | Map   | The user’s current latitude and longitude coma separated
| destinationCoordinate     | Map   | Destination latitude and longitude coma separated
| rideTypes                 | Select| Requested types of ride. Possible values: 'lyft', 'lyft_line', 'lyft_plus', 'lyft_premier', 'lyft_lux', 'lyft_luxsuv' 
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

| Field                | Type  | Description
|----------------------|-------|----------
| accessToken          | String| Access Token received from Lyft
| newCoordinate        | Map   | New destination latitude nad longitude coma separated
| rideId               | String| Id of the ride
| newDestinationAddress| String| Display address at/near the given location

