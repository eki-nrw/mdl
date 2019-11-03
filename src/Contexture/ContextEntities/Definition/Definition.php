<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Definition;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Definition implements DefinitionInterface
{
	protected $configuration = array();

	public function __construct(array $configuration = [], ValidatorInterface $validator = null)
	{
		if ($validator !== null)
		{
			if ($validator->validate($configuration) === false)
				throw new \InvalidArgumentException("Definition invalid.");
		}
			
		$this->configuration = $configuration;
	}
		
	/**
	* @inheritdoc
	* 
	*/
	public function setName($name)
	{
		if (!is_string($name))
			throw new \InvalidArgumentException("Name must be a string.");
		
		$this->configuration['name'] = (string)$name;
		
		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getName()
	{
		return $this->configuration['name'];		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setConfiguration($configuration)
	{
		$this->configuration = $configuration;
			
		return $this;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getConfiguration()
	{
		return $this->configuration;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function __toString()
	{
		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function __toArray()
	{
		return $this->configuration;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function get()
	{
		return clone $this;
	}
}
