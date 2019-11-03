<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Event;

use Eki\NRW\Common\QuantityValue\QuantityValueInterface;
use Eki\NRW\Common\Timing\StartEndTimeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface EventInterface extends
	HasEventTypeInterface,
	StartEndTimeInterface
{
	/**
	* Returns affected things
	* 
	* @return void
	* @throws
	*/
	public function getAffected();

	/**
	* Sets affected things
	* 
	* @param mixed $affacted
	* @return void
	*/
	public function setAffected($affected = null);
}
