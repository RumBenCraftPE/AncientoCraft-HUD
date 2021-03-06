<?php

namespace RumDaDuMCPE;

class HUD extends \pocketmine\scheduler\PluginTask {
	public function __construct(Main $plugin, \pocketmine\Player $player) {
		parent::__construct($plugin);
		$this->plugin = $plugin;
		$this->player = $player;
	}

	public function onRun($tick) {
		$fac = $this->plugin->getServer()->getPluginManager()->getPlugin("FactionsPro");
		$eco = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$facerror = "§cUnable to load HUD.\n§4FactionsPro was not found in your plugins.";
		$ecoerror = "§cUnable to load HUD.\n§4EconomyAPI was not found in your plugins.";
		if ($this->player->isOnline()) {
			if ($fac !== null) {
				if ($eco !== null) {
					$money = $eco->myMoney($this->player);
					$name = $fac->getPlayerFaction($this->player->getName());
					$power = $fac->getFactionPower($name);
					$level = $this->player->getLevel()->getName();
					$x = (int)$this->player->getX();
					$y = (int)$this->player->getY();
					$z = (int)$this->player->getZ();
					switch($this->player->getDirection()) {
					case 0:
					$direction = "South";
					break;
					case 1:
					$direction = "West";
					break;

					case 2:
					$direction = "North";
					break;

					case 3:
					$direction = "East";
					break;

					default:
					$direction = "Unable to fetch dir.";
					break;
				}
					$this->player->sendPopup(
								 "§7> §eYou are playing on §l§dAncientoPE§r§a Factions §r§7<". //Line 1
								 "\n". //Line Break
								 "§eCheck us out: §l§cAncientoCraft.us". //Line 2
								 "\n". //Line Break
								 "§eLocation: §l§a".$level."§r §7- §l§a".$x.", ".$y.", ".$z." §8| §a§l$".$money. //Line 3
								 "\n".
								 "§r§bFaction: §l§c".$name.
								 "§r§8 | §bPower: §l§c".$power //Line 4
								);
				} else {
					$this->player->sendPopup($ecoerror);
				}
			} else {
				$this->player->sendPopup($facerror);
			}
		}
	}
}
