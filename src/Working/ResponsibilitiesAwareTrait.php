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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait ResponsibilitiesAwareTrait
{
	/**
	* @var array(ResponsibilityInterface)
	*/
	private $responsibilities = [];
	
	/**
	* @inheritdoc
	*/
	public function getResponsibility($role)
	{
		if (isset($this->responsibilities[$role]))
			return $this->responsibilities[$role];
	}
	
	/**
	* @inheritdoc
	*/
	public function setResponsibility(ResponsibilityInterface $responsibility = null, $role = null)
	{
		if (null !== $responsibility)	
		{
			if (isset($this->responsibilities[$responsibility->getRole()]))
				throw new \InvalidArgumentException(sprintf(
					"Cannot override existing role %s. It must be set by null first.",
					$responsibility->getRole()
				));
			if ($role === $responsibility->getRole())
				throw new \InvalidArgumentException("Confuse of role.");
			
			$this->responsibilities[$responsibility->getRole()] = $responsibility;
		}
		else
		{
			if ($role === null)
				throw new \InvalidArgumentException("Cannot set responsibility null for role null.");
				
			if (isset($this->responsibilities[$role]))	
				unset($this->responsibilities[$role]);
		}
	}
	
	/**
	* @inheritdoc
	*/
	public function hasResponsibility($role)
	{
		return isset($this->responsibilities[$role]);
	}
	
	/**
	* @inheritdoc
	*/
	public function getResponsibilities()
	{
		return $this->responsibilities;
	}
	
	/**
	* @inheritdoc
	*/
	public function setResponsibilities(array $responsibilities)
	{
		$this->responsibilities = [];
		foreach($responsibilities as $responsibility)
		{
			if (!$responsibility instanceof ResponsibilityInterface)
				throw new \InvalidArgumentException(sprintf(
					"Responsibility object must be instance of %s. Given %s.",
					ResponsibilityInterface::class, get_class($responsibility)
				));	
				
			$this->responsibilities[$responsibility->getRole()] = $responsibility;
		}
	}
}
