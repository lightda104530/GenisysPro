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


class EntityPickRequestPacket extends DataPacket{
	const NETWORK_ID = Info::ENTITY_PICK_REQUEST_PACKET;

	/** @var int */
	public $entityTypeId;
	/** @var int */
	public $hotbarSlot;

	protected function decode(){
		$this->entityTypeId = $this->getLLong();
		$this->hotbarSlot = $this->getByte();
	}

	protected function encode(){
		$this->reset();
		$this->putLLong($this->entityTypeId);
		$this->putByte($this->hotbarSlot);
	}
}