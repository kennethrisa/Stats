# PHP Example on how to get stats on a webpage from using RustAdmin rcon tool with json API.



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
