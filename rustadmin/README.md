# PHP Example on how to get RustAdmin rcon tool to show stats on a php page.



## Steps:
- Open your browser, go to: http://localhost:8888/getPlayersGlobalStats
  save this as getPlayersGlobalStats.json
- Upload the file to the webserver

## What you get from this example:

| PlayerName     | PVP Kills      | PVP Deaths     | PVE Deaths     |
| :------------- | :------------- | :------------- | :------------- |
| Item           | Item           | Item           | Item           |


## Json overview:

```
{
    "players": [
        {
            "PlayerDeathsPVE": [],
            "PlayerDeathsPVP": [
                {
                    "date": 1499357124,
                    "idPlayerKiller": "",
                    "namePlayerKiller": "",
                    "sleeperKill": true
                }
            ],
            "PlayerID": "",
            "PlayerKills": [],
            "PlayerName": ""
          }
     ]
 }

```
