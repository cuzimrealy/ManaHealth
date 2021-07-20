<?php

namespace cuzimrealy;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
         
         public function onEnable(){
                  $this->getServer()->getPluginManager()->registerEvents($this, $this);
                  @mkdir($this->getDataFolder());
                  $this->saveDefaultConfig();
                  $this->getResources("config.yml");
         }
         
         public function onJoin(PlayerJoinEvent $event){
                  $player = $event->getPlayer();
                  
                  $this->getScheduler()->scheduleRepeatingTask(new \pocketmine\scheduler\ClosureTask(function(int $unused) : void{
                           foreach($this->getServer()->getOnlinePlayers() as $player){
                                    
                                    $health = $player->getHealth();
                                    $maxhealth = $player->getMaxHealth();
                                    $defence = $player->getArmorPoints();
                                    $player->sendActionbarMessage("§c{$health}/{$maxhealth}❤️  §a{$defence}❈Defense  §b100.0✎Mana");              
                           }
                  }), 20);
         }
}