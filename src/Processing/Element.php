<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Element implements ElementInterface
{
	/**
	* @var string
	*/
	protected $key;
	
	/**
	* @var mixed
	*/
	protected $subject;
	
	/**
	* @var Closure
	*/
	protected $validate = null;
	
	/**
	* @var Closure
	*/
	protected $getPayload = null;
	
	/**
	* @var mixed
	*/
	protected $branch;

	/**
	* @var FrameInterface
	*/
	protected $frame;
	
	public function __construct($key, $subject = null, Closure $validate = null, Closure $getPayload = null)
	{
		$this->setKey($key);
		$this->getPayload = $getPayload;
		$this->validate = $validate;
		$this->setSubject($subject);
	}
	
	/**
	* Returns the key of the element
	* 
	* @return string
	*/
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	* Sets key 
	* 
	* @param string $key
	* 
	* @return void
	*/
	public function setKey($key)
	{
		$this->key = $key;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getSubject()
	{
		return $this->subject;	
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setSubject($subject = null)
	{
		if (!$this->support($subject))
			throw new \InvalidArgumentException("Subject invalid.");
			
		$this->subject = $subject;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function support($subject)
	{
		if ($subject === null)
			return true;
			
		if ($this->validate === null)
			return true;
			
		$validate = $this->validate;
		return $validate($subject);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function payload($subject)
	{
		if (!$this->support($subject))
			throw new \InvalidArgumentException("Subject invalid.");
		
		if ($this->getPayload !== null)
		{
			$getPayload = $this->getPayload;
			return $getPayload($subject);
		}
	}

	/**
	* Returns the branch
	* 
	* @return mixed
	*/
	public function getBranch()
	{
		return $this->branch;
	}
	
	/**
	* Set branch
	* 
	* @param mixed $branch
	* @param array $contexts
	* 
	* @return void
	*/
	public function setBranch($branch, array $contexts = [])
	{
		$this->branch;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getFrame()
	{
		return $this->frame;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setFrame(FrameInterface $frame = null)
	{
		$this->frame = $frame;
	}
}
