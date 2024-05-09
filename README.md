# About Application

This app (in default) display information about Bitcoin Exchange rate to USD EUR GBP.
To add data about exchange rate we use command **import:bitcoin-exchange-rate** This is implemented in ***src/Command/ImportBitcoinExchangeRateCommand***<br>

And execute this command by **CRON** to see details check **Dockerfile**<br>
in default we execute this command each hour? but you can change this value in Dockerfile

We also have **Swagger** http://127.0.0.1:8020/api/doc

# Run project documentation
1. **docker network create bitcoin-exchange-network**
2. **docker-compose up --build --force-recreate -d**
3. **docker ps** and check bitcoin-exchange-db container port. Example  0.0.0.0:49153(port which use on your local machine)->5432(port which using in container)/tcp
4. **php bin/console doctrine:migrations:migrate** - run migration to create require tables and add require data
5. config our cron command by docker/cron/crontab-script