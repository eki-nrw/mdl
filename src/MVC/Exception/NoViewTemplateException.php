<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Exception;

use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Exception;

/**
 * Thrown when a view is attempted to be rendered without a template set.
 */
class NoViewTemplateException extends Exception
{
    /**
     * @var View
     */
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
        parent::__construct(
            sprintf(
                "No view template was set to render the view with the '%s' view type. Check your view configuration.",
                $view->getViewType()
            )
        );
    }

    public function getView()
    {
        return $this->view;
    }
}
