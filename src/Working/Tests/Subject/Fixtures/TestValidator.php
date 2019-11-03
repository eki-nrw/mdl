<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject\Fixtures;

use Eki\NRW\Mdl\Working\Subject\ValidatorInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class TestValidator implements ValidatorInterface
{
	/**
	* @inheritdoc
	*/
	public function validate($object, array $options = [])
	{
		
	}
	
	/**
	* @inheritdoc
	*/
	public function support($object)
	{
		return true;
	}
}
