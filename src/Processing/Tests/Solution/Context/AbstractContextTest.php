<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Solution\Context;

use Eki\NRW\Mdl\Processing\Solution\Context\AbstractContext;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class AbstractContextTest extends TestCase
{
	public function testConstructor()
	{
		$context = $this->getMockBuilder(AbstractContext::class)->getMockForAbstractClass();
		
		$this->assertInstanceOf(ContextInterface::class, $context);
	}

	public function testGet()
	{
		$context = $this->getMockBuilder(AbstractContext::class)
			->setConstructorArgs(
				array(
					array(
						'param_1' => 'one',
						'param_2' => 200,
						'param_3' => array(
							'aaa' => 'AAAA',
							'bbb' => 'BBBB'
						)
					)
				)
			)
			->getMockForAbstractClass()
		;
		
		$this->assertSame('one', $context->get('param_1'));
		$this->assertSame(200, $context->get('param_2'));
		$this->assertSame('AAAA', $context->get('param_3')['aaa']);
		$this->assertSame('BBBB', $context->get('param_3')['bbb']);
	}
}
