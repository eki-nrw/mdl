<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Agent;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasAgentTypeInterface
{
	/**
	* Gets agent type
	* 
	* @return AgenttypeInterface
	*/
	public function getAgentType();
	
	/**
	* Sets agent type
	* 
	* @param AgentTypeInteface $agentType
	* 
	* @return void
	*/
	public function setAgentType(AgentTypeInterface $agentType = null);
}
