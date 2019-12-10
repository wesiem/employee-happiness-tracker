# Employee Happiness Tracker
A simple web app that tracks employee happiness. It's also an introduction to Laravel and its cool features!

## Installation
1. Get a copy of this source code.
2. Create a database and give it a name.
3. Copy **.env.example** to **.env** and change the database settings (and more if you want to).
4. Run all database migrations by using the following command: `php artisan migrate`

**Now you should be able to see the homepage, but before you continue, make sure to keep reading this file!**

## Moods
An employee can share his/her mood which can be happy, unemotional or unhappy. The values are stored into the database as a fix set.

| id | name | emoji |
| -- | ---- | ----- |
| 1 | Happy | :-) |
| 2 | Unemotional | :-| |
| 3 | Unhappy | :-( |

You can import these values by using the following command:
`php artisan db:seed --class=MoodsTableSeeder`

## Votes
All votes are stored in the votes table.
In case you want to add some dummy votes to the database, all you have to do is use the following command:
`php artisan db:seed --class=VotesTableSeeder`
This command will add 1.000 random votes (random mood & random date between now and 2 months ago).

## Controllers
### HomeController:
    /
    
### VoteController:
    /votes
    /votes/new/{voteslug}
    /votes/thank-you

### StatisticsController
    /statistics
    /statistics/day
    /statistics/week
    /statistics/month
    
## ---
Wesiem Bouzaiane