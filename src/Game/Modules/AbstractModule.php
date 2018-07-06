<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:35
 */

namespace BinaryStudioAcademy\Game\Modules;


use BinaryStudioAcademy\Game\Contracts\Module\ModuleInterface;

class AbstractModule implements ModuleInterface
{
    protected $name = "";

    public function getName(): string
    {
        return $this->name;
    }
}