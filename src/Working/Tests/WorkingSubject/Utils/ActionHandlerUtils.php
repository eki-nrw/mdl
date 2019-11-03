<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils;

use Eki\NRW\Mdl\Working\WorkingSubject\ActionHandlerInterface;
use Eki\NRW\Mdl\Working\WorkingSubject\AbstractActionHandler;

use PHPUnit\Framework\TestCase;

class ActionHandlerUtils
{
	public static function createIActionHandler(TestCase $testCase, $supportedClassname, array $supportedActionNames)
	{
		$actionHandler = $testCase->getMockBuilder(ActionHandlerInterface::class)
			->setMethods(['support', 'handle'])
			->getMockForAbstractClass()
		;
		
		$actionHandler->expects($testCase->any())
			->method('support')
			->will($testCase->returnCallback(function ($subject, $actionName) use ($supportedClassname, $supportedActionNames) {
				if (!$subject instanceof $supportedClassname)
					return false;
				if (!in_array($actionName, $supportedActionNames, true))
					return false;
				return true;
			}))
		;

		$actionHandler->expects($testCase->any())
			->method('handle')
			->will($testCase->returnCallback(function ($subject, $actionName, array $contexts = []) use ($actionHandler) {
				if (!$actionHandler->support($subject, $actionName))
					throw new \DomainException(sprintf(
						"Action Handler don;t support subject with class %s and action %s.",
						get_class($subject), $actionName
					));
			}))
		;
		
		return $actionHandler;
	}

	public static function createActionHandler(TestCase $testCase, array $supportedClassnames, array $supportedActionNames)
	{
		$methods = [];
		$methods[] = 'supportSubject';
		foreach($supportedActionNames as $actionName)
		{
			$methods[] = 'on'.ucfirst($actionName);
		}
		
		$actionHandler = $testCase->getMockBuilder(AbstractActionHandler::class)
			->setMethods($methods)
			->getMockForAbstractClass()
		;
		
		$actionHandler->expects($testCase->any())
			->method('supportSubject')
			->will($testCase->returnCallback(function ($subject) use ($supportedClassnames) {
				foreach($supportedClassnames as $classname)
				{
					if ($subject instanceof $classname)
						return true;
				}
				return false;
			}))
		;

		foreach($supportedActionNames as $actionName)
		{
			$actionHandler->expects($testCase->any())
				->method('on'.ucfirst($actionName))
				->will($testCase->returnCallback(function ($subject, array $contexts) use ($actionName, $testCase) {
					print self::getExpectOutputStringOnAction($subject, $actionName);
				}))
			;
		}

		return $actionHandler;
	}

	public static function getExpectOutputStringOnAction($subject, $actionName)
	{
		return "Do action " . "on".ucfirst($actionName) . "of subject class " . get_class($subject) . "\n";
	}
}
