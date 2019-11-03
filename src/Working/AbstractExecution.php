<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemTrait;
use Eki\NRW\Common\Timing\StartEndTimeTrait;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExecution implements ExecutionInterface
{
	use
		HasExecutionTypeTrait,
		HasObjectItemTrait,
		StartEndTimeTrait,
		ObjectStatesTrait
	;

	/**
	* @var string
	*/
	private $name;

	/**
	* @var mixed
	*/
	private $subject;

	/**
	* @var object
	*/
	private $engine;

	/**
	* Constructor
	* 
	* @param ExecutionTypeInterface|null $executionType
	* 
	*/	
	public function __construct(ExecutionTypeInterface $executionType = null)
	{
		$this->setExecutionType($executionType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchExecutionType(ExecutionTypeInterface $executionType)
	{
	}
	
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
	public function getSubject()
	{
		return $this->subject;
	}
	
	/**
	* @inheritdoc
	*/
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	
	/**
	* @inheritdoc
	*/
	public function getEngine()
	{
		return $this->engine;
	}
	
	/**
	* @inheritdoc
	*/
	public function setEngine($engine)
	{
		$this->engine = $engine;
	}
}
