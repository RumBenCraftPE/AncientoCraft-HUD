<?php

namespace RumDaDuMCPE;

class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener {
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§a>> §l§bHUD §r§eEnabled!");
	}
	public function onMove(\pocketmine\event\player\PlayerJoinEvent $event) {
		$HUD = new HUD($this, $event->getPlayer());
		$this->getServer()->getScheduler()->scheduleRepeatingTask($HUD, 15);
	}
}
