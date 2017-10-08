<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

#use pocketmine\entity\Skin;
use pocketmine\utils\UUID;

class PlayerSkinPacket extends DataPacket{
	const NETWORK_ID = Info::PLAYER_SKIN_PACKET;

	/** @var UUID */
	public $uuid;
	/** @var string */
	public $oldSkinName = "";
	/** @var string */
	public $newSkinName = "";
	/** @var Skin */
	public $skin;


	protected function decode(){
		$this->uuid = $this->getUUID();

		$skinId = $this->getString();
		$this->newSkinName = $this->getString();
		$this->oldSkinName = $this->getString();
		$skinData = $this->getString();
		$capeData = $this->getString();
		$geometryModel = $this->getString();
		$geometryData = $this->getString();

		#$this->skin = new Skin($skinId, $skinData, $capeData, $geometryModel, $geometryData);
	}

	protected function encode(){
		$this->reset();
		$this->putUUID($this->uuid);

		$this->putString($this->skin->getSkinId());
		$this->putString($this->newSkinName);
		$this->putString($this->oldSkinName);
		$this->putString($this->skin->getSkinData());
		$this->putString($this->skin->getCapeData());
		$this->putString($this->skin->getGeometryName());
		$this->putString($this->skin->getGeometryData());
	}
}