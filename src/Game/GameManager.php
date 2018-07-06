<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 22:22
 */

namespace BinaryStudioAcademy\Game;


use BinaryStudioAcademy\Game\Contracts\CompositeResorce\CompositeResourceInterface;
use BinaryStudioAcademy\Game\Contracts\Module\ModuleInterface;
use BinaryStudioAcademy\Game\Contracts\Resource\ResourceInterface;

class GameManager
{
    private $resourcesInventory = [];
    private $compositResourcesInventory = [];
    private $modulesInventory = [];

    private $settings = [];

    private $finished = false;
    private $forceFinish = false;

    public function __construct($settings = [])
    {
        $this->settings = $settings;
        if ($settings === []) {
            $this->settings = $this->getDefaultSettings();
        }
    }

    public function addResource(ResourceInterface $resource): void
    {
        $this->resourcesInventory[] = $resource;
    }

    public function addCompositeResource(CompositeResourceInterface $resource): void
    {
        $this->compositResourcesInventory[] = $resource;
    }

    public function addModule(ModuleInterface $module): void
    {
        $this->modulesInventory[] = $module;
    }

    public function haveResource(string $itemName): bool
    {
        foreach ($this->resourcesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                return true;
            }
        }
        return false;
    }

    public function haveCompositeResource(string $itemName): bool
    {
        foreach ($this->compositResourcesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                return true;
            }
        }
        return false;
    }

    public function haveModule(string $itemName): bool
    {
        foreach ($this->modulesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                return true;
            }
        }
        return false;
    }

    public function removeResource(string $itemName): void
    {
        foreach ($this->resourcesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                fprintf(STDOUT, "[%s]", $value->getName());
                unset($this->resourcesInventory[$key]);
                break;
            }
        }
    }

    public function removeCompositeResource(string $itemName): void
    {
        foreach ($this->compositResourcesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                unset($this->compositResourcesInventory[$key]);
                break;
            }
        }
    }

    public function removeModule(string $itemName): void
    {
        foreach ($this->modulesInventory as $key => $value) {
            if ($value->getName() == $itemName) {
                unset($this->modulesInventory[$key]);
                break;
            }
        }
    }

    public function getNeededResourcesForModule(string $itemName): array
    {
        return $this->settings["Modules"][$itemName]["Resources"];
    }

    public function getNeededCompositeResourcesForModule(string $itemName): array
    {
        return $this->settings["Modules"][$itemName]["CompositeResources"];
    }

    public function getNeededModulesForModule(string $itemName): array
    {
        return $this->settings["Modules"][$itemName]["Modules"];
    }

    public function getNeededResourcesForCompositeResource(string $itemName): array
    {
        return $this->settings["CompositeResources"][$itemName]["Resources"];
    }

    public function getResourcesCount(): array
    {
        $resourcesCount = [];
        $resourcesNames = array_merge(array_map(function ($n) {
            return $n->getName();
        }, $this->resourcesInventory), array_map(function ($n) {
            return $n->getName();
        }, $this->compositResourcesInventory));
        foreach ($resourcesNames as $value) {
            if (isset($resourcesCount[$value])) {
                $resourcesCount[$value]++;
            } else {
                $resourcesCount[$value] = 1;
            }
        }
        return $resourcesCount;
    }

    public function getBuiltModulesNames(): array
    {
        return array_map(function ($n) {
            return $n->getName();
        }, $this->modulesInventory);
    }

    public function getNeedToBuildModulesNames(): array
    {
        return array_diff($this->settings["Win"]["Modules"], array_map(function ($n) {
            return $n->getName();
        }, $this->modulesInventory));
    }

    public function getModuleScheme(string $moduleName): array {
        return array_merge($this->settings["Modules"][$moduleName]["Modules"],
            $this->settings["Modules"][$moduleName]["CompositeResources"],
            $this->settings["Modules"][$moduleName]["Resources"]);
    }

    public function getUnavaliableItemsForModule(string $itemName): array {
        $neededResources = array_diff($this->settings["Modules"][$itemName]["Resources"], array_map(function ($n) {
            return $n->getName();
        }, $this->resourcesInventory));
        $neededCompositeResources = array_diff($this->settings["Modules"][$itemName]["CompositeResources"], array_map(function ($n) {
            return $n->getName();
        }, $this->compositResourcesInventory));
        $neededModules = array_diff($this->settings["Modules"][$itemName]["Modules"], array_map(function ($n) {
            return $n->getName();
        }, $this->modulesInventory));
        return array_unique(array_merge($neededCompositeResources, $neededResources, $neededModules));
    }

    public function getUnavaliableResources(string $itemName): array {
        return array_diff($this->settings["CompositeResources"][$itemName]["Resources"], array_map(function ($n) {
            return $n->getName();
        }, $this->resourcesInventory));
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished) {
        $this->finished = $finished;
    }

    public function isForceFinished(): bool {
        return $this->forceFinish;
    }

    public function forceFinish(): void
    {
        $this->forceFinish = true;
    }

    public function checkWin(): bool
    {
        return [] == array_diff($this->settings["Win"]["Modules"], array_map(function ($n) {
                return $n->getName();
            }, $this->modulesInventory));
    }

    public function getDefaultSettings(): array
    {
        return [
            "Win" => [
                "Modules" => ["Shell", "Porthole", "Control_unit", "Engine", "Launcher", "Tank"]
            ],
            "CompositeResources" => [
                "Metal" => [
                    "Resources" => ["Iron", "Fire"]
                ]
            ],
            "Modules" => [
                "Shell" => [
                    "Resources" => ["Fire"],
                    "CompositeResources" => ["Metal"],
                    "Modules" => []
                ],
                "Porthole" => [
                    "Resources" => ["Sand", "Fire"],
                    "CompositeResources" => [],
                    "Modules" => []
                ],
                "Control_unit" => [
                    "Resources" => [],
                    "CompositeResources" => [],
                    "Modules" => ["Ic", "Wires"]
                ],
                "Engine" => [
                    "Resources" => ["Carbon", "Fire"],
                    "CompositeResources" => ["Metal"],
                    "Modules" => []
                ],
                "Launcher" => [
                    "Resources" => ["Water", "Fire", "Fuel"],
                    "CompositeResources" => [],
                    "Modules" => []
                ],
                "Tank" => [
                    "Resources" => ["Fuel"],
                    "CompositeResources" => ["Metal"],
                    "Modules" => []
                ],
                "Ic" => [
                    "Resources" => ["Silicon"],
                    "CompositeResources" => ["Metal"],
                    "Modules" => []
                ],
                "Wires" => [
                    "Resources" => ["Copper", "Fire"],
                    "CompositeResources" => [],
                    "Modules" => []
                ]
            ]
        ];
    }
}