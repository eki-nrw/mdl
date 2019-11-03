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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface DeliverableInterface
{
	public function getDeliver();
	public function setDeliver($deliver = null);
	
	public function deliver($info);
	
	public function isDelivered();
}
