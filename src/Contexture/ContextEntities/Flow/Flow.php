<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Flow;

use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\MatcherInterface;

/**
* Incoming Data flow
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Flow implements FlowInterface
{
	/**
	* @var string
	*/
	protected $name;
	
	/**
	* @var MatcherInterface
	*/
	protected $dataMatcher;
	
	/**
	* @var DataFlowInterface
	*/
	protected $dataFlow;

	public function __construct(
		$name,
		MatcherInterface $dataMatcher,
		DataFlowInterface $dataFlow
	)
	{
		$this->name = $name;
		$this->dataMatcher = $dataMatcher;
		$this->dataFlow = $dataFlow;
	}

	/**
	* Returns the name of the flow
	* 
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function acceptData($data)
	{
		return $this->dataMatcher->match($data);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function canFlow($fromEntity, $toEntity)
	{
		return $this->dataFlow->can($fromEntity, $toEntity);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function flow($data, $fromEntity, $toEntity, array $options = [])
	{
		if (!$this->acceptData($data))
			return;
			
		$this->dataFlow
			->setData($data)
			->flow($fromEntity, $toEntity, $options)
			->setData()
		;	
	}
}
