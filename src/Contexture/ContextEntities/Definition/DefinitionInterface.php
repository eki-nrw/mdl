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
interface DefinitionInterface
{
	/**
	* Sets the name of definition. It used as type
	* 
	* @param string $name 
	* 
	* @return this
	*/
	public function setName($name);
	
	/**
	* Reutrns the name of the definition
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Set the configuration for the definition
	* 
	* @param mixed $configuration
	* 
	* @return this
	*/
	public function setConfiguration($configuration);

	/**
	* Returns the configuration
	* 
	* @return array
	*/
	public function getConfiguration();
	
	/**
	* Export the definition as string
	* 
	* @return string
	*/
	public function __toString();
	
	/**
	* Export the definition as array
	* 
	* @return array
	*/
	public function __toArray();
	
	/**
	* Returns the definition by cloning
	* 
	* @return DefinitionInterface
	*/
	public function get();
}
