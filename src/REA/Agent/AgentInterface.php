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

use Eki\NRW\Common\Common\HasAttributesInterface;
use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Common\HasOptionsInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface AgentInterface extends
	HasAgentTypeInterface,
	HasAttributesInterface,
	HasPropertiesInterface,
	HasOptionsInterface
{
	public function getName();
	public function setName($agentName);
}
