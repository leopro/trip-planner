<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;
use Leopro\TripPlanner\Domain\Exception\ResourceNotFoundException;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class Trip
{
    private $identity;
    private $name;

    /**
     * @var \Leopro\TripPlanner\Domain\Entity\Route[]
     */
    private $routes;

    private function __construct(TripIdentity $identity, $name)
    {
        $this->identity = $identity;
        $this->name = $name;
        $this->routes = new ArrayCollection();
    }

    public static function createWithFirstRoute(TripIdentity $identity, $name)
    {
        $trip = new self($identity, $name);
        $trip->routes->add(Route::create($trip->name));

        return $trip;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute($routeId)
    {
        foreach ($this->routes as $route) {
            if ($routeId == $route->getInternalIdentity()) {
                return $route;
            }
        }

        throw new ResourceNotFoundException(sprintf('Route with identity \'%s\' not found', $routeId));
    }

    public function duplicateRoute($routeId)
    {
        $route = $this->getRoute($routeId);
        $this->routes->add($route->duplicate());
    }
} 