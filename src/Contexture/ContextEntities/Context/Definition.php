<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\Definition as BaseDefinition;
use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\DefinitionInterface as ScopeDefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DefinitionInterface as FlowDefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Flow\Definition as FlowDefinition;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Definition extends BaseDefinition implements DefinitionInterface
{
	/**
	* @inheritdoc
	* 
	*/
	public function setBoundary($boundary)
	{
		$this->configuration['boundary'] = (string)$boundary;
		
		return $this;
	}

	public function getBoundary()
	{
		if (isset($this->configuration['boundary']))
			return $this->configuration['boundary'];
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setScopes($scopes)
	{
		$this->configuration['scopes'] = array();
		
		if (is_array($scopes))
		{
			foreach($scopes as $scope)
			{
				if ($scope instanceof ScopeDefinitionInterface)
				{
					$scopeName = $scope->getName();
					$sc = $scope->getConfiguration();
				}
				else if (is_array($scope))
				{
					$sc = $scope['scope'];
					$scopeName = $sc['name'];
				}
				
				$this->configuration['scopes'][$scopeName] = $sc;
			}
		}
		else
			throw new \InvalidArgumentException("????");
		
		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getScopes()
	{
		$scopes = array();
		if (isset($this->configuration['scopes']))
			$scopes = $this->configuration['scopes'];
			
		return $scopes;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setUses($uses)
	{
		$this->configuration['uses'] = $uses;
		
		return $this;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getUses()
	{
		$uses = array();
		if (isset($this->configuration['uses']))
			$uses = $this->configuration['uses'];
			
		return $uses;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setFlows($flows)
	{
		$this->configuration['flows'] = array();
		
		if (!is_array($flows))
			throw new \InvalidArgumentException("Parameter 'flows' must be an array.");

		foreach($flows as $flow)
		{
			if ($flow instanceof FlowDefinitionInterface)
			{
				$fl = $flow;
			}
			else if (is_array($flow))
			{
				$fl = new FlowDefinition($flow);
			}

			$flowName = $fl->getName();			
			$this->configuration['flows'][$flowName] = array();
			$this->configuration['flows'][$flowName]['from'] = $fl->getFromScope();
			$this->configuration['flows'][$flowName]['to'] = $fl->getToScope();
		}
				
		return $this;
	}	
	
	/**
	* @inheritdoc
	* 
	*/
	public function getFlows()
	{
		$flows = array();
		if (isset($this->configuration['flows']))
			$flows = $this->configuration['flows'];
			
		return $flows;
	}

	/**
	* Return the definition of the given flow
	* 
	* @param string $flowName
	* 
	* @return \Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DefinitionInterface
	*/
	public function getFlow($flowName)
	{
		if (!isset($this->configuration['flows'][$flowName]))
			throw new \InvalidArgumentException("No flow with name $flowName.");
			
		return (new FlowDefinition())
			->setName($flowName)
			->setFromScope($this->configuration['flows'][$flowName]['from'])
			->setToScope($this->configuration['flows'][$flowName]['to'])
		;
	}
}
