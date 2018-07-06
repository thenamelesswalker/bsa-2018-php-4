<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:25
 */

namespace BinaryStudioAcademy\Game\Commands;


use BinaryStudioAcademy\Game\Contracts\Command\CommandInterface;
use BinaryStudioAcademy\Game\Game;

abstract class AbstractCommand implements CommandInterface
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    abstract public function execute($arguments = []): string;
}