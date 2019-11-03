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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractResourceType implements ResourceTypeInterface
{
	use
		HasPropertiesTrait,
		HasOptionsTrait,
		HasAttributesTrait
	;
	
	private $name;
	
	/**
	* @inheritdoc
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* @inheritdoc
	*/
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	* @inheritdoc
	*/
	public function getDefaultUnitAlias()
	{
		
	}
	
	/**
	* @inheritdoc
	*/
	public function setDefaultUnitAlias($unitAlias)
	{
		
	}
}
