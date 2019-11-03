<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Claimable\Simple;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Delivery
{
	private $value;
	
	public function __construct($value)
	{
		$this->setValue($value);
	}
		
	public function getValue()
	{
		return $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}
