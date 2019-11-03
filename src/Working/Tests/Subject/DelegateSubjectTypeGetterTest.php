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

use Eki\NRW\Mdl\Working\SubjectTypeGetter;
use Eki\NRW\Mdl\Working\SubjectTypeGetterInterface;
use Eki\NRW\Mdl\Working\DelegateSubjectTypeGetter;

use Eki\NRW\Mdl\Working\Tests\Fixtures\AClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\BClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\CClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\DClass;
use Eki\NRW\Mdl\Working\Tests\Fixtures\BType;
use Eki\NRW\Mdl\Working\Tests\Fixtures\XType;

use PHPUnit\Framework\TestCase;

use stdClass;
use InvalidArgumentException;
use UnExpectedValueException;

class DelegateSubjectTypeGetterTest extends TestCase
{
	public function testDelegate()
	{
		$getters = [];
		foreach($this->listGetters() as $getterInfo)
		{
			$getters[] = new SubjectTypeGetter($getterInfo[0][0], $getterInfo[0][1]);	
		}
		
		$delegateGetter = new DelegateSubjectTypeGetter($getters);
		
		$subject = new AClass();
		$this->assertTrue($delegateGetter->support($subject));
		$this->assertSame('type.abc', $delegateGetter->getSubjectType($subject));

		$subject = new BClass(new BType('bclass.type'));		
		$this->assertTrue($delegateGetter->support($subject));
		$this->assertSame('bclass.type', $delegateGetter->getSubjectType($subject));

		$subject = new CClass();
		$this->assertTrue($delegateGetter->support($subject));
		$this->assertSame('type.xyz', $delegateGetter->getSubjectType($subject));

		$subject = new DClass();
		$this->assertTrue($delegateGetter->support($subject));
		$this->assertSame('type.ddd', $delegateGetter->getSubjectType($subject));
	}
	
	/**
	* @dataProvider listGetter
	* 
	*/
	public function testGetSubjectType(array $info)
	{
		$getter = new SubjectTypeGetter($info['class'], $info['call']);
		$this->assertSame($info['type'], $getter->getSubjectType());
	}

	public function listGetters()
	{
		return array(
			array(
				array(
			    	'class' => AClass::class, 
			    	'call' => function ($subject) { return 'type.abc'; },
			    	'type' => 'type.abc'
				)
			),
			array(
				array(
				    'class' => BClass::class,
				    'call' => function ($subject) { return $subject->getType()->getType(); },
				    'type' => 'bclass.type'
				)
			),
			array(
				array(
					'class' => CClass::class,
					'call' => array(CClass::class, 'getTypeName'),
					'type' => 'type.xyz'
				)
			),
			array(
				array(
			    	'class' => DClass::class, 
			    	'call' => function ($subject) { return $subject->getType(); },
			    	'type' => 'type.ddd'
				)
			),
		);
	}
}
