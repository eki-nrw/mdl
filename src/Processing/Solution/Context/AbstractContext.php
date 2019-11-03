<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Context;

use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractContext implements ContextInterface
{
	/**
	* @var array
	*/
	protected $context = [];
	
	/**
	* Constructor
	* For testing purpose only. Never call ...
	* 
	* @param array $init
	* 
	*/
	public function __construct(array $init = [])
	{
		$this->context = $init;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function get($param)
	{
		$propertyAccessor = PropertyAccess::createPropertyAccessor();
		
		return $propertyAccessor->getValue($this->context, '['.$param.']');
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getContext()
	{
		return $this->context;
	}
}
