## Epic Movie Quotes

Epic Movie Quotes is a bilingual application built using the React and Laravel frameworks. The application provides a platform for movie enthusiasts to register, authorize and upload their favorite quotes from various movies. Users can create an account, log in and add their own quotes or browse through the quotes posted by other users.

Upon logging in, users can view a feed of quotes uploaded by other users, with the ability to like and comment on their posts. Users can also view their own uploaded quotes and manage them from their account.

The application is designed with real-time notifications so that quote's author is notified immediately while her post is liked or commented on.

#

### Prerequisites

-   PHP@8.1 and up
-   MYSQL@8 and up\*
-   npm@8 and up\*
-   composer@2 and up\*

#

### Tech Stack

-   [Laravel@9.x](https://laravel.com/docs/9.x) - back-end framework
-   [Spatie Translatable](https://github.com/spatie/laravel-translatable) - package for translation

#

### Installation

1\. First of all you need to clone Coronatime repository from github:

```
git clone https://github.com/RedberryInternship/natali-epic-movie-quotes-back.git
```

2\. Next step requires you to run _composer install_ and _npm install_ in order to install all the dependencies.

```
composer install
```

```
npm install
```

and also:

```
npm run dev
```

3\. Now we need to set our env file. Go to the root of your project and execute this command.

```
cp .env.example .env
```

after setting up .env file, execute:

```
 php artisan config:cache
 php artisan key:generate
```

##### Now, you should be good to go!

#

### Migration

if you've completed getting started section, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

In order to run the dev script defined in the project’s package.json file use:

```sh
  npm run dev
```

### drawsql link:

https://drawsql.app/teams/test-957/diagrams/epic-movie-quotes