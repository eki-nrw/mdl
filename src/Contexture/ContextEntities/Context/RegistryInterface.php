<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is boundary to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Context\SupportStrategy\SupportStrategyInterface;;

use InvalidArgumentException;

/**
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface RegistryInterface
{
	/**
	* Register an context in manner of the given support strategy
	* 
	* @param ContextInterface $context
	* @param SupportStrategyInterface $supportStrategy
	* 
	* @return void
	*/
	public function add(ContextInterface $context, SupportStrategyInterface $supportStrategy);
	
	/**
	* Get the registered context that matched boundary object
	* 
	* @param object $boundary
	* @param string $contextName
	* 
	* @return ContextInterface
	*/
	public function get($boundary, $contextName = null);

	/**
	* Get all registered contexts that matched boundary object
	* 
	* @param object $boundary
	* 
	* @return ContextInterface[]
	*/
	public function getAll($boundary);

}
