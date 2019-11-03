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
class DelegateImportor implements ImportorInterface
{
	/**
	* 
	* @var ImportorInterface[]
	* 
	*/
	private $importors = [];
	
	public function __construct(array $importors)
	{
		foreach($importors as $importor)
		{
			if (!$importor instanceof ImportorInterface)
				throw new \InvalidArgumentException("Importor must be instance of ImpoterInterface");
				
			$this->importors[] = $importor;
		}
	}
	
	/**
	* @inheritdoc
	*/
	public function support($data, $object)
	{
		foreach($this->importors as $importor)
		{
			if ($importer->support($data, $object))
				return true;
		}
	}
	
	/**
	* @inheritdoc
	*/
	public function import($data, &$object, array $contexts = [])
	{
		foreach($this->importors as $importor)
		{
			if ($importer->support($data, $object))
			{
				return $this->import($data, $object, $contexts);				
			}
		}
	}
}
