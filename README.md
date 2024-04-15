If your Laravel project is located in the `public_html` folder, your Nginx configuration should reflect that. Here's an example of how you can set up Nginx for a Laravel project in the `public_html` folder:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/public_html;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock; # Adjust for your PHP version
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

In this configuration:

- `server_name` should be set to your domain.
- `root` should point to your `public_html` folder.
- The `location /` block ensures that Nginx tries to serve existing files, and if not found, passes the request to `index.php`.
- The `location ~ \.php$` block is responsible for processing PHP files.

Make sure to adjust the paths and PHP version (`fastcgi_pass`) to match your setup. After updating the Nginx configuration, don't forget to restart Nginx for the changes to take effect:

```bash
sudo systemctl restart nginx
```

Additionally, make sure your `.env` file in the `public_html` folder contains the correct settings for Passport, especially the `CLIENT_ID` and `CLIENT_SECRET`.

After making these changes, check if you're still encountering the "unauthenticated" error when trying to get authentication tokens. If the issue persists, it might be helpful to check the Laravel logs (`storage/logs`) for any related error messages.