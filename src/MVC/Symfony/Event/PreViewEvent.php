<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Event;

use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Symfony\Component\EventDispatcher\Event;

/**
 * The PreViewEvent allows you to inject additional parameters to a subject view template.
 * To do this, get the SubjectView object and add it what you need as params :.
 *
 * <code>
 * $view = $event->getView();
 * // Returns the location when applicable (viewing a location basically)
 * if ( $view->hasParameter( 'location' ) )
 *     $location = $view->getParameter( 'location' );
 *
 * // Subject is always available.
 * $subject = $view->getParameter( 'subject' );
 *
 * // Set your own variables that will be exposed in the template
 * // The following will expose "foo" and "complex" variables in the view template.
 * $view->addParameters(
 *     array(
 *         'foo'     => 'bar',
 *         'complex' => $someObject
 *     )
 * );
 * </code>
 */
class PreViewEvent extends Event
{
    /**
     * @var \Eki\NRW\Mdl\MVC\Symfony\View\View
     */
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\View
     */
    public function getView()
    {
        return $this->view;
    }
}
