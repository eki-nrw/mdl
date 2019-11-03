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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractImportor implements ImportorInterface
{
	use
		DirectorAwareTrait
	;
	
	public function __construct(DirectorInterface $director = null)
	{
		$this->setDirector($director);
	}

	/**
	* @inheritdoc
	*/
	public function support($data, $object)
	{
		return
			$this->supportSubject($object)
			AND
			$this->supportData($data)
		;	
	}
	
	/**
	* Checks if importor supports data
	* 
	* @param mixed $data
	* 
	* @return bool
	*/
	abstract protected function supportData($data);
	
	/**
	* Checks if importor supports subject
	* 
	* @param object $object
	* 
	* @return bool
	*/
	abstract protected function supportSubject($object);

	/**
	* @inheritdoc
	*/
	public function import($data, &$object, array $contexts = [])
	{
		if (!$this->support($data, $object))
			throw new \UnexpectedValueException(sprintf("Data and/or Object are not supported."));

		$_contexts = $this->_prepareContexts($contexts);
			
		$this->_import($data, $object, $_contexts);
	}	

	/**
	* Prepare contexts
	* 
	* @param array $contexts
	* 
	* @return array
	*/	
	protected function _prepareContexts(array $contexts)
	{
		return $contexts;
	}
	
	//abstract protected function _import(<Data Type> $data, <Object Type> &$object, array $contexts);
}
