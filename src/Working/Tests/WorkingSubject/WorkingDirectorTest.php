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

use Eki\NRW\Mdl\Working\WorkingSubject\WorkingDirector;
use Eki\NRW\Mdl\Working\WorkingSubject\WorkingSubject;

use Eki\NRW\Mdl\Working\Subject\Director as SubjectDirector;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\TestWorkflowHandler;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\TestActionHandler;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\RegistryUtils;

use PHPUnit\Framework\TestCase;
use stdClass;

class WorkingDirectorTest extends TestCase
{
	public function testDirectorAllRegistriesAreObject()
	{
		$director = new WorkingDirector(
			array(
				RegistryUtils::createRegistry($this, 'working.type.1'),		
				RegistryUtils::createRegistry($this, 'working.type.2'),		
				RegistryUtils::createRegistry($this, 'working.type.3'),		
				RegistryUtils::createRegistry($this, 'working.type.4'),		
			),
			new SubjectDirector(array())
		);
	}

	public function testDirectorAllRegistriesAreArray()
	{
		$director = new WorkingDirector(
			array(
				array(
					'type' => 'w.t.1', 
					'workflow' => TestWorkflowHandler::class, 
					'action' => TestActionHandler::class, 
					//'working_subject' => WorkingSubject::class, 
				),
			),
			new SubjectDirector(array())
		);
	}
}
