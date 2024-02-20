# JUGADA AFA Cron setup:
```bash
* * * * * $HOME/public_html/bin/cake start_trivias > /dev/null
* * * * * $HOME/public_html/bin/cake start_programed_trivias
* * * * * $HOME/public_html/bin/cake next_soon_trivia > /dev/null
```

# Nginx setup:
```bash
server {
    listen      80;
    server_name jugadaafa.com www.jugadaafa.com jugadaafa.mocla.us;
    rewrite_log on;
    root        /home/jugadaafa/public_html/webroot;
    index       index.php index.html index.htm;
    #client_max_body_size 250m;
    #send_timeout 240;
    #fastcgi_read_timeout 240;
    location /wss {
        proxy_pass http://websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection $connection_upgrade;
   }
    location /soc {
        proxy_pass http://websocket_node;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection $connection_upgrade;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
   }
location / {
        if (-f $request_filename) {
          access_log        off;
            expires           0;
            add_header        Cache-Control private;
            break;
        }
            if (!-e $request_filename) {
                rewrite ^/(.+)$ /index.php?/$1 last;
                break;
            }
```

/etc/nginx/conf.d/websocket.conf
=========
```bash

    map $http_upgrade $connection_upgrade {
        default upgrade;
        '' close;
    }
    upstream websocket {
       # server localhost:8889;
        server superliga.socket:8889;
    }
    upstream websocket_node {
        server superliga.socket:3000;
    }
    upstream websocket_chat_node {
        server superliga.socket:3000;
    }
    upstream websocket_stage {
        server stage.superliga.socket:8887;
    }
    upstream websocket_stage_node {
        server stage.superliga.socket:3000;
    }
    upstream websocket_stage_chat_node {
        server stage.superliga.socket:3000;
    }
```


/etc/nginx/conf.d/php.conf
=========
```bash
upstream php7 {
    server unix:/var/run/php/php-fpm-superliga.sock;
#    server unix:/var/run/php/php-fpm-superliga2.sock max_fails=5 fail_timeout=15s;
 #   server unix:/var/run/php/php-fpm-superliga3.sock;
}
```

# HOSTS setup:

```bash
#35.199.103.119 superliga.database
10.27.128.3 superliga.database
10.158.0.3 superliga.postgre
10.158.0.4 superliga.socket
10.158.0.5 superliga.answers stageprod.superliga.answers
```


# Autoscale group demo:
```bash
 aws autoscaling update-auto-scaling-group \                                                                                                                        ✔
    --auto-scaling-group-name afa-web-autoscaling-group \
    --desired-capacity 6 \
    --max-size 20 \
    --min-size 2
```
