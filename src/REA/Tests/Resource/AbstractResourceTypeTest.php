<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Tests\Resource;

use Eki\NRW\Mdl\REA\Resource\AbstractResourceType;
use Eki\NRW\Mdl\REA\Resource\ResourceTypeInterface;

use PHPUnit\Framework\TestCase;

class AbstractResourceTypeTest extends TestCase
{
	private $resourceType;
	
	public function setUp()
	{
    	$this->resourceType = $this->getMockBuilder(AbstractResourceType::class)->getMockForAbstractClass();
	}
	
	public function tearDown()
	{
		$this->resourceType = null;
	}
	
    public function testName()
    {
    	$resourceType = $this->resourceType;
    	
    	$this->assertEmpty($resourceType->getName());
    	
    	$resourceType->setName('resource type name');
    	
    	$this->assertSame($resourceType->getName(), 'resource type name');
    }
}
