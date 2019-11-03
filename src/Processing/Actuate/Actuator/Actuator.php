<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Actuate\Actuator;

use Eki\NRW\Mdl\Processing\Actuate\ActuatorInterface;
use League\Pipeline\Pipeline;
use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Actuator implements ActuatorInterface
{
	protected $inputSubjectChecker = null;
	protected $materialUnpacker;
	protected $materialChecker = null;
	protected $outputSubjectChecker = null;
	protected $producer;
	protected $productPacker;
	
	/**
	* Constructor
	* 
	* @param Closure $materialUnpacker
	* 
	* @param Closure $producer
	* @param Closure $productPacker
	* @param Closure $inputSubjectChecker
	* @param Closure $materialChecker
	* @param Closure $outputSubjectChecker
	* 
	*/
	public function __construct(
		Closure $materialUnpacker,
		Closure $producer,
		Closure $productPacker,
		Closure $inputSubjectChecker = null,
		Closure $materialChecker = null,
		Closure $outputSubjectChecker = null
	)
	{
		$this->materialUnpacker = $materialUnpacker;
		$this->producer = $producer;
		$this->productPacker = $productPacker;
		$this->inputSubjectChecker = $inputSubjectChecker;
		$this->materialChecker = $materialChecker;
		$this->outputSubjectChecker = $outputSubjectChecker;
	}

	/**
	* Return the typeof the actuator
	* 
	* @return string
	*/
	static public function getType()
	{
		return static::TYPE;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function actuating(array $inputs, array $contexts)
	{
		$pipeline = (new Pipeline)
			->pipe(new UnpackStage)
			->pipe(new ProduceStage)
		;
		
		$payload = $pipeline->process(array(
			'contexts' => $contexts,
			'inputSubjectChecker' => $this->inputSubjectChecker,
			'materialUnpacker' => $this->materialUnpacker,
			'materialChecker' => $this->materialChecker,
			'producer' => $this->producer,
			'inputs' => $inputs,
		));
		
		return $payload['product'];
	}

	/**
	* @inheritdoc
	* 
	*/
	public function pack(array $outputs, $actuatedResult, array $contexts)
	{
		$pipeline = (new Pipeline)
			->pipe(new PackStage)
		;
		
		$payload = $pipeline->process(array(
			'contexts' => $contexts,
			'outputs' => $outputs,
			'product' => $actuatedResult,
			'outputSubjectChecker' => $this->outputSubjectChecker,
			'productPacker' => $this->productPacker
		));
		
		return $payload['outputs'];
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function acceptInput($inputSubject, array $contexts = [])
	{
		if ($this->inputSubjectChecker !== null)
		{
			$checker = $this->inputSubjectChecker;
			return $checker($inputSubject, $contexts);
		}
		else
			return true;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function acceptOutput($outputSubject, array $contexts = [])
	{
		if ($this->outputSubjectChecker !== null)
		{
			$checker = $this->outputSubjectChecker;
			return $checker($outputSubject, $contexts);
		}
		else
			return true;
	}
}
