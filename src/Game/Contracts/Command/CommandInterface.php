<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:39
 */

namespace BinaryStudioAcademy\Game\Contracts\Command;


interface CommandInterface
{
    public function execute($arguments = []): string;
}