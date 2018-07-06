<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 06.07.18
 * Time: 3:10
 */

namespace BinaryStudioAcademy\Game\Exceptions;


class CompositeResourceNotFoundException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
{
    parent::__construct($message, $code, $previous);
    $this->message = "No such resource.";
}
}