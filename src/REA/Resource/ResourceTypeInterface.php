<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Resource;

use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Common\HasOptionsInterface;
use Eki\NRW\Common\Common\HasAttributesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ResourceTypeInterface extends
	HasPropertiesInterface,
	HasOptionsInterface,
	HasAttributesInterface
{
	/**
	* Return the name of resource type
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Sets the name of resource type
	* 
	* @param string $name
	* 
	* @return void
	*/
	public function setName($name);
	
	/**
	* Return unique type name of resource type
	* 
	* @return string
	*/
	public function getResourceType();
	
	/**
	* Returns default unit alias
	* 
	* @return string|null
	*/
	public function getDefaultUnitAlias();
	
	/**
	* Sets default unit alias
	* 
	* @param string $unitAlias
	* 
	* @return void
	*/
	public function setDefaultUnitAlias($unitAlias);
	
	// supported methods
}
