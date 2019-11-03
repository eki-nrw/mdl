<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Common\Variables\HasVariablesTrait;
use Eki\NRW\Common\Common\Variables\VariablesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractBuildingSubject implements BuildingSubjectInterface, ObjectBuilderAwareInterface
{
	use
		HasVariablesTrait
	;
	
	/**
	* @var object
	*/
	private $subject;
	
	/**
	* @var string
	*/
	private $subjectType;
	
	/**
	* @var ObjectBuilderInterface
	*/
	protected $objectBuilder;
	
	/**
	* @inheritdoc
	*/
	public function setObjectBuilder(ObjectBuilderInterface $objectBuilder = null)
	{
		$this->objectBuilder = $objectBuilder;
		$this->setVariables(new Variables());
	}
	
	/**
	* @inheritdoc
	*/
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	* @inheritdoc
	*/
	public function setSubject($subject)
	{
		if (null !== $subject)
		{
			if ($this->getSubject() !== null)
				throw new RuntimeException('Cannot set subject twice');
		}
			
		$this->subject = $subject;
		if ($this->objectBuilder !== null)
			$this->objectBuilder->setObject($subject);

		return $this;
	}

	/**
	* @inheritdoc
	*/	
	public function setSubjectType($subjectType)
	{
		if (null !== $subjectType)
		{
			if ($this->getSubjectType() !== null)
				throw new RuntimeException('Cannot set subject type twice');
		}
			
		$this->subjectType = $subjectType;
		if ($this->objectBuilder !== null)
			$this->objectBuilder->setObjectType($subjectType);

		return $this;
	}
	
	protected function getSubjectType()
	{
		return $this->subjectType;
	}
	
	/**
	* @inheritdoc
	*/
	public function define($data, array $contexts = [])
	{
		$object = $this->objectBuilder
			->import($data, $contexts)
			->build()
		;
		
		if ($this->getSubject() !== null)
		{
			$this->setSubject(null);
		}
		$this->setSubject($object);

		return $this;
	}

	/**
	* @inheritdoc
	*/
	public function add($name, $type = null, $data)
	{
		if ($this->objectBuilder !== null)
			$this->objectBuilder->add($name, $type, $data);
		
		return $this;
	}
	
	/**
	* @inheritdoc
	*/
	public function reset()
	{
		$this->setSubject(null);
		$this->setSubjectType(null);
		$this->getVariables()->setVariables([]);
		if (null !== $this->objectBuilder)
			$this->objectBuilder->reset();
			
		return $this;
	}
}
