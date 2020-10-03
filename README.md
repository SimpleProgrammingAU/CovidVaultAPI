![CovidVault Logo](https://www.simpleprogramming.com.au/covid/files/logo-banner.png "CovidVault")

# CovidVaultAPI
The RESTful API that supports the CovidVault GUI.

## Endpoints
### Account
![Public GET Endpoint](https://img.shields.io/badge/Public-GET-green) https://root_address/account/[id](/ "Account ID")

Returns the following account properties
- `name` the business name
- `avatar` boolean value representing the presence of a logo in the database
- `selectAll` if a location has a conditions of entry checklist, permits the select all button
- `statements` an array of prompts for the conditions of entry checklist

![Authenticated GET Endpoint](https://img.shields.io/badge/Authenticated-GET-green) https://root_address/account/[id](/ "Account ID")

Returns the following account properties
- `name` the business name
- `logo` the stored logo filename (empty string if none available)
- `authContact` name of the person authorised to request customer data for contact tracing
- `phone` contact phone number for the authorised contact
- `streetAddress` street address of the venue
- `suburb` suburb / town
- `state` state / province
- `postcode` postal code
- `email` email address of the authorised contact
- `selectAll` if a location has a conditions of entry checklist, permits the select all button
- `statements` an array of prompts for the conditions of entry checklist

![Public POST Endpoint](https://img.shields.io/badge/Public-POST-orange) https://root_address/account

Creates a new venue account.

Accepts the following account properties:
- ![Required](https://img.shields.io/badge/-Required-red) `name`
- ![Required](https://img.shields.io/badge/-Required-red) `logo`
- ![Required](https://img.shields.io/badge/-Required-red) `authContact`
- ![Required](https://img.shields.io/badge/-Required-red) `phone`
- ![Required](https://img.shields.io/badge/-Required-red) `streetAddress`
- ![Required](https://img.shields.io/badge/-Required-red) `suburb`
- ![Required](https://img.shields.io/badge/-Required-red) `state`
- ![Required](https://img.shields.io/badge/-Required-red) `postcode`
- ![Required](https://img.shields.io/badge/-Required-red) `email`
Data must be entered in format `application/json`.

![Authenticated POST Endpoint](https://img.shields.io/badge/Authenticated-POST-orange) https://root_address/account/[id](/ "Account ID")

Permits the upload of a logo via the API. Accepts the following account properties:
- ![Required](https://img.shields.io/badge/-Required-red) `logo`

Data must be entered in format `multipart/form-data`.

![Authenticated DELETE Endpoint](https://img.shields.io/badge/Authenticated-DELETE-red) https://root_address/account/[id](/ "Account ID")

Deletes the account from the database.

### Entry
![Public POST Endpoint](https://img.shields.io/badge/Public-POST-orange) https://root_address/entry/[id](/ "Account ID")

Registers a visitor entry at a specified venue. Accepts the following visitor properties:
- ![Required](https://img.shields.io/badge/-Required-red) `name` visitor's name
- ![Required](https://img.shields.io/badge/-Required-red) `phone` visitor's phone number in the format +61XXXXXXXXX as a string

Data must be entered in format `application/json`.

Returns the following properties:
- `id` the unique identifier of the check-in entry

### Exit
![Public PATCH Endpoint](https://img.shields.io/badge/Public-PATCH-grey) https://root_address/exit/[id](/ "Entry ID")

Optional registration to check-out a previously entered visitor. Accepts the following visitor properties:
- ![Required](https://img.shields.io/badge/-Required-red) `id` the unique identifier of the check-in entry

### Session
![Public POST Endpoint](https://img.shields.io/badge/Public-POST-orange) https://root_address/session

Creates a user sign-on event for authentication. Accepts the following properties:
- ![Required](https://img.shields.io/badge/-Required-red) `username` contact email address
- ![Required](https://img.shields.io/badge/-Required-red) `password`

Returns the following properties:
- `accountID` the venue ID
- `sessionID` the session ID
- `accessToken` the private key to allow access to authenticated endpoints
- `accessExpiry` the date and time of access expiry
- `refreshToken` the private key to reestablish the session without signin
- `refreshExpiry` the date and time of the refresh token's expiry

![Authenticated PATCH Endpoint](https://img.shields.io/badge/Authenticated-PATCH-grey) https://root_address/session/[id](/ "Session ID")

Refreshes the access token. Accepts the following properties:
- ![Required](https://img.shields.io/badge/-Required-red) `refreshToken` the private key to reestablish the session without signin

Returns the following properties:
- `accountID` the venue ID
- `sessionID` the session ID
- `accessToken` the private key to allow access to authenticated endpoints
- `accessExpiry` the date and time of access expiry
- `refreshToken` the private key to reestablish the session without signin
- `refreshExpiry` the date and time of the refresh token's expiry

![Authenticated DELETE Endpoint](https://img.shields.io/badge/Authenticated-DELETE-red) https://root_address/session/[id](/ "Session ID")

Signs the user out and deletes access tokens from the database.

Returns the following properties:
- `sessionID` the session ID

### Statistics
![Authenticated GET Endpoint](https://img.shields.io/badge/Authenticated-GET-orange) https://root_address/statistics/[id](/ "Account ID")

Returns the following anonymised statistics:
- `byDay` the number of visitors by day of the week
- `byHour` the number of visitors by hour of the day
- `return` the percentage (as a number between 0 and 100) of visitors that appear more than once in the database
- `today` the number of visitors recorded today

## Authenticated Endpoints
To access authenticated endpoints, the query must be sent with the `Authorization` header set to a valid `accessToken`.