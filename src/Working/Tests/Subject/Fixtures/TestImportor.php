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

use Eki\NRW\Mdl\Working\Subject\ImportorInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class TestImportor implements ImportorInterface
{
	/**
	* @inheritdoc
	*/
	public function support($data, $object)
	{
		return true;
	}
	
	/**
	* @inheritdoc
	*/
	public function import($data, &$object, array $contexts = [])
	{
		print 'test importor' . "\n";
	}
}
