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
use Eki\NRW\Common\Timing\StartEndTimeTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractEvent implements EventInterface
{
	use
		HasEventTypeTrait,
		StartEndTimeTrait
	;
	
	/**
	* @var QuantityValueInterface
	*/
	protected $affectedQuantityValue;
	
	/**
	* @inheritdoc
	*/
	public function getAffectedQuantity()
	{
		return $this->affectedQuantityValue;
	}

	/**
	* @inheritdoc
	*/
	public function setAffectedQuantity(QuantityValueInterface $affectedQuantity = null)
	{
		$this->affectedQuantityValue = $affectedQuantity;
	}
}
