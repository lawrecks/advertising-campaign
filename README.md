![](https://img.shields.io/badge/advertising-campaign-blueviolet)

# Advertising campaign

> A simple application for managing advertising campaigns.

## Built With

- Major languages (HTML, CSS, JavaScript, PHP)
- Frameworks (Laravel, Vue.js)
- Technologies used - Webpack(Code Bundling), Git(version control), Docker

## Clone this repository
 ``` git clone https://github.com/lawrecks/advertising-campaign.git ```

### Install
  -  [Git](https://git-scm.com/downloads)
  -  [Node](https://nodejs.org/en/download/)
  -  [Docker](https://docs.docker.com/get-docker/)

### Usage
  -  cd into the project folder
  -  Run ``` composer install ```
  -  Run ``` cp .env.example .env ```
  -  Run ``` php artisan key:generate ```
  -  Run ``` php artisan serve ```

### Pull and run docker image
To pull the docker image
  -  Run ``` docker pull lawrecks/advertising-campaign ```
  -  Run ``` docker images ``` to confirm successful pull
  -  Run ``` docker run -p 8090:8090 -d lawrecks/advertising-campaign ```
