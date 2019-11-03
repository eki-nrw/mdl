<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View;

/**
 * Renders a View to a string representation.
 * 
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface Renderer
{
    /**
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return string
     */
    public function render(View $view);
}

