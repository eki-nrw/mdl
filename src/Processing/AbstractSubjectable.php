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
abstract class AbstractSubjectable implements SubjectableInterface
{
	private $subject;
	
	public function getSubject()
	{
		return $this->subject;
	}
	
	public function setSubject($subject = null)
	{
		$this->subject = $subject;
	}
}
