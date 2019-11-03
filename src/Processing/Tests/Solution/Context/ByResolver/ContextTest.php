<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Solution\Context\ByResolver;

use Eki\NRW\Mdl\Processing\Solution\Context\ByResolver\Context;
//use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ContextTest extends TestCase
{
	public function testConstructor_Dummy()
	{
		$context = new Context([], function (OptionsResolver $resolver) {});
	}

	public function testGet()
	{
		$context = new Context(
			array(
//				'param_1' => 'one',
//				'param_2' => 200,
				'param_3' => array(
					'aaa' => 'AAAA',
					'bbb' => 'BBBB'
				)
			),
			function (OptionsResolver $resolver) {
				$resolver->setDefaults(array(
					'param_1' => 'one',
					'param_2' => 200,
					'param_3' => array(),
				));
				
				$resolver->setAllowedTypes('param_1', ['string']);
				$resolver->setAllowedTypes('param_2', 'int');
				$resolver->setAllowedTypes('param_3', 'array');
			}
		);
		
		$this->assertSame('one', $context->get('param_1'));
		$this->assertSame(200, $context->get('param_2'));
		$this->assertSame('AAAA', $context->get('param_3')['aaa']);
		$this->assertSame('BBBB', $context->get('param_3')['bbb']);
	}

	public function testSet()
	{
		$context = new Context(
			array(
				'param_3' => array(
					'aaa' => 'AAAA',
					'bbb' => 'BBBB'
				)
			),
			function (OptionsResolver $resolver) {
				$resolver->setDefaults(array(
					'param_1' => 'one',
					'param_2' => 200,
					'param_3' => array(),
				));
				
				$resolver->setAllowedTypes('param_1', ['string']);
				$resolver->setAllowedTypes('param_2', 'int');
				$resolver->setAllowedTypes('param_3', 'array');
			}
		);
		
		$this->assertSame('one', $context->get('param_1'));
		$this->assertSame(200, $context->get('param_2'));
		
		$context->set('param_3', array( 'aaa' => 'AAAA', 'bbb' => 'BBBB' ));
		
		$this->assertSame('AAAA', $context->get('param_3')['aaa']);
		$this->assertSame('BBBB', $context->get('param_3')['bbb']);
	}
}
