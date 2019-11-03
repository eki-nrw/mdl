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

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ACallback extends AbstractCallback
{
	public function getAbc()
	{
		return 'zzz';
	}
	
	public function getCallbackType()
	{
		return 'aaa';
	}
}
