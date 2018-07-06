<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Factories\CommandFactory;

class Game
{
    protected $gameManager = null;

    public function __construct(GameManager $gameManager = null)
    {
        $this->gameManager = $gameManager ?? new GameManager();
    }

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln("You need to build spaceship. Type help for avaliable commands.");
        do {
            $writer->write("Command: ");
            $this->run($reader, $writer);
            if ($this->gameManager->isForceFinished()) {
                break;
            }
        } while (true);

    }

    public function getGameManager(): ?GameManager
    {
        return $this->gameManager;
    }

    public function run(Reader $reader, Writer $writer): void
    {
        $input = trim($reader->read());
        $arguments = explode(":", $input);
        $command = array_shift($arguments);

        try {
            $commandInstance = CommandFactory::create($command, $this);
            $message = $commandInstance->execute($arguments);
            if($this->gameManager->checkWin()) {
                if(!$this->gameManager->isFinished()) {
                    $message .= " => You won!";
                    $this->gameManager->setFinished(true);
                }
            }
            $writer->writeln($message);
        } catch (\Exception $e) {
            $writer->writeln($e->getMessage());
        }
    }
}
