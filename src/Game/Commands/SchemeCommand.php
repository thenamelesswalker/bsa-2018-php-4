<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:27
 */

namespace BinaryStudioAcademy\Game\Commands;


use BinaryStudioAcademy\Game\Factories\ModuleFactory;

class SchemeCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        try {
            $module = ModuleFactory::create($arguments[0]);
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
        return "{$module->getName()} => " . strtolower(implode('|', $this->game->getGameManager()->getModuleScheme($module->getName())));
    }
}