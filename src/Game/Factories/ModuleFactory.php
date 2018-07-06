<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 06.07.18
 * Time: 0:08
 */

namespace BinaryStudioAcademy\Game\Factories;


use BinaryStudioAcademy\Game\Contracts\Module\ModuleInterface;
use BinaryStudioAcademy\Game\Exceptions\ModuleNotFoundException;

class ModuleFactory
{
    public static function create(string $module): ModuleInterface {
        $moduleClassName = 'BinaryStudioAcademy\\Game\\Modules\\' . ucfirst($module) . "Module";
        if(class_exists($moduleClassName)) {
            return new $moduleClassName();
        }
        throw new ModuleNotFoundException();
    }
}