# Fiverr Helper - Hackathon Fiverr x Wild Code School

![Wild Code School](https://wildcodeschool.fr/wp-content/uploads/2019/01/logo_pink_176x60.png) ![Fiverr](https://i.imgur.com/ReJfyzR.png)

This is a Web App developed in 48h, for the Fiverr x Wild Code School Hackathon.

To use this app, you have to follow instructions below.

##### 🏆 We finished at the first place in the regional hackathon.
##### 🥈 We finished at the second place in the national hackathon.

## Developers

[Lochlainn GADAULT](https://github.com/glochlainn)
[Maël CHARIAULT](https://github.com/bouboumael)
[Tennessee HOURY](https://github.com/RedPandore)
[Loïc PINGUET](https://github.com/Loic-Code)

## Getting Started

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`
4. Run `yarn encore dev` to build assets

### Environnement

1. Copy `.env` and paste with file name `.env.local`
2. Change the line `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0"` with your MySQL informations
3. Run `symfony d:d:c`
4. Run `symfony d:m:m`
5. Run `symfony d:f:l`

### Working

1. Run `symfony server:start` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets
