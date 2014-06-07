<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class Trip
{
    private $name;
    private $routes;

    private function __construct($name, Route $route)
    {
        $this->name = $name;
        $this->routes = new ArrayCollection(array($route));
    }

    public function create($name)
    {
        return new self($name, new Route);
    }

    public function getRoutes()
    {
        return $this->routes;
    }
} 