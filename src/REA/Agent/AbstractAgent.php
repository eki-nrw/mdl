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

use Eki\NRW\Common\Location\LocationInterface;
use Eki\NRW\Common\Common\HasPropertiesTrait;
use Eki\NRW\Common\Common\HasOptionsTrait;
use Eki\NRW\Common\Common\HasAttributesTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractAgent implements AgentInterface
{
	use
		HasAgentTypeTrait,
		HasAttributesTrait,
		HasPropertiesTrait,
		HasOptionsTrait
	;

	/**
	* @var string
	*/
	private $agentName;

	/**
	* @inheritdoc
	*/	
	public function getName()
	{
		return $this->agentName;
	}
	
	/**
	* @inheritdoc
	*/	
	public function setName($agentName)
	{
		$this->agentName = $agentName;
	}
}
