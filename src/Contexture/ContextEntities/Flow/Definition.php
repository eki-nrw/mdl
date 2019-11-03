<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Flow;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\Definition as BaseDefinition;

/**
* Data flow Definition
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Definition extends BaseDefinition implements DefinitionInterface
{
	/**
	* @inheritdoc
	* 
	*/
	public function setFlow($flow)
	{
		return $this->setName($flow);

		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getFlow()
	{
		return $this->getName();	
	}

	public function setFromScope($scope, $level = null)
	{
		if ($level !== null)
		{
			$this->configuration['from'] = array(
				'scope' => (string)$scope,
				'level' => (string)$level
			);
		}
		else
			$this->configuration['from'] = (string)$scope;
		
		return $this;	
	}

	public function getFromScope()
	{
		if (isset($this->configuration['from']))
		{
			if (is_array($this->configuration['from']))
				return $this->configuration['from']['scope'] . ":" . $this->configuration['from']['level'];
			else if (is_string($this->configuration['from']))
				return $this->configuration['from'];
		}
	}
	
	public function setToScope($scope, $level = null)
	{
		if ($level !== null)
		{
			$this->configuration['to'] = array(
				'scope' => (string)$scope,
				'level' => $level
			);
		}
		else
		{
			$this->configuration['to'] = (string)$scope;
		}
		
		return $this;	
	}

	public function getToScope()
	{
		if (isset($this->configuration['to']))
		{
			if (is_array($this->configuration['to']))
				return $this->configuration['to']['scope'] . ":" . $this->configuration['to']['level'];
			else if (is_string($this->configuration['to']))
				return $this->configuration['to'];
		}
	}
}

