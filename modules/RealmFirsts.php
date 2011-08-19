<?php
/* Compatible with TrinityCore       *
 * (c) 2011 Wheth <whethx@gmail.com> */

// Script work status: Work in Progress. //

// Handlers for one-player realm firsts
function getCharId($achiev, $config, $database) {
    $query1 = $database->query("SELECT * FROM ".$config['char_database'].".character_achievement WHERE achievement = ".$achiev."");
    if (!$query1) {
        die("Database error.");
    } else {
        $rows1 = $database->rows($query1);
        if ($rows1 != 1) {
            return FALSE;
        } else {
            $result1 = $database->fetchArray($query1);
            $charguid = $result1['guid'];
            return $charguid;
        }
    }
}


function printFirst($achiev, $string, $config, $database) {
    $first = getCharId($achiev, $config, $database);
    if ($first) {
        echo $string.getCharName($first, $config, $database).".<br>";
    }
}
// ---------------- //

// Handler for multi-player realm first (raid ones)

function getRaidCharName($achiev, $config, $database) {
    $query3 = $database->query("SELECT * FROM ".$config['char_database'].".character_achievement WHERE achievement = ".$achiev."");
    if (!$query3) {
        die("Database error.");
    } else {
        $rows3 = $database->rows($query3);
        if ($rows3 != 1) {
            return FALSE;
        } else {
            while ($result3 = $database->fetchArray($query3)) {
                $charguid = $result3['guid'];
                $query4 = $database->query("SELECT * FROM ".$config['char_database'].".characters WHERE guid = ".$charguid."");
                $names = "";
                if (!$query4) {
                    die("Database error.");
                } else {
                    $result4 = $database->fetchArray($query4);
                    $charname = $result4['name'];
                    $names .= $charname." ";
                }
                
            }
            return $names;
        }
    }
}


function printRaidFirst($achiev, $string, $config, $database) {
    $first = getRaidCharName($achiev, $config, $database);
    if ($first) {
        echo $string.getRaidCharName($achiev, $config, $database).".<br>";
    }
}

// ---------------- //

function getCharName($guid, $config, $database) {
    $query1 = $database->query("SELECT * FROM ".$config['char_database'].".characters WHERE guid = ".$guid."");
    if (!$query1) {
        die("Database error.");
    } else {
        $result1 = $database->fetchArray($query1);
        $charname = $result1['name'];
        return $charname;
    }
}




// Level
printFirst(457, "Realm First! Level 80: ", $config, $database);

// Races
printFirst(1405, "Realm First! Level 80 Blood Elf: ", $config, $database);
printFirst(1406, "Realm First! Level 80 Draenei: ", $config, $database);
printFirst(1407, "Realm First! Level 80 Dwarf: ", $config, $database);
printFirst(1413, "Realm First! Level 80 Forsaken: ", $config, $database);
printFirst(1404, "Realm First! Level 80 Gnome: ", $config, $database);
printFirst(1408, "Realm First! Level 80 Human: ", $config, $database);
printFirst(1409, "Realm First! Level 80 Night Elf: ", $config, $database);
printFirst(1410, "Realm First! Level 80 Orc: ", $config, $database);
printFirst(1411, "Realm First! Level 80 Tauren: ", $config, $database);
printFirst(1412, "Realm First! Level 80 Troll: ", $config, $database);

// Classes
printFirst(461, "Realm First! Level 80 Death Knight: ", $config, $database);
printFirst(466, "Realm First! Level 80 Druid: ", $config, $database);
printFirst(462, "Realm First! Level 80 Hunter: ", $config, $database);
printFirst(460, "Realm First! Level 80 Mage: ", $config, $database);
printFirst(465, "Realm First! Level 80 Paladin: ", $config, $database);
printFirst(464, "Realm First! Level 80 Priest: ", $config, $database);
printFirst(458, "Realm First! Level 80 Rogue: ", $config, $database);
printFirst(467, "Realm First! Level 80 Shaman: ", $config, $database);
printFirst(463, "Realm First! Level 80 Warlock: ", $config, $database);
printFirst(459, "Realm First! Level 80 Warrior: ", $config, $database);

// Professions
printFirst(1419, "Realm First! First Aid Grand Master: ", $config, $database);
printFirst(1416, "Realm First! Cooking Grand Master: ", $config, $database);
printFirst(1420, "Realm First! Grand Master Angler: ", $config, $database);
printFirst(1415, "Realm First! Grand Master Alchemist: ", $config, $database);
printFirst(1414, "Realm First! Grand Master Blacksmith: ", $config, $database);
printFirst(1417, "Realm First! Grand Master Enchanter: ", $config, $database);
printFirst(1418, "Realm First! Grand Master Engineer: ", $config, $database);
printFirst(1421, "Realm First! Grand Master Herbalist: ", $config, $database);
printFirst(1423, "Realm First! Grand Master Jewelcrafter: ", $config, $database);
printFirst(1424, "Realm First! Grand Master Leatherworker: ", $config, $database);
printFirst(1425, "Realm First! Grand Master Miner: ", $config, $database);
printFirst(1422, "Realm First! Grand Master Scribe: ", $config, $database);
printFirst(1426, "Realm First! Grand Master Skinner: ", $config, $database);
printFirst(1427, "Realm First! Grand Master Tailor: ", $config, $database);

// Various
printFirst(1463, "Realm First! Northrend Vanguard: ", $config, $database);

// Raid Realm First must be handled differently, since there are more player that can gain them.
printRaidFirst(456, "Realm First! Obsidian Slayer: ", $config, $database);
printRaidFirst(1400, "Realm First! Magic Seeker: ", $config, $database);
printRaidFirst(1402, "Realm First! Conqueror of Naxxramas: ", $config, $database);
printRaidFirst(3259, "Realm First! Celestial Defender: ", $config, $database);
printRaidFirst(3117, "Realm First! Death's Demise: ", $config, $database);
printRaidFirst(4078, "Realm First! Grand Crusader: ", $config, $database);
printRaidFirst(4576, "Realm First! Fall of the Lich King: ", $config, $database);
?>
<br><br><br><br><br><hr><small>Coded by <a href="mailto:whethx@gmail.com">Wheth</a></small>