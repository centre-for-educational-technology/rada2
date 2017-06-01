# Toolset
Gaming platform for SmartZoos project

The main objective of the current project is to integrate the zoos of the CB region into joint tourist attraction through developing and implementing a cross-border service package for creative adventure learning. It consists of a set of creative online multimedia game-based learning tools and related apps for mobile devices.

This tool set includes:
- an online tool for creating at least four types of location-based interactive assignments relevant for Zoo settings (triggered either by a QR code or GPS-based proximity): augmented reality assignments; quizzes; crossword and memory puzzles; video and photo story telling assignments;
- an online repository of interactive assignments;
- an online environment (Web platform + mobile clients) for composing and conducting location-based GPS adventure games, challenges and tournaments that utilise all these different types of interactive assignments. The platform uses Mozilla Open Badges framework for awarding the achievements of players.

## Installation
- Make sure that [composer](https://getcomposer.org/) is installed globally or install it in place
- Clone the repository
  - Please make sure to switch to **production** branch if you are running on production server
  - In case of development instance, please make sure to build the static assets. Refer to [working with compiled assets](#working-with-compiled-assets) for more information
- Move into the directory (**cd SmartZoos**)
- Install the dependencies **composer install**
- Make sure that .env file is present and configured as needed (copy .env.example to .env and fill in with data)
  - Either create application key manually or do that with a command **php artisan key:generate**
  - Make sure that **APP_ENV=production** and **APP_DEBUG=false** for production environments (this should prevent unneeded error detailed data exposure)
  - Create and configure Google and Facebook apps, fill the needed environment variables
    - Please make sure to activate the **Google Maps JavaScript API**, **Google Static Maps API** and **Google+ API**, create the API key for Maps and OAuth credentials
    - Please make sure that Facebook App is set to **public** mode
    - The redirect URL addresses are in the form **BASE-URL/auth/PROVIDER-name/callback**
  - Create reCaptcha(V2) keys and fill in the configurations in **.env** file. Constants to look for are **NOCAPTCHA_SECRET** and **NOCAPTCHA_SITEKEY**
  - Create and configure Google Analytics and UserReport services. Configuration constant names are **GOOGLE_ANALYTICS_KEY** and **USERREPORT_KEY**
- Configure subject and title from sent email messages
 - Open the **config/mail.php** file and set the needed values within the **from** element
- Create the database as needed (according to configuration provided)
- Run **php artisan migrate** from terminal (this should create database and more)
  - Running **php artisan serve** would serve the app in development (or configure the server of your choice)
- Run **php artisan db:seed** to ensure that database is filled with required information
- Add private and public keys to the **storage/app/keys** directory (key length might be different)
```
openssl genrsa -out private-key.pem 2048
openssl rsa -in private-key.pem -out public-key.pem -outform PEM -pubout
```

## Development

**NB! Please note that non-production branch does not have the built assets provided**

### Working with compiled assets
Working with JS and SASS requires [Node.js](https://nodejs.org) and [Gulp](http://gulpjs.com/) or compilation, generation and management purposes.
More information could be found on [Laravel Elixir](https://laravel.com/docs/5.3/elixir) documentation pages.

If all the dependencies are installed, then one would only need to run one of the tasks:

 - **gulp** would run all tasks
 - **gulp --production** would run  all tasks and enforce minification and uglification
 - **gulp watch** would run the tasks and keep watching for changes (CTRL + C to cancel the task in terminal)

 ## Localization

All translations are placed under **ROOT/resources/lang/LANGUAGE**, where **LANGUAGE** is one of the following **en**, **et**, **ru**, **fi**, **swe**.

I order to create a new translation, please copy all the files from **ROOT/resources/lang/en** to newly created directory.

Please note that files for different translations should be synchronized, meaning, new translations should be added to all of these files and translated right away.

NB! While translating textual strings please make sure not to remove the replacement parts. Each replacement part could be identified buy having a colon in front of the word: Example: **User :name has logged in.**, the **:name** is a placeholder that will be substituted with some value and should be left as is in all translations.

## Production

If you need to be running in production mode, then please use the branch named **production** instead of **master**. That branch might not have all the latest changes, but it should have the JS and CSS assets built for running in production (minified and more).
