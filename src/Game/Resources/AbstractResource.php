<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:31
 */

namespace BinaryStudioAcademy\Game\Resources;


use BinaryStudioAcademy\Game\Contracts\Resource\ResourceInterface;

abstract class AbstractResource implements ResourceInterface
{

    protected $name = "";

    public function getName(): string
    {
       return $this->name;
    }
}