# Rust PHP Stats page

Shows stats of players like KDR and online time.

git clone https://github.com/kennethrisa/Stats.git

rename example-mconfig.php to mconfig.php
rename api/example-api-server1.php to api-server1.php

- Support for multiple servers
- Support for rust-servers.net and rust-servers.info

Im not a pro devloper, just testing and learning!

more coming soon.

# Required:
- Oxide
- rust-servers.net - you need to register your server to get api key
- rust-servers.info - you need to register your server
- MySql/MariaDB
- Webserver/Nginx
- php 5.6>

Create database:
See SQLStats.txt

Edit api/api-server1.php, find $url and provide your api key after key=yourKey
for rust-servers.info you only need to change to your ID

# Oxide plugin:
rust_plugin/SQLStats.cs - Add this to your plugin directory. (Some feature are removed for performance gain)

Plugin is now unmaintaned: http://oxidemod.org/threads/stats-unmaintained.9849/
Use it on your own risk.

# How to:
Im gonna assume you own a dedi box, and we are gonna install all on the same machine where rust server are running.
We are gonna create a subdomain to this so you can add it to your website, like stats.yourdomain.com, this will be pointed to your dedi server.

- OS: Win 2012 r2.
- MariaDB 10.2.6 stable.
- Nginx 1.13.2 windows with fast-cgi php7.

If you are gonna use a sql server where your webserver is, make sure thats the latency is not big, or you are gonna have performance issues.

1. How to install mariaDB on windows<br>
Direct Download link: https://downloads.mariadb.org/interstitial/mariadb-10.2.6/winx64-packages/mariadb-10.2.6-winx64.msi/from/http%3A//mirror.host.ag/mariadb/<br>
1.2 Follow the step by step guide here: https://mariadb.com/kb/en/mariadb/installing-mariadb-msi-packages-on-windows/<br>
1.3 The installer above got HeidiSQL installed, so check if HeidiSQL is installed before you try download this, if it installed, just skip this step. Download Heidi SQL (Desktop client to sql queries) or choose your fav, some use phpmyadmin.<br>
1.4 After you have installed mariaDB and HeidiSQL client, Open heidi sql and connect to your server.(Hit start icon, and type HeidiSQL -> Enter)<br>
Choose New -> Session in root folder -> Enter localhost or your ip or 127.0.0.1 -> Enter root/password with what you entred in the setup and hit Save -> open.<br>
1.5.Hit the Query (Blue Play button) and paste this in:<br>
```
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

2. Download nginx/windows 1.13.2 (latest stable version)
Download link: http://nginx.org/en/download.html
2.1

3. Download the content from github
3.1 use git clone or download as a zip file.



# Template by bootstrap

Demo: https://demo.altirust.no/

Kenna - Altirust.no
