# Rust PHP Stats page

Shows stats of players like KDR and online time.

git clone https://github.com/kennethrisa/Stats.git

rename example-mconfig.php to mconfig.php
rename example-api-server1.php to api-server1.php

- Support for multiple servers
- Support for rust-servers.net and rust-servers.info

Im not a pro devloper, just testing and learning!

See the how to section for setup.

Demo: https://demo.altirust.no/
Kenna - Altirust.no

# Required:
- Oxide
- rust-servers.net - you need to register your server to get api key
- rust-servers.info - you need to register your server
- MySql/MariaDB
- Webserver/Nginx
- php 5.6>

Create database: See SQLStats.txt or section MariaDB

Edit api-server1.php, find $url and provide your api key after key=yourKey<br>
for rust-servers.info you only need to change to your ID

# Oxide plugin:
rust_plugin/SQLStats.cs - Add this to your plugin directory. (Some feature are removed for performance gain)
Todo: Remove SQLStats.cs support and add support for Player Ranks (http://oxidemod.org/plugins/player-ranks.2359/)

Plugin is now unmaintaned: http://oxidemod.org/threads/stats-unmaintained.9849/
Use it on your own risk.

# How to:
Im gonna assume you own a dedi box, and we are gonna install all on the same machine where rust server are running.
We are gonna create a subdomain to this so you can add it to your website, like stats.yourdomain.com, this will be pointed to your dedi server.

- OS: Win 2012 r2.
- MariaDB 10.2.6 stable.
- Nginx 1.13.2 windows with fast-cgi php7.

If you are gonna use a sql server who is not on the same server, make sure thats the latency is not big, or you are gonna have performance issues.

## Download the content
1. Create a folder c:\git\ and go to this folder.
2. git clone https://github.com/kennethrisa/Stats.git or download it as a zip and extract the content to c:\git\stats

## MariaDB
1. How to install mariaDB on windows<br>
Direct Download link: https://downloads.mariadb.org/interstitial/mariadb-10.2.6/winx64-packages/mariadb-10.2.6-winx64.msi/from/http%3A//mirror.host.ag/mariadb/<br>
2. Follow the step by step guide here: https://mariadb.com/kb/en/mariadb/installing-mariadb-msi-packages-on-windows/<br>
3. The installer above install's HeidiSQL, we will use this client to create database, tables and user, or choose your fav one, some use phpmyadmin.<br>
4. After you have installed mariaDB and HeidiSQL client, Open HeidiSQL and connect to your server.(Hit start icon, and type HeidiSQL -> Enter)<br>
Choose New -> Session in root folder -> Enter localhost or your ip -> Enter root/password with what you entred in the setup and hit Save -> open.<br>
5. Right click on start menu and hit run, type: services.msc and see if MySQL is running. this service has to run.
6. HeidiSQL: Hit the Query (Blue Play button) and paste this in:<br>
```
CREATE DATABASE rust;

USE rust;

CREATE TABLE `stats_player` (
  `id` bigint(20) NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `online_seconds` bigint(20) NOT NULL DEFAULT '0',
  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `online` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `stats_player_death` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `player` bigint(20) NOT NULL,
  `cause` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `PlayerCauseDate` (`player`,`cause`,`date`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `stats_player_kill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `killer` bigint(20) NOT NULL,
  `victim` bigint(20) NOT NULL,
  `weapon` varchar(128) NOT NULL,
  `bodypart` varchar(2000) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `distance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
```
7. And than hit the big blue play button or F9 (Execute SQL)<br>
Then right click above where it says Information_schema and hit refresh.<br>
You should now see that you have a database named rust and have 3 tables inside it.<br>
8. Create a user:
```
CREATE USER rust@'%' IDENTIFIED BY 'yourpassword';
GRANT ALL privileges ON rust.* TO 'rust'@'%' WITH GRANT OPTION;;
FLUSH PRIVILEGES;
```
9. Try to login with the rust user and see if you have access, this is the credentials you are gonna use in the website and oxide config.<br>

## Nginx:
1. Download nginx/windows 1.13.2 (latest stable version)<br>
Download link: http://nginx.org/en/download.html<br>
2. Click on nginx/windows-1.13.2 - it will now download a zip. Extract this zip file and copy the files to c:\nginx<br>
3. move c:\git\stats\nginx\start.bat and stop.bat content to c:\nginx and dobbel click on start.bat - this will start nginx, so if you restart your server, you will have to start this again. You can also verify it start to open taskmgr, and see it in the "Details tab" called "nginx.exe" two times.<br>
4. Download php 7.1.6: http://windows.php.net/downloads/releases/php-7.1.6-nts-Win32-VC14-x86.zip<br>
5. Extract content and rename the folder to php, move it to c: so the path is c:\php<br>
6. Now we need to copy a program called RunHiddenConsole to get php to run on port 9000.<br>
7. Extract RunHiddenConsole.zip in path c:\git\stats\nginx\ and make a new dir called "bin" in c:\ so the path will be c:\bin\ copy the RunHiddenConsole.exe and paste it in to c:\bin.<br>
8. To get php to start we need Visual C++ 2015 redist x86(Not x64), download from micrisoft: https://www.microsoft.com/en-us/download/details.aspx?id=52685 and install the package afterward.<br>
9. Copy start-php-fcgi.bat from c:\git\stats\nginx to c:\nginx\ and dobbel tap it so it starts. this you will also need to start after a reboot of the server. Verify it has started, open taskmgr and see the details tab after "php-cgi.exe"<br>
10. If you get a an error that you are missing vcruntime140.dll, you have not installed the correct one in step 8(vc_redist.x86.exe).<br>
11. Now we need to edit the c:\nginx\conf\nginx.conf file to get it working with php.<br>
12. Edit: c:\nginx\conf\nginx.conf go down to line 65 and uncomment to line 71 like this:
```
        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
            root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
            include        fastcgi_params;
            include        fastcgi.conf;
        }
```
Make sure you also add the last line: include fastcgi.conf; or you can get a error like this: no input file specified<br>
13. Now try to go to your browser and see if nginx have started successful: http://localhost/<br>
14. If you see "Welcome to nginx", then the nginx is successful installed.<br>
15. Now we need to make sure php works.<br>
16. create a file in c:\nginx\html\helloworld.php
```
<?php echo "Hello world"; ?>
```
try now to browse to http://localhost/helloworld.php <br>
If it says Hello world, than everything is now fine.<br>
17. Now we need to add so the index.php is the default who is being loaded. Edit c:\nginx\conf\nginx.conf<br>
and add this to the line: index.php on line 45 like so:<br>
```
index  index.php index.html index.htm;
```
18. Edit the php.ini file. First we need to rename c:\php\php.ini-production to php.ini. you can also copy c:\git\stats\nginx\php.ini to c:\php\php.ini if you don't want to edit it.<br>
19. edit the file and remove the ; on line 905 and 907 like it will be like this:
```
before:
;extension=php_mysqli.dll
;extension=php_openssl.dll
After:
extension=php_mysqli.dll
extension=php_openssl.dll
```
20. Restart php, go to taskmgr and kill php-cgi.exe and use the start-php.fcgi.bat to start it again.<br>

## Web files
1. Copy the all the files/folders from c:\git\stats exept for folders: nginx, rust_plugin and CreateDatabases.txt to c:\nginx\html\<br>
2. Rename example-mconfig.php to mconfig.php<br>
3. Rename example-navbar.php to navbar.php<br>
4. Rename example-api-server1.php to api-server1.php<br>
5. Now edit mconfig.php and fill inn sql credentials.<br>
6. Edit api-server1.php and fill inn your rust-server.net api key and rust-servers.info server ID.<br>
7. Now browse to http://localhost/ and you should see you get info from rust-servers.info and rust-servers.net<br>

## Rust plugin SQLStats.cs
1. Now copy c:\git\stats\rust_plugin\SQLStats.cs into your rust plugin folder.<br>
2. you should now edit the file config\SQLStats.json and fill inn the database information like below<br>
```
{
  "dbConnection": {
    "Database": "rust",
    "Host": "localhost",
    "Password": "password",
    "Port": 3306,
    "Username": "rust"
  }
}
```
3. Now it should push the data to the SQL database server.

## Subdomain
I have no idea what hosting company you use, but you should now just create a "A Record" stats.yourdomain.com and point it to your external IP<br>
just remember to open port 80 TCP from same as you open the rust port.<br>

You should also consider to move your domain to Cloudflare for faster cdn and website<br>
You also get free ssl and auto renewal.
## Hardning nginx
More coming
# Template by bootstrap
