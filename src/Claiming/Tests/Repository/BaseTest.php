<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Tests\Repository;

use Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
	/**
	* @var string
	*/
	protected $setupFactoryClass;
	
	/**
	* @var \Eki\NRW\Mdl\Claiming\Tests\Repository\SetupFactory
	*/
	private $setupFactory;
	
	/**
	* @var \Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface
	*/
	private $repository;
	
    protected function setUp()
    {
        parent::setUp();

        try {
            // Use setup factory instance here w/o clearing data in case test don't need to
            $repository = $this->getSetupFactory()->getRepository(false);
        } catch (PDOException $e) {
            $this->fail(
                'The communication with the database cannot be established. ' .
                "This is required in order to perform the tests.\n\n" .
                'Exception: ' . $e
            );
        } catch (Exception $e) {
            $this->fail(
                'Cannot create a repository with predefined user. ' .
                'Check the UserService or RoleService implementation. ' .
                PHP_EOL . PHP_EOL .
                'Exception: ' . $e
            );
        }
    }

    /**
     * Resets the temporary used repository between each test run.
     */
    protected function tearDown()
    {
        $this->repository = null;
        parent::tearDown();
    }
	
	/**
	* 
	* @param bool $initialInitializeFromScratch Only has an effect if set in first call within a test
	* 
	* @return \Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface
	*/
	protected function getRepository($initialInitializeFromScratch = true)
	{
		if (null === $this->repository)
		{
			$this->repository =$this->getSetupFactory()->getRepository($initialInitializeFromScratch);
		}
		
		return $this->repository;
	}
	
	/**
	* 
	* 
	* @return \Eki\NRW\Mdl\Claiming\Tests\Repository\SetupFactory
	*/
	protected function getSetupFactory()
	{
		if (null === $this->setupFactory)
		{
			if (null === $this->setupFactoryClass)
			{
	            if (false === isset($_ENV['setupFactory'])) {
	                throw new \ErrorException(
	                    'Missing mandatory setting $_ENV["setupFactory"], this should normally be set in the relevant phpunit-integration-*.xml file and refer to a setupFactory for the given StorageEngine/SearchEngine in use'
	                );
	            }

	            $setupClass = $_ENV['setupFactory'];
	            if (false === class_exists($setupClass)) {
	                throw new \ErrorException(
	                    sprintf(
	                        '$_ENV["setupFactory"] does not reference an existing class: %s. Did you forget to install an package dependency?',
	                        $setupClass
	                    )
	                );
	            }
			}
			else
			{
				$setupClass = $this->setupFactoryClass;				
			}

            $this->setupFactory = new $setupClass();
        }
		
		return $this->setupFactory;
	}
}
