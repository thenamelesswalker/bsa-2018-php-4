<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:28
 */

namespace BinaryStudioAcademy\Game\Commands;


class HelpCommand extends AbstractCommand
{

    public function execute($arguments = []): string
    {
        return <<<TAG
help - показывает список доступных команд.
status - показывает информацию о кол-ве доступных ресурсов и какие части корабля еще не собраны.
build:<spaceship_module> - построить модуль корабля.
scheme:<spaceship_module> - вывести информацию/схему о том какие модули/ресурсы нужны, чтобы построить модуль.
mine:<resource_name> - добавить единицу ресурса(fire) в инвентарь/склад.
produce:<combined_resource> - произвести комбинированный ресурс(метал).
exit - выходит из игры.
TAG;

    }
}