<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\ParametersInjector;

/**
 * Configures a View object.
 *
 * Example: set the template, add extra parameters.
 */
interface Configurator
{
    public function configure(View $view);
}
