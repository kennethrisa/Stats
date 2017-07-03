# Rust PHP Stats page

Shows stats of players like KDR and online time.

git clone https://github.com/kennethrisa/Stats.git

rename example-mconfig.php to mconfig.php
rename example-apiconfig.php to api-28015.php

Im not a pro devloper, just testing and learning!

more coming soon.

# Required:
- Oxide
- Support for rust-servers.net - you need to register your server to get api key
- Support for rust-servers.info - you need to register your server
- MySql/MariaDB
- Webserver/Nginx
- php 5.6>

Create database:
See SQLStats.txt

Edit api-28015.php, find $url and provide your api key after key=yourKey
for rust-servers.info you only need to change to your ID

# Oxide plugin:
SQLStats.cs - Add this to your plugin directory. (Some feature are removed for performance gain)

Plugin is now unmaintaned: http://oxidemod.org/threads/stats-unmaintained.9849/
Use it on your own risk.

# How to:
Im gonna assume you own a dedi box, and we are gonna install all on the same machine where rust server are running.
We are gonna create a subdomain to this so you can add it to your website, like stats.yourdomain.com, this will be pointed to your dedi server.

- OS: Win 2012 r2.
- MariaDB 10.2.6 stable.
- Nginx 1.13.2 windows with fast-cgi php7.

1. How to install mariaDB on windows<br>
Download link: https://downloads.mariadb.org/interstitial/mariadb-10.2.6/winx64-packages/mariadb-10.2.6-winx64.msi/from/http%3A//mirror.host.ag/mariadb/<br>
1.2 Follow the step by step guide here: https://mariadb.com/kb/en/mariadb/installing-mariadb-msi-packages-on-windows/<br>
1.3 Download Heidi SQL (Desktop client to sql queries) or choose your fav, some use phpmyadmin.<br>
1.4 After you have installed mariaDB and HeidiSQL client, Open heidi sql and connect your server.<br>
Choose New -> enter localhost or your ip -> root/password and hit open.<br>
1.5.<br>

2. Download nginx/windows 1.13.2 (latest stable version)
Download link: http://nginx.org/en/download.html


# Template by bootstrap

Demo: https://demo.altirust.no/

Kenna - Altirust.no
