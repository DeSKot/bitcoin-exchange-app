# About Application

This app (in default) display information about Bitcoin Exchange rate to USD EUR GBP.
To add data about exchange rate we use command **import:bitcoin-exchange-rate** This is implemented in ***src/Command/ImportBitcoinExchangeRateCommand***<br>

And execute this command by **CRON** to see details check **Dockerfile**<br>
in default we execute this command each hour? but you can change this value in Dockerfile

We also have **Swagger** http://127.0.0.1:8020/api/doc

# Run project documentation
1. **git clone https://github.com/DeSKot/bitcoin-exchange-app.git**
2. **docker network create bitcoin-exchange-network**
3. **docker-compose up --build --force-recreate -d**
4. **docker exec -it bitcoin-exchange-app bash** open container
5. **composer install**
6. **php bin/console doctrine:migrations:migrate** - run migration to create require tables and add require data

To connect DB to you IDE or Client check docker-compose.yaml file and find ENV variables and check docker container

**docker ps** and check bitcoin-exchange-db container port. Example  0.0.0.0:49153(port which use on your local machine)->5432(port which using in container)/tcp