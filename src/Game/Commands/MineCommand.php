<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:26
 */

namespace BinaryStudioAcademy\Game\Commands;


use BinaryStudioAcademy\Game\Factories\ResourceFactory;

class MineCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        try {
            $resource = ResourceFactory::create($arguments[0]);
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }

        $this->game->getGameManager()->addResource($resource);
        return "{$resource->getName()} added to inventory.";
    }
}