<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubjectInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractActionHandler implements ActionHandlerInterface
{
	/**
	* @var string
	*/
	private $workingType;

	/**
	* @inheritdoc
	* 
	*/
	public function getWorkingType()
	{
		return $this->workingType;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setWorkingType($workingType)
	{
		$this->workingType = (string)$workingType;
	}
}
