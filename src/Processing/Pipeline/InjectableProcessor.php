<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Pipeline;

use League\Pipeline\ProcessorInterface;

class InjectableProcessor implements ProcessorInterface
{
    /**
     * @var callable
     */
    private $inject;

    /**
     * InjectableProcessor constructor.
     *
     * @param callable $inject
     */
    public function __construct(callable $inject)
    {
        $this->inject = $inject;
    }

    /**
     * @param array $stages
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process(array $stages, $payload)
    {
        foreach ($stages as $stage) {
            $payload = call_user_func($this->inject, $payload));
            $payload = call_user_func($stage, $payload);
        }

        return $payload;
    }
}
