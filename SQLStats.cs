// Reference: Oxide.Ext.MySql
// Reference: Oxide.Core.MySql 
using System.Collections.Generic;
using Oxide.Core;
using System;
using System.Net;
using System.Text;
using UnityEngine;
using Oxide.Core.Plugins;

using Oxide.Core.Database;
namespace Oxide.Plugins {

    [Info("SQLStats", "Visagalis", "1.0.2")]
    [Description("Logs various statistics about ingame stuff to MySQL.")]
    public class SQLStats : RustPlugin {

        private Dictionary<BasePlayer, Int32> loginTime = new Dictionary<BasePlayer, int>();
        //private readonly Ext.MySql.Libraries.MySql _mySql = new Ext.MySql.Libraries.MySql(); OLD one
		private readonly Core.MySql.Libraries.MySql _mySql = Interface.GetMod().GetLibrary<Core.MySql.Libraries.MySql>();
        private Connection _mySqlConnection = null;
        private Dictionary<string, object> dbConnection = null;
        protected override void LoadDefaultConfig() { }
        private T checkCfg<T>(string conf, T def)
        {
            if (Config[conf] != null)
            {
                return (T)Config[conf];
             }
            else
            {
                Config[conf] = def;
                return def;
            }
        }

        void Unloaded()
        {
            foreach (var player in BasePlayer.activePlayerList)
            {
                OnPlayerDisconnected(player);
            }
            timer.Once(5, () =>
            {
                _mySql.CloseDb(_mySqlConnection);
                _mySqlConnection = null;
            });
        }

        void Loaded() {
            dbConnection = checkCfg<Dictionary<string, object>>("dbConnection", new Dictionary<string, object>{
                {"Host", "127.0.0.1"},
                {"Port", 3306},
                {"Username", "rustUS"},
                {"Password", "rustPW" },
                {"Database", "rustDB"}
            });
			SaveConfig();
            StartConnection();

            foreach (var player in BasePlayer.activePlayerList)
            {
                OnPlayerInit(player);
            }
        }

        private void StartConnection()
        {
            if (_mySqlConnection == null)
            {
                Puts("Opening connection.");
                _mySqlConnection = _mySql.OpenDb(dbConnection["Host"].ToString(), Convert.ToInt32(dbConnection["Port"]), dbConnection["Database"].ToString(), dbConnection["Username"].ToString(), dbConnection["Password"].ToString(), this);
                Puts("Connection opened.");
            }
        }

        public void executeQuery(string query, params object[] data) {
            var sql = Sql.Builder.Append(query, data);
            _mySql.Insert(sql, _mySqlConnection);
        }

        private string getDate() {
            return DateTime.Now.ToString("yyyy-MM-dd");
        }

        private string getDateTime()
        {
            return DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
        }

        string UppercaseFirst(string s) {
            if(string.IsNullOrEmpty(s)) {
                return string.Empty;
            }
            char[] a = s.ToCharArray();
            a[0] = char.ToUpper(a[0]);
            return new string(a);
        }

        static string EncodeNonAsciiCharacters(string value)
        {
            StringBuilder sb = new StringBuilder();
            foreach (char c in value)
            {
                if (c > 127)
                {
                    // This character is too big for ASCII
                    string encodedValue = "";
                    sb.Append(encodedValue);
                }
                else {
                    sb.Append(c);
                }
            }
            return sb.ToString();
        }


        /**
         ** Events
         **/

