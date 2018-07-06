<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 06.07.18
 * Time: 3:07
 */

namespace BinaryStudioAcademy\Game\Factories;


use BinaryStudioAcademy\Game\Contracts\CompositeResorce\CompositeResourceInterface;
use BinaryStudioAcademy\Game\Exceptions\CompositeResourceNotFoundException;

class CompositeResourceFactory
{
    public static function create(string $compositeResource): CompositeResourceInterface {
        $compositeResourceClassName = 'BinaryStudioAcademy\\Game\\CompositeResources\\' . ucfirst($compositeResource) . "CompositeResource";
        if(class_exists($compositeResourceClassName)) {
            return new $compositeResourceClassName();
        }
        throw new CompositeResourceNotFoundException();
    }
}