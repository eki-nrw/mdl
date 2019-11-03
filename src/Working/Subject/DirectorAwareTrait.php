<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait DirectorAwareTrait
{
	protected $director;
	
	/**
	* Sets director
	* 
	* @param DirectorInterface $director
	* 
	* @return void
	*/
	public function setDirector(DirectorInterface $director = null)
	{
		$this->director = $director;
	}

	/**
	* Returns director
	* 
	* @return DirectorInterface
	*/
	protected function getDirector()
	{
		return $this->director;
	}
}
