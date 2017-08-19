<?php

namespace RumDaDuMCPE;

class HUD extends \pocketmine\scheduler\PluginTask {
	public function __construct(Main $plugin, \pocketmine\Player $player) {
		parent::__construct($plugin);
		$this->plugin = $plugin;
		$this->player = $player;
	}

	public function onRun($tick) {
		$fac = $this->plugin->getServer()->getPluginManager()->getPlugin("PowerFactions");
		$eco = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$facerror = "§cUnable to load HUD.\n§4PowerFactions was not found in your plugins.";
		$ecoerror = "§cUnable to load HUD.\n§4EconomyAPI was not found in your plugins.";
		if (file_exists($fac)) {
			if (file_exists($eco)) {
				$bal = $eco->myMoney($this->player);
				$name = $fac->getPlayerFaction($this->player);
				$power = $fac->getFactionPower($fac);
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
							 "> §eYou are playing on §l§dAncientoPE§r§a Factions <". //Line 1
							 "\n". //Line Break
							 "§eCheck us out: §l§cAncientoCraft.us". //Line 2
							 "\n". //Line Break
							 "§eLocation: §l§a".$level."§r §7- §l§a".$x.", ".$y.", ".$z." §8| §a§l$".$money. //Line 3
							 "\n".
							 "§bFaction: §l§e".$fac."§r§8 | §bPower: §l§c".$power //Line 4
							);
			} else {
				$this->player->sendPopup($ecoerror);
			}
		} else {
			$this->player->sendPopup($facerror);
		}
	}
}
