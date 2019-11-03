<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Common\Common\HasAttributesInterface;
use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Participating\ParticipantsAwareInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ClaimInterface extends
	HasClaimTypeInterface,
	HasClaimableInterface,
	ParticipantsAwareInterface,
	HasAttributesInterface,
	HasPropertiesInterface
{
	public function getCode();
	public function setCode($code);
}
