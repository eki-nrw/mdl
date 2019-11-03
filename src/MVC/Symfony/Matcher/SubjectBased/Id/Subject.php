<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Matcher\SubjectBased\Id;

use Eki\NRW\Mdl\MVC\Symfony\Matcher\SubjectBased\MultipleValued;
use Eki\NRW\Mdl\MVC\Symfony\View\SubjectView;
use Eki\NRW\Mdl\MVC\Symfony\View\View;

abstract class Subject extends MultipleValued
{
	/**
	* @var string
	*/
	protected $subjectClass;

	public function __construct($subjectClass)
	{
		if (!class_exists($subjectClass))
			throw new \InvalidArgumentException("No class $subjectClass exists.");
			
		$this->subjectClass = $subjectClass;
	}
	
    public function match(View $view)
    {
        if (!$view instanceof SubjectView) {
            return false;
        }
        
        $subject = $view->getSubject();

        return ($subject instanceof $this->subjectClass) and isset($this->values[$subject->getId()]);
    }
}
