<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Context\ByDefinition;

use Eki\NRW\Mdl\Processing\Solution\Context\AbstractContext;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;
use Eki\NRW\Mdl\Model\Definition\DefinitionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Context extends AbstractContext implements ContextInterface
{
	/**
	* @var DefinitionInterface
	*/
	private $definition;	
	
	public function __construct(array $init, DefinitionInterface $definition)
	{
		$this->definition = $definition;
		$this->context = $definition->processingMeaning($init); 
	}

	/**
	* @inheritdoc
	* 
	*/
	public function set($param, $value)
	{
		$this->context = $definition->processingMeaning(array($param => $value));
		
		return $this;
	}
}