        void OnPlayerInit(BasePlayer player)
        {
            if (!player.IsConnected)
                return;

            string properName = EncodeNonAsciiCharacters(player.displayName);

            executeQuery(
                "INSERT INTO stats_player (id, name, ip, online) VALUES (@0, @1, @2, 1) ON DUPLICATE KEY UPDATE name = @1, ip = @2, online = 1",
                player.userID, properName, player.net.connection.ipaddress);
            if(loginTime.ContainsKey(player))
                OnPlayerDisconnected(player);

            loginTime.Add(player, (Int32) (DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds);
        }

        void OnPlayerDisconnected(BasePlayer player) {
            if(loginTime.ContainsKey(player)) {
                executeQuery("UPDATE stats_player SET online_seconds = online_seconds + @0, online = 0 WHERE id = @1", (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds - loginTime[player], player.userID);
                loginTime.Remove(player);
            }
        }
        
        void OnEntityDeath(BaseCombatEntity entity, HitInfo hitInfo)
        {
            if (entity.lastAttacker != null && entity.lastAttacker is BasePlayer)
            {
                if (entity is BuildingBlock)
                {
                    BasePlayer attacker = ((BasePlayer) entity.lastAttacker);
                    string weapon = "Unknown";
                    try
                    {
                        weapon = attacker.GetActiveItem().info.displayName.english;
                    }
                    catch{}
                    try
                    {
                        //executeQuery(
                        //    "INSERT INTO stats_player_destroy_building (player, building, date, tier, weapon) VALUES (@0, @1, @2, @3, @4)",
                        //    ((BasePlayer) entity.lastAttacker).userID,
                        //    ((BuildingBlock) entity).blockDefinition.info.name.english, getDateTime(),
                        //    ((BuildingBlock) entity).currentGrade.gradeBase.name.ToUpper() + " (" +
                        //    ((BuildingBlock) entity).MaxHealth() + ")", weapon);
                    }
                    catch (Exception ex)
                    {
                        throw new Exception("Line 194. " + ex.Message);
                    }
                }
                else if (entity is BaseNpc)
                {
                    try
                    {
                        string weapon = "Unknown";
                        try
                        {
                            weapon = ((BasePlayer)entity.lastAttacker).GetActiveItem().info.displayName.english;
                        }
                        catch { }
                        string distance = "-1";
                        if (hitInfo != null)
                            distance = GetDistance(entity, hitInfo.Initiator) ?? "0";
                        else
                        {
                            weapon += "(BLEED TO DEATH)";
                            distance = GetDistance(entity, (BasePlayer) entity.lastAttacker) ?? "0";
                        }

                        //executeQuery(
                        //    "INSERT INTO stats_player_animal_kill (player, animal, date, weapon, distance) VALUES (@0, @1, @2, @3, @4)",
                        //    ((BasePlayer) entity.lastAttacker).userID,
                        //    GetFormattedAnimal(entity.LookupShortPrefabName()), getDateTime(), weapon, distance);
                    }
                    catch (Exception ex)
                    {
                        Puts("!!!!WRONG!!!! 210!!!");
                        throw new Exception("Line 210. " + ex.Message);
                    }
                }
                else if (entity is BasePlayer && entity != entity.lastAttacker)
                {
                    try
                    {
                        string weapon = "Unknown";
                        try
                        {
                            weapon = ((BasePlayer)entity.lastAttacker).GetActiveItem().info.displayName.english;
                        }
                        catch { }
                        string distance = "-1";
                        if (hitInfo != null)
                            distance = GetDistance(entity, hitInfo.Initiator) ?? "0";
                        else
                        {
                            weapon += "(BLEED TO DEATH)";
                            distance = GetDistance(entity, (BasePlayer) entity.lastAttacker) ?? "0";
                        }

                        executeQuery(
                            "INSERT INTO stats_player_kill (killer, victim, weapon, date, bodypart, distance) VALUES (@0, @1, @2, @3, @4, @5)",
                            ((BasePlayer) entity.lastAttacker).userID, ((BasePlayer) entity).userID,
                            weapon, getDateTime(),
                            formatBodyPartName(hitInfo), distance);
                    }
                    catch (Exception ex)
                    {
                        Puts("!!!!WRONG!!!! 227!!!");
                        if (entity && entity.lastAttacker == null)
                            Puts("Entity was attacked by NULL!");
                        if(hitInfo == null)
                            Puts("hitInfo is NULL!");
                        throw new Exception("Line 227. " + ex.StackTrace);
                    }
                }
            }

            try
            {
                if (entity is BasePlayer)
                {
                    string cause = entity.lastDamage.ToString().ToUpper();
                    executeQuery("INSERT INTO stats_player_death (player, cause, date) VALUES (@0, @1, @2)" +
                                 "ON DUPLICATE KEY UPDATE count = count + 1", ((BasePlayer) entity).userID, cause,
                        getDate());
                }
            }
            catch (Exception ex)
            {
                Puts("!!!!WRONG!!!!245!!!");
                throw new Exception("Line 245" + ex.Message);
            }
        }

        string GetDistance(BaseCombatEntity victim, BaseEntity attacker)
        {
            string distance = Convert.ToInt32(Vector3.Distance(victim.transform.position, attacker.transform.position)).ToString();
            return distance;
        }

        string GetFormattedAnimal(string animal)
        {
            animal = animal.Replace(".prefab", "").ToUpper();
            return animal;
        }

		// Borrowed this part from LaserHyrdra's Death Notes <3
        string formatBodyPartName(HitInfo hitInfo)
        {
            string bodypart = "Unknown";
            bodypart = StringPool.Get(Convert.ToUInt32(hitInfo?.HitBone)) ?? "Unknown";
            if ((bool)string.IsNullOrEmpty(bodypart)) bodypart = "Unknown";
            for (int i = 0; i < 10; i++)
            {
                bodypart = bodypart.Replace(i.ToString(), "");
            }

            bodypart = bodypart.Replace(".prefab", "");
            bodypart = bodypart.Replace("L", "");
            bodypart = bodypart.Replace("R", "");
            bodypart = bodypart.Replace("_", "");
            bodypart = bodypart.Replace(".", "");
            bodypart = bodypart.Replace("right", "");
            bodypart = bodypart.Replace("left", "");
            bodypart = bodypart.Replace("tranform", "");
            bodypart = bodypart.Replace("lowerjaweff", "jaw");
            bodypart = bodypart.Replace("rarmpolevector", "arm");
            bodypart = bodypart.Replace("connection", "");
            bodypart = bodypart.Replace("uppertight", "tight");
            bodypart = bodypart.Replace("fatjiggle", "");
            bodypart = bodypart.Replace("fatend", "");
            bodypart = bodypart.Replace("seff", "");
            bodypart = bodypart.ToUpper();
            return bodypart;
        }

    }

}