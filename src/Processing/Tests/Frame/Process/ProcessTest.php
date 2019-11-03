<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Process;

use Eki\NRW\Mdl\Processing\Frame\Process\ProcessInterface;
use Eki\NRW\Mdl\Processing\Frame\Process\Process;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ProcessTest extends TestCase
{
	public function testDefaults()
	{
		$process = new Process();
		
		$this->assertInstanceOf(ProcessInterface::class, $process);
	}
}
