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
- Move into the directory (**cd SmartZoos**)
- Install the dependencies **composer install**
- Make sure that .env file is present and configured as needed (copy .env.example to .env and fill in with data)
- Create the database as needed (according to configuration provided)
- Run **php artisan migrate** from terminal (this should create database and more)
  - Running **php artisan serve** would serve the app in development (or configure the server of your choice)
