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

class BClass {
	protected $typeObj;
	public function __construct(BType $typeObj)
	{
		$this->typeObj = $typeObj;
	}
	
	public function getType()
	{
		return $this->typeObj;
	}
}
