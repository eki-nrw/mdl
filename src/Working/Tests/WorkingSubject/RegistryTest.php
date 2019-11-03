<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubject\Registry;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\RegistryUtils;

use PHPUnit\Framework\TestCase;

use stdClass;
use DomainException;

class RegistryTest extends TestCase
{
	public function testAction()
	{
		$registry = RegistryUtils::createRegistry($this, 'working.type');
	}
}
