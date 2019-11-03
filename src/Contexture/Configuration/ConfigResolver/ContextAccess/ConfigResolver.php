<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Configuration\ConfigResolver\ContextAccess;

use Eki\NRW\Mdl\Contexture\Configuration\ConfigResolver\ConfigResolver as BaseConfigResolver;
use Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccess;
use Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccessAware;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
class ConfigResolver extends BaseConfigResolver implements ContextAccessAware
{
    use 
    	ContainerAwareTrait
    ;

    /**
     * @var \Eki\NRW\Contexting\ContextAccess\ContextAccess
     */
    protected $contextAccess;

    public function setContextAccess(ContextAccess $contextAccess = null)
    {
        $this->contextAccess = $contextAccess;
    }

    public function getDefaultScope()
    {
        return $this->defaultScope ?: $this->contextAccess->name;
    }
}
