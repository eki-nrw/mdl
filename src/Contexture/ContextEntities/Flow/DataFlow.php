<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Flow;

/**
* Data flow implementation
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class DataFlow implements DataFlowInterface
{
	/**
	* @var string
	*/
	protected $name;
	
	/**
	* @var mixed
	*/
	protected $data;

	/**
	* @var \Closure
	*/
	private $validator;
	
	/**
	* @var \Closure
	*/
	private $checker;

	/**
	* Constructor
	* 
	* @param string $name
	* @param \Closure $validator
	* @param \Closure $checker
	* 
	*/
	public function __construct($name, \Closure $validator = null, \Closure $checker = null)
	{
		$this->name = $name;
		$this->validator = $validator;
		$this->checker = $checker;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setData($data = null)
	{
		if ($data !== null and $this->validator !== null)
		{
			$validator = $this->validator;
			if ($validator($data) !== true)
				throw new \InvalidArgumentException("Data invalid.");
		}
		
		$this->data = $data;
		
		return $this;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function can($fromEntity, $toEntity)
	{
		if ($this->checker !== null)
		{
			$checker = $this->checker;
			if ($checker($fromEntity, $toEntity) === true)
				return true;
		}
		
		return false;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function flow($fromEntity, $toEntity, array $options = [])
	{
		if ($this->data === null)
			throw new \InvalidArgumentException("You must set data first by 'setData'");
		
		if($this->guard($this->data, $fromEntity, $toEntity, $options) === false)
			return $this;
		
		$this->before($this->data, $fromEntity, $toEntity, $options);
		
		$this->in($this->data, $fromEntity, $toEntity, $options);

		$this->after($this->data, $fromEntity, $toEntity, $options);
		
		return $this;
	}

	/**
	* This is the opportunity to prevent flow
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @return bool
	*/
	protected function guard($data, $fromEntity, $toEntity, array $options)
	{
		return true;
	}
	
	/**
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @return void
	*/
	protected function before($data, $fromEntity, $toEntity, array $options)
	{
		//...	
	}
	
	/**
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @return void
	*/
	protected function in($data, $fromEntity, $toEntity, array $options)
	{
		//...
	}
	
	/**
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @return void
	*/
	protected function after($data, $fromEntity, $toEntity, array $options)
	{
		//...
	}
}
