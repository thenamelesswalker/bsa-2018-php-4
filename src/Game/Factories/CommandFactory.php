<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 23:15
 */

namespace BinaryStudioAcademy\Game\Factories;


use BinaryStudioAcademy\Game\Contracts\Command\CommandInterface;
use BinaryStudioAcademy\Game\Exceptions\CommandNotFoundException;
use BinaryStudioAcademy\Game\Game;
use BinaryStudioAcademy\Game\Commands;

class CommandFactory
{
    public static function create(string $command, Game $invoker): CommandInterface {
        $commandClassName = 'BinaryStudioAcademy\\Game\\Commands\\' . ucfirst($command) . "Command";
        if(class_exists($commandClassName)) {
            return new $commandClassName($invoker);
        }
        throw new CommandNotFoundException($command);
    }
}