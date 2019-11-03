<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\Exchange\Type;

use Eki\NRW\Common\Common\TypeCheckingInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeTypeInterface extends
	TypeCheckingInterface
{
	/**
	* Returns exchange type
	* 
	* @return string
	*/
	public function getExchangeType();
}
