<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Scope;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Scope implements ScopeInterface
{
	/**
	* @var DefinitionInterface
	*/
	private $definition;
	
	public function __construct(DefinitionInterface $definition)
	{
		$this->definition = $definition;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getName()
	{
		return $this->definition->getName();
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getScope()
	{
		return $this->definition->getScope();
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getLevels()
	{
		return $this->definition->getLevels();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getLevel($levelName)
	{
		return $this->definition->getLevel($levelName);
	}
}
