<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\ByStep;

use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Step implements StepInterface
{
	/**
	* @var string
	*/
	private $key;
	
	/**
	* @var Closure
	*/
	private $running;
	
	/**
	* @var AlgorightmInterface
	*/
	private $algorithm;
	
	public function __construct(Closure $running, $key = null)
	{
		$this->running = $running;
		$this->key = $key;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getKey()
	{
		return $this->key;		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function run(ContextInterface &$context)
	{
		$running = $this->running;
		return $running($context);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setAlgorithm(AlgorithmInterface $algorithm)
	{
		$this->algorithm = $algorithm;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getAlgorithm()
	{
		return $this->algorithm;		
	}
}
