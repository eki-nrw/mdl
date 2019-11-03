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

use Eki\NRW\Common\Res\Factory\FactoryInterface;
//use Eki\NRW\Mdl\Working\SubjectTypeGetterInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class BaseObjectBuilder extends AbstractObjectBuilder
{
	/**
	* @var string
	*/
	private $builderName;

	/**
	* @var FactoryInterface
	*/
	protected $factory;
	
	/**
	* 
	* @var SubjectTypeGetterInterface
	* 
	*/
	protected $subjectTypeGetter;
	
	/**
	* Constructor
	* 
	* @param FactoryInterface $factory
	* @param CallbackInterface $callback
	* @param ImportorInterface $importor
	* @param ValidatorInterface $validator
	* @param string $builderName
	*/
	public function __construct(
		FactoryInterface $factory,
		CallbackInterface $callback,
		ImportorInterface $importor,
		ValidatorInterface $validator,
		SubjectTypeGetterInterface $subjectTypeGetter,
		$builderName = 'base'
	)
	{
		$this->builderName = $builderName;
		
		//if (null !== $callback and null === $callback->getBuilder())
		//	$callback->setBuilder($this);

		$this->factory = $factory;
		$this->subjectTypeGetter = $subjectTypeGetter;
		
		parent::__construct($callback, $importor, $validator);
	}

	/**
	* @inheritdoc
	*/
	protected function supportObjectType($objectType)
	{
		return $this->factory->support($objectType);
	}
	
	/**
	* @inheritdoc
	*/
	protected function supportObject($object)
	{
		return $this->factory->support($this->subjectTypeGetter->getSubjectType($object));
	}

	/**
	* @inheritdoc
	*/
	protected function createObject($objectType)
	{
		return $this->factory->createNew($objectType);
	}
	
	public function getBuilderName()
	{
		return $this->builderName;
	}
}
