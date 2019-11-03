<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Provider;

use Eki\NRW\Mdl\Processing\Solution\ProviderInterface;
use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Provider implements ProviderInterface
{
	/**
	* @var RegistryInterface[]
	*/
	private $registries;
	
	public function __construct(array $registries)
	{
		foreach($registries as $registry)
		{
			if (!$registry instanceof RegistryInterface)
				throw new \InvalidArgumentException(sprintf(
					"One of registries is not instance of %s. Given %s.",
					RegistryInterface::class,
					get_class($registry)
				));
		}
		
		$this->registries = $registries;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function provide($arguments)
	{
		foreach($this->registries as $registry)
		{
			if ($registry->match($arguments))
				return $registry->getSolution();
		}	
	}

	/**
	* @inheritdoc
	* 
	*/
	public function listing($arguments)
	{
		$solutions = [];
		foreach($this->registries as $registry)
		{
			if ($registry->match($arguments))
				$solutions[] = $registry->getSolution();
		}
		
		return $solutions;
	}
}
