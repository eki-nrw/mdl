<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests;

use Eki\NRW\Mdl\Processing\Element;
use Eki\NRW\Mdl\Processing\ElementInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ElementTest extends TestCase
{
	public function testConstructor_default()
	{
		$element = new Element("element_key");
		
		$this->assertInstanceOf(ElementInterface::class, $element);
		$this->assertSame("element_key", $element->getKey());
	}
}
