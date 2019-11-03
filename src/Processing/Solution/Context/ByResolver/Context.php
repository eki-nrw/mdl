<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Context\ByResolver;

use Eki\NRW\Mdl\Processing\Solution\Context\AbstractContext;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Context extends AbstractContext implements ContextInterface
{
	/**
	* @var OptionsResolver;
	*/
	private $optionsResolver;
	
	public function __construct(array $init, Closure $resolver)
	{
		$this->optionsResolver = new OptionsResolver;
		$resolver($this->optionsResolver);
		$this->context = $this->optionsResolver->resolve($init);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function set($param, $value)
	{
		$this->context = $this->optionsResolver->resolve(
			array_merge(
				$this->context,
				array( $param => $value )
			)
		);
		
		return $this;
	}
}
