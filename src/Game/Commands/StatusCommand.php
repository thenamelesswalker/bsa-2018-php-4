<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:29
 */

namespace BinaryStudioAcademy\Game\Commands;


class StatusCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        $status = "You have: " . PHP_EOL;
        $resourcesCount = $this->game->getGameManager()->getResourcesCount();
        foreach ($resourcesCount as $resourceName => $count) {
            $status .= "{$resourceName} - {$count}" . PHP_EOL;
        }
        $status .= "Parts ready: " . PHP_EOL . implode(PHP_EOL, $this->game->getGameManager()->getBuiltModulesNames());
        $status .= "Parts to build: " . PHP_EOL . implode(PHP_EOL, $this->game->getGameManager()->getNeedToBuildModulesNames());
        return $status;
    }
}