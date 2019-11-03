<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Process\Event\Transform;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait TransformsAwareTrait
{
	/**
	* @var array
	*/
	protected $transforms = [];
	
	/**
	* @inheritdoc
	*/
	public function getTransforms()
	{
		return $this->transforms;
	}
	
	/**
	* @inheritdoc
	*/
	public function setTransforms(array $transforms)
	{
		foreach($transforms as $key => $transform)
		{
			if (!$transform instanceof TransformInterface)
				throw new \InvalidArgumentException(sprintf(
					"One of transforms with key %s is not instance of %s. Given %s.",
					$key,
					TransformInterface::class,
					get_class($transform)
				));		
		}

		$this->transforms = [];
		foreach($transforms as $key => $transform)
		{
			$this->addTransform($transform, $key);
		}
	}
	
	/**
	* @inheritdoc
	*/
	public function addTransform(TransformInterface $transform, $key = 'default')
	{
		if (in_array($transform, array_values($this->transforms), true))
			throw new \InvalidArgumentException('Cannot add twice the same transform.');	
		
		if (isset($this->transforms[$key]))
			throw new \InvalidArgumentException(sprintf('Key %s already exists.', $key));	
		
		$this->transforms[$key] = $transform;
	}
	
	/**
	* @inheritdoc
	*/
	public function removeTransform(TransformInterface $transform)
	{
		if (!in_array($transform, array_values($this->transforms), true))
			throw new \LogicException('No transform to remove.');
		
		foreach($this->transforms as $key => $traceTransform)
		{
			if ($traceTransform === $transform)
			{
				unset($this->transforms[$key]);
				return;
			}
		}
	}

	/**
	* @inheritdoc
	*/
	public function removeTransformByKey($key = 'default')
	{
		if (!isset($this->transforms[$key]))
			throw new \InvalidArgumentException("No transform with key $key to remove.");
			
		unset($this->transforms[$key]);
	}

	/**
	* @inheritdoc
	*/
	public function getTransform($key)
	{
		if (!$this->hasTransform($key))
			throw new \InvalidArgumentException("No transform with key $key to get.");
			
		return $this->transforms[$key];
	}

	/**
	* @inheritdoc
	*/
	public function hasTransform($key)
	{
		return isset($this->transforms[$key]);
	}
}

