<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests;

use Eki\NRW\Mdl\Working\Subject\SubjectTypeGetter;
use Eki\NRW\Mdl\Working\Subject\SubjectTypeGetterInterface;

use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\AClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\BClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\CClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\DClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\BType;
use Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter\XType;

use PHPUnit\Framework\TestCase;

use stdClass;
use InvalidArgumentException;
use UnexpectedValueException;

class SubjectTypeGetterTest extends TestCase
{
	/**
	* @dataProvider getGetters
	*/
	public function testGetter($class, $func, $newFunc, $typeClass = null, $typeName = '')
	{
		$getter = new SubjectTypeGetter($class, $func);
		
		$subject = call_user_func($newFunc, $class, $typeClass, $typeName);
		$this->assertTrue($getter->support($subject));
		$this->assertTrue(is_string($getter->getSubjectType($subject)));
		$this->assertFalse($getter->support(new stdClass()));
	}

	public function getGetters()
	{
		return array(
			array(
			    AClass::class, 
			    function ($subject) { return 'type.abc'; },
			    function ($class, $typeClass, $typeName) { return new $class(); }
			),
			array(
			    BClass::class,
			    function ($subject) { return $subject->getType()->getType(); },
			    function ($class, $typeClass, $typeName) { return new $class(new $typeClass($typeName)); },
			    BType::class,
			    'a_type'
			),
			array(
				CClass::class,
				array(CClass::class, 'getTypeName'),
			    function ($class, $typeClass, $typeName) { return new $class(); },
			),
			array(
			    AClass::class, 
			    function ($subject) { return 'type.subject.zzz'; },
			    function ($class, $typeClass, $typeName) { return new $class(); }
			),
			array(
				BClass::class, 
				array(DClass::class, 'getType'),
			    function ($class, $typeClass, $typeName) { return new $class(new $typeClass($typeName)); },
			    BType::class,
			    'x_type'
			),
		);
	}

	public function testGetterWrongArguments()
	{
		$this->expectException(InvalidArgumentException::class);
		$getter = new SubjectTypeGetter('this_is_not_class', function ($subject) { return 'xxx'; } );

		$this->expectException(InvalidArgumentException::class);
		$getter = new SubjectTypeGetter(stdClass::class, 'abcdef' );
	}
}

