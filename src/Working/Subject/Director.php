<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

use Eki\NRW\Mdl\Working\ObjectBuilderInterface;
use Eki\NRW\Common\Res\Factory\Factory;
use Eki\NRW\Common\Res\Factory\DelegateFactory;
use Eki\NRW\Common\Res\Factory\Registry as FactoryRegistry;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Director implements DirectorInterface
{
	/**
	* 
	* @var DelegateFactory
	* 
	*/
	private $delegateFactory;
	
	/**
	* @var CallbackInterface[]
	*/
	private $callbacks = [];
	
	/**
	* @var DelegateImportor
	*/
	private $delegateImportor;
	
	/**
	* @var DelegateValidator
	*/
	private $delegateValidator;
	
	/**
	* @var DelegateSubjectTypeGetter
	*/
	private $delegateSubjectTypeGetter;
	
	/**
	* @var string
	*/
	private $subjectBuilderClass;
	
	/**
	* @var ObjectBuilderInterface[]
	*/
	private $builders = [];
	
	/**
	* Constructor
	* 
	* @param array|Registry[] $registries
	* @param string $factoryClass
	* @param string $subjectBuilderClass
	* 
	*/
	public function __construct(
		array $registries,  // array of registries or Registry objects
		$subjectBuilderClass = BaseObjectBuilder::class
	)
	{
		if (!class_exists($subjectBuilderClass))
			throw new \InvalidArgumentException("Subject class $subjectBuilderClass not exists.");
			
		$this->subjectBuilderClass = $subjectBuilderClass;
		
		$replaceRegistries = [];
		foreach($registries as $registry)
		{
		    if (is_array($registry))
		    {
				$this->checkArrayRegistry($registry);
		    
		    	$factoryInfo = isset($registry['factory']) ? $registry['factory'] : null;
				$replaceRegistries[] = new Registry(
					$registry['type'], 
					$registry['subject'],
					$registry['callback'],
					$registry['importor'],
					$registry['validator'],
					$factoryInfo
				);
			}
			else if (is_object($registry))
			{
				if (!$registry instanceof Registry)
					throw new \InvalidArgumentException(sprintf(
						"Registry must be instance of %s. Given %s.",
						Registry::class, get_class($registry)
					));
				$replaceRegistries[] = $registry;	
			}
			else
				throw new \InvalidArgumentException("Registry of Director must be array or object.");
		}
		$registries = $replaceRegistries;

		$importors = [];		
		$validators = [];		
		$factoryRegistries = [];
		$dfactories = [];
		$subjectTypeGetters = [];
		foreach($registries as $registry)
		{
			// callback
			$callback = $registry->getCallbackInfo();
			if (is_string($callback))
				$callback = new $callback();
			if ($callback->getCallbackType() !== $registry->getType())
			{
				throw new \InvalidArgumentException(sprintf(
					"Callback type and registry type must are the same. Given '%s' in callback class '%s'. " . "Given '%s' in registry.", 
					$callback->getCallbackType(),
					get_class($callback),
					$registry->getType()
				));
			}
			$this->callbacks[$callback->getCallbackType()] = $callback;
			
			// importor
			$__importors = [];
			foreach($registry->getImportorInfo() as $importor)
			{
				if (is_string($importor))
				{
					$__importors[] = new $importor();
				}
				else //if (is_object($importor))
				{
					$__importors[] = $importor;
				}
			}
			$importors[] = new DelegateImportor($__importors);
				
			// validator
			$validator = $registry->getValidatorInfo();
			if (is_string($validator))
				$validator = new $validator();
			$validators[] = $validator;

			// factory
			$factoryInfo = $registry->getFactoryInfo();
			if (null === $factoryInfo)
			{
				$factoryRegistries[] = new FactoryRegistry(
					$registry->getType(), 
					$registry->getSubjectInfo()
				);
			}
			else if (is_object($factoryInfo))
			{
				$dfactories[] = $factoryInfo;
			}
			else if (is_string($factoryInfo))
			{
				$dfactories[] = new $factoryInfo;
			}
			
			// Subjet type getter
			$subjectTypeGetters[] = new SubjectTypeGetter(
				$registry->getSubjectInfo(),
				function ($subject) use ($registry) {
					return $registry->getType();
				}
			);
		}

		$this->delegateImportor = new DelegateImportor($importors);
		$this->delegateValidator = new DelegateValidator($validators);
		
		$dfactories = array_unique($dfactories);
		if (!empty($factoryRegistries))
			$dfactories[] = new Factory($factoryRegistries);
		$this->delegateFactory = new DelegateFactory($dfactories);
		$this->delegateSubjectTypeGetter = new DelegateSubjectTypeGetter($subjectTypeGetters);
	}

	private function checkArrayRegistry(array $registry)
	{
    	$requiredIndice = [];
    	if (!isset($registry['type']))
    		$requiredIndice['type'] = 'type';
    	if (!isset($registry['subject']))
    		$requiredIndice['subject'] = 'subject';
    	if (!isset($registry['callback']))
    		$requiredIndice['callback'] = 'callback';
    	if (!isset($registry['importor']))
    		$requiredIndice['importor'] = 'importor';
    	if (!isset($registry['validator']))
    		$requiredIndice['validator'] = 'validator';

		if (!empty($requiredIndice))
    		throw new \InvalidArgumentException(
    			"Registry is array that must have index [ " . implode(", ", array_values($requiredIndice)) . " ]"
    		);
	}
	
	/**
	* @inheritdoc
	*/
	public function getBuilder($type)
	{
		if (!$this->support($type))
			throw new \UnexpectedValueException("Director don't support type $type.");
			
		if (!isset($this->builders[$type]))
		{
			$builder = new $this->subjectBuilderClass(
				$this->delegateFactory,
				$this->callbacks[$type],
				$this->delegateImportor,
				$this->delegateValidator,
				$this->delegateSubjectTypeGetter,
				$type
			);
			
			$this->builders[$type] = $builder;
		}
		
		return $this->builders[$type];
	}

	/**
	* @inheritdoc
	*/
	public function support($type)
	{
		if ($this->delegateFactory->support($type) === true)
			return true;
			
		return false;
	}
}
