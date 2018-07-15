# Rust PHP Stats page

Shows stats of players like KDR and played time.

18.07.2017: This is rewritten to support oxide plugin: Player Ranks

git clone https://github.com/kennethrisa/Stats.git

## Short Example:
rename example-mconfig.php to mconfig.php and fill in your mysql credentials.
rename example-api-server1.php to api-server1.php
Edit api-server1.php, find $url and provide your api key after key=yourKey<br>
for rust-servers.info you only need to change to your server ID.

- Support for multiple servers
- Support for rust-servers.net and rust-servers.info

Im not a pro devloper, just testing and learning!

Demo: https://demo.altirust.no/
Kenna - Altirust.no

# Required:
- Oxide
- Oxide plugin: Player Ranks
- rust-servers.net - you need to register your server to get api key
- rust-servers.info - you need to register your server
- MySql/MariaDB
- Webserver
- php 5.6>

# Oxide plugin:
Player Ranks (http://oxidemod.org/plugins/player-ranks.2359/)
Se how to install on oxidemod.org

# Template by bootstrap
# Credits
The man who made this rust plugin: Oxide user: Steenamaroo
