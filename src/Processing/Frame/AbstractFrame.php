<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame;

use Eki\NRW\Mdl\Processing\Storage\StorageInterface;
use Eki\NRW\Mdl\Processing\Storage\Storage;
use Eki\NRW\Mdl\Processing\Storage\HasStorageTrait;
use Eki\NRW\Mdl\Processing\ActuateTrait;
use Eki\NRW\Mdl\Processing\ActuateResultByStorageTrait;
use Eki\NRW\Mdl\Processing\PipableTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractFrame implements FrameInterface
{
	const FRAME_TYPE = "frame";
	
	use
		HasStorageTrait,
		ActuateTrait,
		ActuateResultByStorageTrait,
		PipableTrait
	;

	/**
	* @var string
	*/
	protected $type;

	public function __construct(StorageInterface $storage = null)
	{
		if ($storage === null)
			$storage = new Storage();
		$this->setStorage($storage);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getFrameInput()
	{
		return $this->storage->getInputs();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getFrameOutput()
	{
		return $this->storage->getOutputs();
	}

	/**
	* @inheritdoc
	* 
	*/
	public static function getFrameType()
	{
		return static::FRAME_TYPE;		
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getType()
	{
		return $this->type;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setType($type)
	{
		$this->type = $type;
	}
}
