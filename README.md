# Laravel 8 API Example

This is example of APIs written in Laravel 8 and using Laravel Passport for OAuth2 authentication and authorization. This project uses an externa API to get stock quotes and the built-in Laravel notification system. There is also a Postman file to see and test all endpoints.

## Installation

Here are the steps to get this project up and running.

1. Clone the repository
2. Run `composer install`
3. `cd` into the directory the repo was cloned into
4. `cp .env.example .env` to create environment file.
5. Edit `.env` file adding you database connection into. Make sure the database has been created and is empty.
6. Migrate the database by running `php artisan migrate`
7. Generate encryption keys for OAuth2 by running `php artisan passport:keys`
8. Generate application key by running `php artisan key:generate`
9. Create client credentials in passport `php artisan passport:client --password` Use these to obtain a token to use the api.

The application is now installed and ready to go!

## Getting Started

1. In the root of the project run `php artisan serve` to run the server
2. Load the postman file into postman and use the API to create a user.
3. Login using the client ID and client secret from step 9 above and the user's email and password. Once you have a token a token you can use it for subsequent requests. Under authentication in the Postman collection you can obtain and save the token.

Enjoy using the API!

## API Documentation

### Create User

**POST** `api/users`

Parameters

`name` The user's full name  
`email` The user's email  
`password` The user's password  
`password_confirmation` Confirmation of the password  

### Login

**POST** `oauth/token`

Parameters

`grant_type = 'password'` User 'password' as the value for this field  
`client_id` Client id received in step 9 of installation  
`client_secret` Client secret received in step 9 of installation  
`username` User's email address  
`password` User's password  
`scope` Leave this value blank  

This will return a token for you to use to as all endpoints

### User Info

**GET** `users`

Will get info for logged in user.

**GET** `api/stock/:symbol/:price`

Path Parameters

`symbol` The symbol of the stock to lookup  
`price` The price you bought the stock at

This will get the current price and volume for the stock and create a notification telling you how much you've gained or lost.

### Get Notifications

**GET** `api/notifications`

Get all notifications for the logged in user.

### Creat Notification

**POST** `api/notifications`

Parameters

`message` The message for the notification

### Update Notification

**PUT** `api/notifications/:id`

Path Parameters

`id` The id of the notification to update

Parameters

`message` The new message to replace the old one

### Delete Notification

**DELETE** `api/notifications/:id`

Path Parameters

`id` The id of the notification to delete

### Mark Notification Read

**PUT** `api/notifications/:id/read`

Path Parameters

`id` The id of the notification to mark as read

### Mark Notification Unread

**PUT** `api/notifications/:id/unread`

Path Parameters

`id` The id of the notification to mark as unread 