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

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\ForTestHandlerClass;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\WrongClass;

use PHPUnit\Framework\TestCase;

use stdClass;

class BaseActionHandlerTest extends TestCase
{
	public function getGoodConfigs()
	{
		return array(
			'1.1' => array(stdClass::class, 'define'),
			'1.2' => array(stdClass::class, 'prepare'),
			'1.3' => array(stdClass::class, 'approve'),

			'2.1' => array(stdClass::class, 'sing'),
			'2.2' => array(stdClass::class, 'speak'),
			'2.3' => array(stdClass::class, 'cry'),

			'3.1' => array(ForTestHandlerClass::class, 'any'),
			'3.2' => array(ForTestHandlerClass::class, 'thing'),
			'3.3' => array(ForTestHandlerClass::class, 'can'),
			'3.4' => array(ForTestHandlerClass::class, 'do'),
		);
	}

	public function getWrongConfigs()
	{
		return array(
			array(stdClass::class, 'defined'),
			array(stdClass::class, 'prepared'),
			array(stdClass::class, 'approved'),

			array(stdClass::class, 'song'),
			array(stdClass::class, 'speaks'),
			array(stdClass::class, 'cri'),

			array(ForTestHandlerClass::class, 'ani'),
			array(ForTestHandlerClass::class, 'things'),
			array(ForTestHandlerClass::class, 'cannot'),
			array(ForTestHandlerClass::class, 'does'),
			
			array(WrongClass::class, 'xxx'),
			array(WrongClass::class, 'define'),
			array(WrongClass::class, 'prepare'),
			array(WrongClass::class, 'approve'),
			array(WrongClass::class, 'sing'),
		);
	}
}
