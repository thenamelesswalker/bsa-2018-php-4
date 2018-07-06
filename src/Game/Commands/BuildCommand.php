<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:26
 */

namespace BinaryStudioAcademy\Game\Commands;


use BinaryStudioAcademy\Game\Factories\ModuleFactory;

class BuildCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        try {
            $module = ModuleFactory::create($arguments[0]);
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
        if($this->game->getGameManager()->haveModule($module->getName())) {
            return "Attention! {$module->getName()} is ready.";
        }
        $needed = $this->game->getGameManager()->getUnavaliableItemsForModule($module->getName());
        if([] == $needed) {
            $this->game->getGameManager()->addModule($module);

            $needed = $this->game->getGameManager()->getNeededResourcesForModule($module->getName());
            foreach ($needed as $value) {
                $this->game->getGameManager()->removeResource($value);
            }
            $needed = $this->game->getGameManager()->getNeededCompositeResourcesForModule($module->getName());
            foreach ($needed as $value) {
                $this->game->getGameManager()->removeCompositeResource($value);
            }
            $needed = $this->game->getGameManager()->getNeededModulesForModule($module->getName());
            foreach ($needed as $value) {
                $this->game->getGameManager()->removeModule($value);
            }
            return "{$module->getName()} is ready!";
        }
        return "Inventory should have: " . strtolower(implode(',',$needed)) . '.';
    }
}