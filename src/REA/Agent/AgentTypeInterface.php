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

use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Common\HasOptionsInterface;
use Eki\NRW\Common\Common\HasAttributesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface AgentTypeInterface extends
	HasPropertiesInterface,
	HasOptionsInterface,
	HasAttributesInterface
{
	/**
	* Return agent type
	* 
	* @return string
	*/
	public function getAgentType();
	
	/**
	* Determines that is person type or not (organization)
	* 
	* @return bool
	*/
	public function isPersonType();

	/**
	* Return the name of resource type
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Sets the name of resource type
	* 
	* @param string $name
	* 
	* @return void
	*/
	public function setName($name);
}
