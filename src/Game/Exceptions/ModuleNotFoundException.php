<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:57
 */

namespace BinaryStudioAcademy\Game\Exceptions;


use Throwable;

class ModuleNotFoundException extends \Exception
{
public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
{
    parent::__construct($message, $code, $previous);
    $this->message = "There is no such spaceship module.";
}
}