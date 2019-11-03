<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Definition\Symfony;

use Eki\NRW\Mdl\Model\Definition\Symfony\Definition as BaseDefinition;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Definition extends BaseDefinition
{
	/**
	* Constructor
	* 
	* @param string $name
	* @param ConfigurationInterface|null $configuration
	* 
	*/
	public function __construct($name, ConfigurationInterface $configuration = null)
	{
		if ($configuration === null)
			$configuration = new Configuration();
			
		parent::__construct($name, $configuration);
	}
}
