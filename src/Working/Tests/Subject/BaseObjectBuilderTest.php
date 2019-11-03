<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject;

use Eki\NRW\Mdl\Working\Subject\BaseObjectBuilder;
use Eki\NRW\Mdl\Working\ObjectBuilderInterface;
use Eki\NRW\Common\Res\Factory\Factory;

use Eki\NRW\Mdl\Working\Tests\Subject\Utils\RegistryUtils;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\TestImportor;
use Eki\NRW\Mdl\Working\Tests\Subject\Fixtures\TestValidator;

use PHPUnit\Framework\TestCase;

use stdClass;

class BaseObjectBuilderTest_TestObject {
}


class BaseObjectBuilderTest extends TestCase
{
    public function testBuilder()
    {
    	$builder = $this->createBuilder();
    }
    
    private function createBuilder()
    {
		$builder = new BaseObjectBuilder(
			new Factory(array(
				'callback.type' => stdClass::class,
			)),
			RegistryUtils::createCallback($this, 'callback.type'),
			new TestImportor,
			new TestValidator
		);
		
		return $builder;
	}
}
