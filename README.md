Trip Planner
========================

Domain
========================

- Trip has a name and at least one Route
- Trip has an identity; a Route has a name, and an internal identity
- Route can have one or more Leg; a Leg has a Date and an internal identity
- A Route can't have two Leg with same Data
- A Leg has a Location; a Location has a name and a Point
- Point has coordinates and the logic for distance calculation
- The Route knows the approximate road distance
- A route could be duplicated
- A duplicated Route could be added to the Trip
- Trade-off: removed InternalIdentity value object
- Fix: Date::input should be a DateTime
- Trade-off: we need a custom Event Dispatcher
- Trade-off: getters on commands, for integration with form

Application
========================

- Command Handler: manages the flow "Command -> Use Case"
- CreateTrip Command and UseCase
- We need the Repository for Trip
- AddLegToRoute Command and UseCase
- UpdateLocation Command and UseCase
- We need validation: command validation using external service is a good trade-off
- Mmmh too many exceptions ... we need uniform responses
- Finally Events and Event Dispatcher

Infrastructure
========================

- Framework's revenge: Symfony 2.5 and Doctrine 2.5
- InfrastructureBundle
- Mapping entities and value objects ... ops, Doctrine seems not work with a Value Object (with strategy auto) as identity for another entity
- Configuring services and creating Infrastructure services: Repository, Adapter for Validator, Validation ... ops, the Symfony's dispatcher does not fit


Presentation
========================

- A simple controller with a form
- Symfony2 Form requires getters for the mapped entity