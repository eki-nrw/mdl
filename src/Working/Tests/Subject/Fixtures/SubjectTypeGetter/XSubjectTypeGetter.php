<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Fixtures\Subject\SubjectTypeGetter;

class XSubjectTypeGetter implements SubjectTypeGetterInterface
{
	public function support($subject)
	{
		return true;	
	}
	
	public function getSubjectType($subject)
	{
		if ($subject instanceof XClass)
		{
			return $subject->getXType()->getType();
		}
		else
			return 'a.b.c';
	}	
}
