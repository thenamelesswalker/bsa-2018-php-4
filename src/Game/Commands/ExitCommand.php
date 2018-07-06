<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:27
 */

namespace BinaryStudioAcademy\Game\Commands;


class ExitCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        $this->game->getGameManager()->forceFinish();
        return "";
    }
}