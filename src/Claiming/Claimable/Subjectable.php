<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Mdl\Claiming\SubjectableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Subjectable implements SubjectableInterface
{
	/**
	* @var mixed
	*/
	private $subject;
	
	private $subjectCode;
	
	/**
	* Constructor
	* 
	* @param mixed $subject
	* 
	*/
	public function __construct($subject)
	{
		$this->setSubject($subject);		
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
		$this->subject = $subject;		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getSubjectCode()
	{
		if ($this->subject === null)
			return null;
		else
		{
			if ($this->subjectCode === null)
			{
				$this->subjectCode = spl_object_hash($this->subject);
			}
			
			return $this->subjectCode;
		}	
	}
}
