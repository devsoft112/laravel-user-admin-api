## Everli interview exercise
Hey!

First, thanks for your time, and congrats on having made this further in the interview process.
In this exercise, you will be asked to create a Laravel application and implement a simple feature.

There will be no frontend on this task, just take it as an API server.

We encourage candidates to make assumptions and to be autonomous in solving the task as long as it is explained and documented.

#### The stack

If you are uncomfortable solving this task in PHP, feel free to reach the same solution with the language you prefer and the framework you feel most comfortable with.
Our stack mainly focuses on PHP and Typescript but we want to evaluate your approach to a problem rather than the syntax itself.

##### The feature

A Laravel application with 2 endpoints to manage users.

We don't expect you to implement authentication and authorization.

#### Requirements 
- The default database is MySQL but feel free to change to one you are more comfortable with
- Each user should have a unique email and a name
- The user can be either verified or not
- All endpoints should return JSON
- A README file with the instructions to run the app

#### Seeding
Engineers need to seed the database regularly, they expect the seed to create 100k users, a mix of verified and unverified users.
The performance of the seeder matters.

#### Register a user
Implement an endpoint `POST /user` 
- The user should receive an email upon registration to verify the mail
- This endpoint will be called roughly 20k times per minute during spike times, e.g. marketing campaign
- To send the email you should use the `App\Services\MailService::verifyUser`, do not bother to set up a mail client

#### Retrieve users
Implement an endpoint `GET /users` to retrieve users
- Users can be filtered by verification status
- Users are ordered by name by default

## How to run the existing application

You will need the following installed:

- PHP >= 8.3

### To start the server

- Run `php artisan migrate` to setup database
- Run `php artisan serve` to start the server

## What to do after
1. You can create a README section to explain your implementation details
2. Open a PR on the repo and send a link to the HR email of reference
3. Send any feedback you feel sharing about the exercise
