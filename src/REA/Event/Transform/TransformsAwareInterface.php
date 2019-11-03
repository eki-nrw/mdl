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
interface TransformsAwareInterface
{
	/**
	* Returns all transform
	* 
	* @return array(TransformInterface)
	*/
	public function getTransforms();
	
	/**
	* Sets all transforms
	*  
	* @param array $transforms Associative array of TransformInterface
	* 
	* @return void
	* @throws \InvalideArgumentException
	*/
	public function setTransforms(array $transforms);
	
	/**
	* Add an transform
	* 
	* @param TransformInterface $transform
	* @param string $key
	* 
	* @return void
	* @throws \InvalideArgumentException
	*/
	public function addTransform(TransformInterface $transform, $key = 'default');
	
	/**
	* Remove existing transform
	* 
	* @param TransformInterface $transform
	* 
	* @return void
	* @throws \LogicException
	*/
	public function removeTransform(TransformInterface $transform);

	/**
	* Remove existing transform
	* 
	* @param TransformInterface $transform
	* 
	* @return void
	* @throws \InvalideArgumentException
	*/
	public function removeTransformByKey($key = 'default');
	
	/**
	* Gets transform with key
	* 
	* @param string $key
	* 
	* @return TransformInterface
	* @throws \InvalideArgumentException
	*/
	public function getTransform($key);
	
	/**
	* Checks if there is a transform of key
	* 
	* @param string $key
	* 
	* @return bool
	*/
	public function hasTransform($key);
}
