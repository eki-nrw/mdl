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
interface PipableInterface
{
	/**
	* Checks the pipable can pipe to other pipe
	* 
	* @return bool
	*/
	public function canPipe();

	/**
	* Pipe to
	* 
	* @param PipableInterface $toPipe
	* @param string|null $toKey
	* @param array $contexts
	* 
	* @return bool True if successful. False if not.
	* 
	* @throws
	* 
	*/
	public function pipe(PipableInterface $toPipe, $toKey, array $contexts = []);

	/**
	* Checks the pipable can pipe from other pipe
	* 
	* @param string|null $key
	* @param ElementInterface $inElement
	* @param aray $contexts
	* 
	* @return bool
	*/
	public function canPipeIn($key, ElementInterface $inElement, array $contexts);
	
	/**
	* Main Pipe function
	* 
	* @param string|null $key
	* @param ElementInterface $inElement
	* @param aray $contexts
	* 
	* @return bool
	* 
	* @throws
	*/	
	public function pipeIn($key, ElementInterface $inElement, array $contexts);
}
