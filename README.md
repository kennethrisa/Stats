# Rust PHP Stats page

Shows stats of players like KDR and played time.

18.07.2017: This is rewritten to support oxide plugin: Player Ranks
15.07.2017: Updated to support clans leaderboard.

git clone https://github.com/kennethrisa/Stats.git

## Short Example:
Rename example-mconfig.php to mconfig.php and fill in your mysql credentials.<br>
Rename example-api-server1.php to api-server1.php.<br>
Edit api-server1.php, find $url and provide your api key after key=yourKey.<br>
For rust-servers.info you only need to change to your server ID.

- Support for multiple servers
- Support for rust-servers.net and rust-servers.info

I`m not a pro devloper, just testing and learning!

Demo: https://demo.altirust.no/
Kenna - Altirust.no

# Required:
- Oxide
- Oxide plugin: Player Ranks
- Rust-servers.net - you need to register your server to get api key
- Rust-servers.info - you need to register your server
- MySql/MariaDB
- Webserver
- Php 5.6>

# Oxide plugin:
Player Ranks (http://oxidemod.org/plugins/player-ranks.2359/)
Se how to install on oxidemod.org

# Template by bootstrap
# Credits
The man who made this rust plugin: Oxide user: Steenamaroo
