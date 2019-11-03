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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait HasResourceTypeTrait
{
	/**
	* @var ResourceTypeInterface
	*/
	private $resourceType;
	
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
}
