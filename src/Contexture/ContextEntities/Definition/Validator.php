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
class Validator implements ValidatorInterface
{
	/**
	* @var \Closure
	*/
	private $closure;
	
	/**
	* Constructor
	* 
	* @param \Closure $closure
	* 
	*/
	public function __construct(\Closure $closure)
	{
		$this->closure = $closure;
	}
	
	/**
	* Validate the configuration
	* 
	* @param mixed $configuration
	* 
	* @return void
	* @throw
	*/
	public function validate($configuration)
	{
		$func = $this->closure;
		
		return $func($configuration);
	}
}
