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

use Eki\NRW\Common\Common\HasPropertiesTrait;
use Eki\NRW\Common\Common\HasOptionsTrait;
use Eki\NRW\Common\Common\HasAttributesTrait;
use Eki\NRW\Common\QuantityValue\HasQuantityValueTrait;
use Eki\NRW\Common\Location\LocationInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractResource implements ResourceInterface
{
	use
		HasPropertiesTrait,
		HasOptionsTrait,
		HasAttributesTrait,
		HasQuantityValueTrait
	;

	protected $resourceType;
	private $resourceName;
	private $location;

	/**
	* @inheritdoc
	*/	
	public function getResourceType()
	{
		return $this->resourceType;
	}

	/**
	* @inheritdoc
	*/	
	public function setResourceType(ResourceTypeInterface $resourceType = null)
	{
		$this->resourceType = $resourceType;
	}
	
	/**
	* @inheritdoc
	*/	
	public function getName()
	{
		return $this->resourceName;
	}
	
	/**
	* @inheritdoc
	*/	
	public function setName($resourceName)
	{
		$this->resourceName = $resourceName;
	}
	
	/**
	* @inheritdoc
	*/	
	public function getCurrentLocation()
	{
		return $this->location;
	}
	
	/**
	* @inheritdoc
	*/	
	public function setCurrentLocation(LocationInterface $location = null)
	{
		$this->location = $location;
	}
}
