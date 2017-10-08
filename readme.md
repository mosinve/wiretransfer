To use this repo you need to have docker installed in your system.

1. Clone or download
2. Go to `docker-enviroment` directory and execute `docker-compose build`
3. To run docker containers exec `docker-compose up -d`

Next, it's needed to setup Laravel database:
  
4. connect to workspace container: `docker exec -it dockerenviroment_workspace_1 bash`
5. from inside container run `php artisan migrate && php artisan db:seed`

To test functionality, run artisan command `balance:transfer` with parameters: 
```
--sum=<transfer amount>
--from=<Source User ID>,
--to=<Destination User ID>
```

  For example: `php artisan balance:transfer --sum=10 --from=1 --to=2`

After completing transfer, appropriate record will appear in the laravel log in `storage/logs`  