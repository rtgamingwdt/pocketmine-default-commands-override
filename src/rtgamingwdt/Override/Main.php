<?php

namespace rtgamingwdt\Override;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
  
  private static $main;
    
  public function onEnable() {    
    self::$main = $this;
    $this->unregister("ban");
    $this->unregister("ban-ip");
    $this->getServer()->getCommandMap()->register("ban", new commands\BanCommand($this));
    $this->getServer()->getCommandMap()->register("ban-ip", new commands\BanIpCommand($this));
    $this->getLogger()->info("§eOverride by RT has been §aenabled!");
  }

  public function onDisable() {
    self::$main = $this;
    $this->getLogger()->info("§eOverride by RT has been §cdisabled!");
  }

  public static function getMain(): self {
    return self::$main;
  }
  
  public function unregister(string ...$commands) {
    $map = $this->getServer()->getCommandMap();
    foreach($commands as $cmd) {
      $command = $map->getCommand($cmd);
      if($command !== null) {
        $command->setLabel("old_".$cmd);
        $map->unregister($command);
      }
    }
  }
}
