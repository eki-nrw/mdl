<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Res\Factory\Factory as BaseFactory;

use Eki\NRW\Mdl\Working\PlanTypeInterface;
use Eki\NRW\Mdl\Working\PlanInterface;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class DefFactory extends BaseFactory
{
	/**
	* @var object
	*/
	private $typeObj;
	
	/**
	* @var string
	*/
	private $typeMethod;

	/**
	* Constructor
	* 
	* @param object $typeObj
	* @param string $typeMethod
	* @param string $classname
	* 
	* @throws \InvalidArgumentException
	* @throws \ReflectionException
	*/	
	public function __construct($typeObj, $typeMethod, $classname, callable $typeObjChecker = null, callable $classChecker = null)
	{
		if (null !== $typeObjChecker)
			call_user_func($typeObjChecker, $typeObj, $typeMethod);
		if (null !== $classChecker)
			call_user_func($classChecker, $classname);
		
		$this->typeObj = $typeObj;
		$this->typeMethod = $typeMethod;
		
		parent::__construct(array($typeObj->$typeMethod() => $classname));	
	}
	
	/**
	* @inheritdoc
	*/
	public function createNew($type = null, $args = null)
	{
		if (null === $args)
			$args = $this->typeObj;
			
		return parent::createNew($type, $args);
	}
}
