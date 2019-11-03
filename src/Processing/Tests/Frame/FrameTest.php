<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Frame;

use Eki\NRW\Mdl\Processing\Frame\Frame;
use Eki\NRW\Mdl\Processing\Frame\FrameInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class FrameTest extends TestCase
{
	public function testInterfaces()
	{
		$frame = new Frame();

		$this->assertInstanceOf(FrameInterface::class, $frame);
	}
}
