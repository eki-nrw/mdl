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

use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Registry implements RegistryInterface
{
	/**
	* @var SolutionInterface
	*/
	private $solution;
	
	/**
	* @var mixed
	*/
	private $arguments;
	
	public function __construct(SolutionInterface $solution, $arguments)
	{
		$this->solution = $solution;	
		$this->arguments = $arguments;
	}

	/**
	* @inheritdoc
	* 
	*/	
	public function getSolution()
	{
		return $this->solution;
	}

	/**
	* @inheritdoc
	* 
	*/	
	public function match($arguments)
	{
		return $this->solution->accept($arguments);
	}
}
