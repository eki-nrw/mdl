<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is boundary to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Context\SupportStrategy\SupportStrategyInterface;;

use InvalidArgumentException;

/**
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Registry implements RegistryInterface
{
	private $contexts = array();
	
	/**
	* @inheritdoc
	* 
	*/
	public function add(ContextInterface $context, SupportStrategyInterface $supportStrategy)
	{
        $this->contexts[] = array($context, $supportStrategy);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function get($boundary, $contextName = null)
	{
		$this->validateBoundary($boundary);
		
        $matched = null;

        foreach ($this->contexts as list($context, $supportStrategy)) {
            if ($this->supports($context, $supportStrategy, $boundary, $contextName)) {
                if ($matched) {
                    throw new InvalidArgumentException('At least two contexts match this boundary. Set a different name on each and use the second (name) argument of this method.');
                }
                $matched = $context;
            }
        }

        if (!$matched) {
            throw new InvalidArgumentException(sprintf('Unable to find a context for class "%s".', get_class($boundary)));
        }

        return $matched;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getAll($boundary)
	{
		$this->validateBoundary($boundary);

        $matched = array();

        foreach ($this->contexts as list($context, $supportStrategy)) 
        {
        	if ($supportStrategy->supports($context, $boundary))
                $matched[] = $context;
        }

        return $matched;
	}

    private function supports(
    	ContextInterface $context, 
    	SupportStrategyInterface $supportStrategy, 
    	$boundary, 
    	$contextName
    )
    {
		$this->validateBoundary($boundary);
		
        if (null !== $contextName && $contextName !== $context->getName()) 
        {
            return false;
        }

        return $supportStrategy->supports($context, $boundary);
    }
    
    private function validateBoundary($boundary)
    {
		if (!is_object($boundary))
			throw new InvalidArgumentException("Boundary must be an object.");
	}
}
