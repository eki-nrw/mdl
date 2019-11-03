<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Matcher;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Matcher implements MatcherInterface
{
	/**
	* @var DefinitionInterface
	*/
	protected $definition;
	
	/**
	* @var \Closure
	*/
	protected $checker;
	
	public  function __construct(DefinitionInterface $definition = null, \Closure $checker = null)
	{
		$this->definition = $definition;
		$this->checker = $checker;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function match($obj, $arguments = null)
	{
		return $this->__match($obj, $this->definition, $arguments);
	}
	
	/**
	* Checks if object $obj matched with arguments
	* 
	* @param object $obj
	* @param DefinitionInterface $definition
	* @param mixed|null $arguments
	* 
	* @return bool
	*/
	protected function __match($obj, DefinitionInterface $definition, $arguments)
	{
		if (null !== ($checker = $this->checker))
		{
			if ($checker($obj, $definition->getConfiguration(), $arguments) === true)
				return true;
		}
		
		return false;
	}
}
