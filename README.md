

# Employee Happiness Tracker
A simple web app that tracks employee happiness. It's also an introduction to Laravel and its cool features!

## Functionality
Company WeAreHappy wants to have an idea of the happiness of its employees. In order to do so, they need a system to capture that happiness anonymously. 

When going home from a hard day's work, each employee can indicate how their day was. There are 3 moods:
`:-)` `:-|` `:-(`

The "vote" is stored anonymously in persistent storage on the back-end.

## Use cases
- An employee casts a vote anonymously
- The manager views the statistics
  - of the current day
  - of the current week
  - of the current month

## Installation
1. Get a copy of this source code.
2. Create a database and give it a name.
3. Copy **.env.example** to **.env** and change the database settings (and more if you want to).
4. Run all database migrations by using the following command: 
`php artisan migrate`
5. Run the application with:
`php artisan serve`

Now you should be able to see the homepage, but before you continue, make sure to keep reading this file for further installation!

## Moods
An employee can share his/her mood which can be happy, unemotional or unhappy. These values are stored into the database as a fix set.

| id | name | emoji |
| -- | ---- | ----- |
| 1 | Happy | :-) |
| 2 | Unemotional | :-\| |
| 3 | Unhappy | :-( |

You can import these values by using the following command:
`php artisan db:seed --class=MoodsTableSeeder`

## Votes
All votes are stored anonymously in the votes table.

In case you want to add some dummy votes to the database, all you have to do is use the following command:
`php artisan db:seed --class=VotesTableSeeder`

This command will add 1.000 random votes with a random mood and a random date between now and 2 months ago to the votes table.

### VoteController:
The votes are managed by the VoteController, which makes it possible to submit new votes and display the thank you page after submission.

    /votes/new/{voteSlug}
    /votes/thank-you

>**Note:** Voting has to be done from the homepage (HomeController): `/`

## Authentication
The voting can be done completely anonymous. If you want to be able to do more (in this case viewing statistics), you will need to be authenticated. 

For now you can simply do that by clicking on the `Register` button on the top right of the homepage.

After registration you should be able to view the statistics.

## Statistics
As an administrator you can get access to the statistics of the votes for the current day, week and month.

Make sure you have an account and you are logged in, then go to the homepage and hit the `Statistics` button.

On this page you're able to select the statistics view. You can also use the quick-nav to quickly change the view.

### StatisticsController
    /statistics
    /statistics/day
    /statistics/week
    /statistics/month

## API
### Submitting a new vote

Votes can be submitted anonymously via the API by using the following endpoint:
`/api/votes/new`

Now, to be able to send a valid vote, you need to let the API know what the mood of the employee is. This can be done by requesting a list of al moods with the following endpoint:
`/api/moods`

> **Note:** You can also retrieve the information of a single mood via: 
> `/api/moods/{id}`

### Authentication
To retrieve sensitive data via the API it is recommended to only give access to those who are allowed to view this information. That's why the statistics can only be retrieved if the user is being authenticated.

This authentication happens in a very basic way by using an API Token which can be found on the `/statistics` page of the web app next to the `YOUR API TOKEN` input field.

Whenever you want to get access to the statistics, you'll need to give up your personal API Token.

| Key | Value |
| --------- | ------------------ |
| api_token | **YOUR API TOKEN** |

### Retrieving Statistics

You can retrieve the statistics data of the current day, week or month via the following endpoints:
  
    /api/statistics/day
    /api/statistics/week
    /api/statistics/month

> **Note:** Make sure you are authenticated by providing your API Token.