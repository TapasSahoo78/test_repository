If you're using Apache server, you can achieve this by configuring a virtual host to listen on port 80 (HTTP) and proxy requests to your Node.js application running on port 8181. Here's how you can do it:

1. **Enable Apache modules**: Make sure the `proxy` and `proxy_http` modules are enabled in your Apache server. You can enable them using the following commands:

```bash
sudo a2enmod proxy
sudo a2enmod proxy_http
sudo systemctl restart apache2
```

2. **Create a Virtual Host configuration**: Create a new configuration file (e.g., `yourdomain.conf`) in the Apache `sites-available` directory. Replace `yourdomain.com` with your actual domain name.

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com

    ProxyPreserveHost On
    ProxyPass / http://localhost:8181/
    ProxyPassReverse / http://localhost:8181/
</VirtualHost>
```

3. **Enable the Virtual Host**: Once you've created the configuration file, enable the virtual host by creating a symbolic link to the `sites-enabled` directory:

```bash
sudo ln -s /etc/apache2/sites-available/yourdomain.conf /etc/apache2/sites-enabled/
```

4. **Restart Apache**: Restart Apache to apply the changes:

```bash
sudo systemctl restart apache2
```

5. **Update Security Groups**: Ensure that your AWS Security Group associated with your EC2 instance allows inbound traffic on port 80.

6. **Test**: Finally, test your site to ensure it's accessible without specifying the port in the URL.

By following these steps, your Apache server will listen on the default HTTP port (port 80) and forward requests to your Node.js application running on port 8181.