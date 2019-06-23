# Amazon Marketplace Web Services (PHP)

## Please README
This is just an experiment. In the last year I've worked on few new projects
related to "Amazon Marketplace Web Service" and I've found lot of confusion about feed's submission process.
Online you can find lot of examples and libraries that can helps in the process of submitting
product to the amazon marketplace. But no one of these products helped me reaching my goals because
most of them use the old CSV file submitting process and I don't like that. 

## What this project aims to do?
Is just a workbench, a repository that you can clone and use with docker to made your own
experiments using amazon marketplace web services. I've mapped few products required by
myself, if you want, you can help me doing the same for remaining products (they are too much).

## Help me.
I've not much time to dedicate to this project, I hope you enjoy it and, if you want, you can
help me too finishing what I've started: complete the list of products to map.

# Let's start
This project uses docker. To start using it clone the repo and write following command:

- Open your svchost file and add new line: mws.local 127.0.0.1
- exec `docker-compose up` in the root directory to get it run!

# Config
You have to configure simulation environment to get your tests working. To do that:
- Edit app/AmazonMarketplace/Program.template.php, insert your reseller dev account settings and save it as Program.php
- Edit simulate.template.php inserting the same data mentioned before and save it as simulate.php 

After that you will have two endpoint usable to make your own tests:
- http://localhost:8880/simulate.php: you can edit the content of this page to make your own experiments, simulate uses a JSON queue to handle all requests related to product submissions.
- http://localhost:8880/AmazonMarketplace/Program.php: you can make your own tests based on what I've made in the app/AmazonMarketplace/Tests folder. I've covered what I need for my pourpose. 

Please, the best documentation I can provide is my code. Hope this can help. 


## Create Product

## Update Price

## Update Inventory

## Update Images

## Create Variations (Relationships too)