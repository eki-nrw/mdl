<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Solution;

use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class DelegateSolution implements ContextInterface, SolutionInterface
{
	/**
	* @var ContextInterface
	*/
	protected $context;
	
	/**
	* @var SolutionInterface
	*/
	protected $solution;

	public function __construct(ContextInterface $context, SolutionInterface $solution)
	{
		$this->solution = $solution;
		$this->context = $context;
	}	
	
	/**
	* @inheritdoc
	* 
	*/
	public function accept($context)
	{
		return $this->solution->accept($context);
	}
		
	/**
	* @inheritdoc
	* 
	*/
	public function solve($context)
	{
		return $this->solution->solve($context);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function set($param, $value)
	{
		$this->context->set($param, $value);
		
		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function get($param)
	{
		return $this->context->get($param);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getContext()
	{
		return $this->context->getContext();
	}
	
	/**
	* Solve by parameters
	* 
	* @param array $params
	* 
	* @return mixed Context
	*/
	public function solveByParams(array $params)
	{
		foreach($params as $param => $paramValue)
		{
			$this->context->set($param, $paramValue);
		}
		
		return $this->solveInContext($this->context);
	}

	/**
	* The extension of solve function. The return of solving saved in the context to be used later.
	* 
	* @param mixed $context
	* 
	* @return mixed Context
	*/
	public function solveInContext($context)
	{
		$this->context = $this->solution->solve($context);
		
		return $this->context;
	}
}
