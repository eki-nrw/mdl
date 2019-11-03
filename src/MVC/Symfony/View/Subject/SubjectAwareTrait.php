<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait SubjectAwareTrait
{
	/**
	* @var mixed
	*/
	private $subject;
	
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
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
}
