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

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;
use Eki\NRW\Mdl\Working\Tests\Subject\Utils\CallbackUtils;

use PHPUnit\Framework\TestCase;
use stdClass;

class AbstractCallbackTest extends TestCase
{
	private $utils;
	
	public function setUp()
	{
		$this->utils = new CallbackUtils;
	}
	
	public function tearDown()
	{
		$this->utils = null;
	}
	
	/**
	* @dataProvider getDataGet
	*/ 	
    public function testGetWithCallbackHasGetter(array $goodProps, array $wrongProps)
    {
    	$callback = $this->createCallback(
    		$goodProps, 
    		false,       // getter/setter
    		false        // not init props
    	);

		foreach($goodProps as $propName => $propValue)
		{
	    	$this->assertTrue($callback->has($propName));
	    	$callback->set($propName, $propValue);
	    	$this->assertSame($propValue, $callback->get($propName));
		}
    	
		foreach($wrongProps as $wName)
		{
	    	$this->assertFalse($callback->has($wName));
		}
    }

	/**
	* @dataProvider getDataSet
	*/ 	
    public function testSetWithCallbackHasSetter(array $goodProps)
    {
    	$callback = $this->createCallback(
    		$goodProps, 
    		false, 		// getter/setter
    		false 		// not init props
    	);

		foreach($goodProps as $propName => $propValue)
		{
	    	$this->assertTrue($callback->has($propName));
			$callback->set($propName, $propValue . "suffix");
	    	$this->assertSame($propValue."suffix", $callback->get($propName));
		}
    }
	
	/**
	* @dataProvider getDataGet
	*/ 	
    public function testGetWithObjectHasProperty(array $goodProps, array $wrongProps)
    {
    	$callback = $this->createCallback();
    	$subject = $this->createSubject(
    		stdClass::class,
    		$goodProps,
    		true,           // use properties
    		true            // init props
    	);
    	$callback->assignSubject($subject);
    	
		foreach($goodProps as $propName => $propValue)
		{
	    	$this->assertTrue($callback->has($propName));
	    	$this->assertSame($propValue, $callback->get($propName));
		}
    	
		foreach($wrongProps as $wName)
		{
	    	$this->assertFalse($callback->has($wName));
		}
	}

	/**
	* @dataProvider getDataGet
	*/ 	
    public function testGetWithObjectHasGetter(array $goodProps, array $wrongProps)
    {
    	$callback = $this->createCallback();
    	$subject = $this->createSubject(
    		stdClass::class,
    		$goodProps,
    		true,           // use properties
    		true            // not init props
    	);
    	$callback->assignSubject($subject);
    	
		foreach($goodProps as $propName => $propValue)
		{
	    	$this->assertTrue($callback->has($propName));
	    	$this->assertSame($propValue, $callback->get($propName));
		}
    	
		foreach($wrongProps as $wName)
		{
	    	$this->assertFalse($callback->has($wName));
		}
	}

	/**
	* @dataProvider getDataAdd
	*/ 	
    public function testAdd(array $addProps, array $notAddProps)
    {
    	$callback = $this->createCallback(
    		[],	null, null, null, null, $addProps
    		
    	);
    	
		foreach($addProps as $addPropName => $addPropValue)
		{
	    	$this->assertTrue($callback->addSupport($addPropName, null, $addPropValue));
	    	$callback->add($addPropName, null, $addPropValue);
		}
    	
		foreach($notAddProps as $notAddPropName)
		{
	    	$this->assertFalse($callback->addSupport($notAddPropName, null, null));
		}
	}

	private function createCallback(
		array $props = [], 
		$isProperty = null, $init = null, 
		$getting = null, $setting = null,
		$addProps = []
	)
	{
		return $this->utils->createCallback(
			$this, 
			$props, $isProperty, $init, $getting, $setting, 
			$addProps
		);
	}

	private function createSubject(
		$subjectClass, array $props = [], 
		$isProperty = null, $init = null, 
		$getting = null, $setting = null
	)
	{
		return $this->utils->__createMock(
			$this, 
			$subjectClass, $props, $isProperty, $init, $getting, $setting
		);
	}

	public function getDataGet()
	{
		return [
			array(
	    		array(
		    		'good_name' => "kdjkjskjfas",
		    		'the_name' => "23131",
		    		'yes_name' => "kasdksjakdsa",
		    		'ok_prop' => "LHHkhKH",
		    	),
		    	array(
		    		'a_name',
		    		'wrong_name',
		    		'wrong_prop',
		    	)
			),
			array(
	    		array(
		    		'good_name_1' => "kdjkjskjfas",
		    		'the_name_2' => "23131",
		    		'yes_name' => "kasdksjakdsa",
		    		'ok_prop' => "LHHkhKH",
		    	),
		    	array(
		    		'a_name',
		    		'wrong_name',
		    		'wrong_prop',
		    	)
			),
		];
	}

	public function getDataSet()
	{
		return [
			array(
	    		array(
		    		'good_name' => "kdjkjskjfas",
		    		'the_name' => "23131",
		    		'yes_name' => "kasdksjakdsa",
		    		'ok_prop' => "LHHkhKH",
		    	)
			),
		];
	}
	
	public function getDataAdd()
	{
		return [
			array(
	    		array(
		    		'good_name' => "kdjkjskjfas",
		    		'the_name' => "23131",
		    		'yes_name' => "kasdksjakdsa",
		    		'ok_prop' => "LHHkhKH",
		    	),
		    	array(
		    		'a_name',
		    		'wrong_name',
		    		'wrong_prop',
		    	)
			),
			array(
	    		array(
		    		'good_name_1' => "kdjkjskjfas",
		    		'the_name_2' => "23131",
		    		'yes_name' => "kasdksjakdsa",
		    		'ok_prop' => "LHHkhKH",
		    	),
		    	array(
		    		'a_name',
		    		'wrong_name',
		    		'wrong_prop',
		    	)
			),
		];
	}
}
