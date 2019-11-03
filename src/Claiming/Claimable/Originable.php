<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is origin to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Mdl\Claiming\OriginableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Originable implements OriginableInterface
{
	/**
	* @var mixed
	*/
	private $origin;
	
	/**
	* Constructor
	* 
	* @param mixed $origin
	* 
	*/
	public function __construct($origin)
	{
		$this->setOrigin($origin);		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getOrigin()
	{
		return $this->origin;		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setOrigin($origin = null)
	{
		$this->origin = $origin;		
	}
}
