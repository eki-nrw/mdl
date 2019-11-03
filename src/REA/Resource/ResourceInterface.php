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
use Eki\NRW\Mdl\REA\Resource\QuantityValue\QuantityValueInterface;
use Eki\NRW\Common\QuantityValue\HasQuantityValueInterface;
use Eki\NRW\Common\Location\LocationInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ResourceInterface extends
	HasResourceTypeInterface,
	HasPropertiesInterface,
	HasOptionsInterface,
	HasAttributesInterface,
	HasQuantityValueInterface
{
	/**
	* Returns resource name
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Sets resource name
	* 
	* @param string $resourceName
	* 
	* @return void
	*/
	public function setName($resourceName);
	
	/**
	* Returns the current location of resource
	* 
	* @return LocationInterface|null
	*/
	public function getCurrentLocation();
	
	/**
	* Sets the current location of resource
	* 
	* @param LocationInterface|null $location
	* 
	* @return void
	*/
	public function setCurrentLocation(LocationInterface $location = null);
}
