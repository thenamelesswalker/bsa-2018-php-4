<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 06.07.18
 * Time: 3:00
 */

namespace BinaryStudioAcademy\Game\Factories;


use BinaryStudioAcademy\Game\Contracts\Resource\ResourceInterface;
use BinaryStudioAcademy\Game\Exceptions\ResourceNotFoundException;

class ResourceFactory
{
    public static function create(string $resource): ResourceInterface {
        $resourceClassName = 'BinaryStudioAcademy\\Game\\Resources\\' . ucfirst($resource) . "Resource";
        if(class_exists($resourceClassName)) {
            return new $resourceClassName();
        }
        throw new ResourceNotFoundException();
    }
}