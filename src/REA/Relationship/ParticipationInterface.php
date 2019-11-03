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

use Eki\NRW\Mdl\REA\Agent\AgentInterface;
use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* Participation is relationship between agent and event
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ParticipationInterface extends RelationshipInterface
{
	/**
	* Returns the agent
	* 
	* @return AgentInterface
	*/
	public function getAgent();
	
	/**
	* Returns the event
	* 
	* @return EventInterface
	*/
	public function getEvent();
}
