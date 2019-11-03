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

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\Definition as BaseDefinition;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Definition extends BaseDefinition implements DefinitionInterface
{
	/**
	* @inheritdoc
	* 
	*/
	public function setScope($scopeValue)
	{
		return $this->setName($scopeValue);

		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getScope()
	{
		return $this->getName();	
	}
		
	/**
	* @inheritdoc
	* 
	*/
	public function setLevel($levelName, $levelValue)
	{
		if (!is_string($levelName) or !is_string($levelValue))
			throw new \InvalidArgumentException("Parameter 'levelName' and/or parameter 'levelValue' both must be string.");

		if (!isset($this->configuration['scope']))
			$this->configuration['scope'] = array();
		
		$this->configuration['scope'][$levelName] = $levelValue;	
		
		return $this;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getLevel($levelName)
	{
		if (isset($this->configuration['scope'][$levelName]))
			return $this->configuration['scope'][$levelName];	
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setLevels(array $levels)
	{
		if (isset($this->configuration['scope']))
			$this->configuration['scope'] = array();

		foreach($levels as $levelName => $levelValue)
		{
			$this->setLevel($levelName, $levelValue);
		}
		
		return $this;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getLevels()
	{
		if (isset($this->configuration['scope']))
			return $this->configuration['scope'];	
		else
			return array();
	}
	
}
