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
 * A view that can embedded into another element.
 */
trait EmbedViewTrait
{
	private $isembed;
	
    /**
     * Sets the value as embed / not embed.
     *
     * @param bool $value
     */
    public function setIsEmbed($value)
    {
		$this->isEmbed = (bool)$value;
	}

    /**
     * Is the view an embed or not.
     *
     * @return bool True if the view is an embed, false if it is not.
     */
    public function isEmbed()
    {
		return $this->isEmbed;
	}
}
