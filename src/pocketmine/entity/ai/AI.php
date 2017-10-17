<?php

namespace entity\ai;

use pocketmine\entity\Animal;
use pocketmine\entity\Chicken;
use pocketmine\entity\Cow;
use pocketmine\entity\Creeper;
use pocketmine\entity\Entity;
use pocketmine\entity\IronGolem;
use pocketmine\entity\Monster;
use pocketmine\entity\Mooshroom;
use pocketmine\entity\Ocelot;
use pocketmine\entity\Pig;
use pocketmine\entity\PigZombie;
use pocketmine\entity\Sheep;
use pocketmine\entity\Skeleton;
use pocketmine\entity\SnowGolem;
use pocketmine\entity\Wolf;
use pocketmine\entity\Zombie;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityGenerateEvent;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\level\format\FullChunk;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\TaskHandler;

use pocketmine\Server;
use pocketmine\Player;

class AI{

	public static 
		$monsters = [Zombie::NETWORK_ID, Creeper::NETWORK_ID, Skeleton::NETWORK_ID];
	public static 
		$animals = [Chicken::NETWORK_ID, Cow::NETWORK_ID, Pig::NETWORK_ID, Sheep::NETWORK_ID];
	
	public $CowAI;
	public $PigAI;
	public $SheepAI;
	public $ZombieAI;
	public $ChickenAI;
	public $CreeperAI;
	public $SkeletonAI;
	public $IronGolemAI;
	public $SnowGolemAI;
	public $PigZombieAI;
	
	public $Cow = [];
	public $Pig = [];
	public $Sheep = [];
	public $zombie = [];
	public $Chicken = [];
	public $Creeper = [];
	public $Skeleton = [];
	public $irongolem = [];
	public $snowgolem = [];
	public $pigzombie = [];
	
	public $server;
	
	public $task[];
	
	public function getServer(){
		return $this->$server;
	}
	
	public function __construct(Server $server){
		$this->server = $server;
		
		if($this->server->aiConfig["mobgenerate"]){
			$this->tasks['ZombieGenerate'] = $this->getServer()->getScheduler()->scheduleRepeatTask(new CallbackTask([
				$this,
				"MobGenerate"
			]), 20 * 45);
			
			$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([
				$this,
				"TimeFix"
			]), 20);
			
			$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask ([$this, "RotationTimer"]), 2);
			
			$this->ZombieAI = new ZombieAI($this);
			$this->CowAI = new CowAI($this);
			$this->PigAI = new PigAI($this);
			$this->SheepAI = new SheepAI($this);
			$this->ChickenAI = new ChickenAI($this);
			$this->CreeperAI = new CreeperAI($this);
			$this->SkeletonAI = new SkeletonAI($this);
			$this->IronGolemAI = new IronGolemAI($this);
			$this->PigZombieAI = new PigZombieAI($this);
		}
		
		/*
		 ************** API part *************
		 */
		
		/**
		 * @parm $r
		 * Set Zombie Hatred rounte
		 */
		public function setZombieHatred_r($r){
			$this->ZombieAI->hatred_r = $r;
		}
		
		
	}
}
