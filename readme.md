To use this repo you need to have docker installed in your system.

1. Clone or download;
2. At root copy `.env.example` to `.env`;
3. Go to `docker-enviroment` directory;
4. Copy `env-example` to `.env` and edit parameter `DOCKER_HOST_IP` to your Docker host IP;
5. Execute `docker-compose build`;
6. To run docker containers exec `docker-compose up -d`;

Next, it's needed to setup Laravel database:
  
7. Connect to workspace container: `docker exec -it dockerenviroment_workspace_1 bash`;
8. From inside container run `php artisan migrate && php artisan db:seed`;

To test functionality, run artisan command `balance:transfer` with parameters: 
```
--sum=<transfer amount>
--from=<Source User ID>,
--to=<Destination User ID>
```

  For example: `php artisan balance:transfer --sum=10 --from=1 --to=2`

After completing transfer, appropriate record will appear in the laravel log in `storage/logs`  
