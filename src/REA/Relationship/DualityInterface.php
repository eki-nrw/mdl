<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Relationship;

use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* Duality is relationship between event and (another) event
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface DualityInterface extends RelationshipInterface
{
	/**
	* Returns the event
	* 
	* @return EventInterface
	*/
	
	public function getEvent();

	/**
	* Returns the other event
	* 
	* @return EventInterface
	*/
	public function getOtherEvent();
}
