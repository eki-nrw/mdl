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
trait HasAgentTypeTrait
{
	/**
	* @var AgentTypeInterface
	*/
	private $agentType;
	
	/**
	* @inheritdoc
	*/	
	public function getAgentType()
	{
		return $this->agentType;
	}

	/**
	* @inheritdoc
	*/	
	public function setAgentType(AgentTypeInterface $agentType = null)
	{
		$this->agentType = $agentType;
	}
}
