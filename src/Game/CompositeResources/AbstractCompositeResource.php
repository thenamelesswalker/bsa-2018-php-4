<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:32
 */

namespace BinaryStudioAcademy\Game\CompositeResources;


use BinaryStudioAcademy\Game\Contracts\CompositeResorce\CompositeResourceInterface;

class AbstractCompositeResource implements CompositeResourceInterface
{
    protected $name = "";

    public function getName(): string
    {
        return $this->name;
    }
}