<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:26
 */

namespace BinaryStudioAcademy\Game\Commands;


use BinaryStudioAcademy\Game\Factories\CompositeResourceFactory;

class ProduceCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        try {
            $resource = CompositeResourceFactory::create($arguments[0]);
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
        $needed = $this->game->getGameManager()->getUnavaliableResources($resource->getName());
        if([] == $needed) {
            $this->game->getGameManager()->addCompositeResource($resource);
            $needed = $this->game->getGameManager()->getNeededResourcesForCompositeResource($resource->getName());
            foreach ($needed as $value) {
                $this->game->getGameManager()->removeResource($value);
            }
            return "{$resource->getName()} added to inventory.";
        }
        return "You need to mine: " . strtolower(implode(',',$needed)) . '.';
    }
}