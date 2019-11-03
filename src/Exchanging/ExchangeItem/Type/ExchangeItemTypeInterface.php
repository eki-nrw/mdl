<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeItem\Type;

use Eki\NRW\Common\Common\TypeCheckingInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeItemTypeInterface extends
	TypeCheckingInterface
{
	/**
	* Returns exchange item type
	* 
	* @return string
	*/
	public function getExchangeItemType();
}
