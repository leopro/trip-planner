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

Application
========================

- Command Handler: manages the flow "Command -> Use Case"
- CreateTrip Command and UseCase
- We need the Repository for Trip
- AddLegToRoute Command and UseCase
- UpdateLocation Command and UseCase
- We need validation: command validation using external service is a good trade-off
