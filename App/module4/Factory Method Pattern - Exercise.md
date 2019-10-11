# Factory Method Pattern

## Abstract Vehicle Class - Exercise

**Objective**: Write an abstract Vehicle class. In this exercise, you will write an abstract Vehicle class that has the structure shown in this diagram:

- UML diagram

Vehicle

- properties:

  - speed = 0
  - maxSpeed
  - length

- methods:

  - getSpeed(): double
  - getMaxSpeed(): double
  - getLength(): double
  - accelerate(deltaV: double): void \}
  - decelerate(deltaV: double): void \} {0 \<= speed \<= maxSpeed}
  - toString(): string

- The accelerate() and decelerate() methods should be used to change the speed. However, they are subject to the constraints that the
  speed is always greater than or equal to zero and less than or equal to maxSpeed.

- Attempts to increase speed above maxSpeed or decrease it below 0 should simply pin the speed to the boundaries.
- Note that this class is quite general and can actually describe pedestrians as well.

See Vehicle.php

## Concrete Subclasses - Exercise

- <https://www.gofpatterns.com/design-patterns/module4/factory-method-structure.php>
- <https://www.gofpatterns.com/design-patterns/module4/concrete-subclasses-exercise.php>

**Objective**: Write four concrete subclasses of the Vehicle class.

In this exercise, you will develop concrete subclasses for the Vehicle class, the Bus, Car, Pedestrian, and Bicycle. These are the parameters for the four classes:

1. The **Car** class should be 6.0 meters long and have a maximum speed of 120 kilometres per hour.
1. The **Bus** class should be 18 meters long with a maximum speed of 92 kilometres per hour.
1. The **Bicycle** class should be 1.5 meters long with a maximum speed of 25 kilometres per hour.
1. The **Pedestrian** class should have a length of 0 (pedestrians tend to bunch up side by side at intersections rather than queue in line) and a maximum speed of 4 kilometres per hour.

For all of these, all you need to do is define the appropriate class with the necessary constructor that sets the values as specified. A more complex simulation might also add additional behaviour to these subclasses, but we will not need that for our simple project.

## Vehicle Factory Consequences- Exercise

Vehicle Factory Class

**Objective**:Write an abstract class called VehicleFactory.

In this exercise, you will continue building your course project by creating an abstract class called VehicleFactory which is shown in this diagram:

UML diagram

VehicleFactory

- properties:

  - chanceCar
  - chanceBus
  - chanceBicycle
  - chancePedestrian

- methods:

  - \_\_constructor(float chanceCar, float chanceBus, float chanceBicycle, float chancePedestrian)
  - createVehicle(): AbstractVehicle

It is conventional to provide concrete subclasses that return particular kinds of vehicles, such as `BusFactory`, `CarFactory`, `BicycleFactory`, etc. However, we are going to need something just a little different. Instead, instances of this Factory will return instances of different vehicle subclasses with different frequencies. The exact percentages should be set in a constructor. However, there should also be a no args constructor. For the defaults:

1. Use an 80% probability of a Car with a 10% probability of either a Bus or a Bicycle.
2. Enforce a constraint that the sum of the chances of all the different vehicle types is less than or equal to 1.0 (100%) and that no single chance is less than 0% (no negative probabilities)

Eventually, this **Factory** class will be used to create vehicles that appear at the intersection of our simulation.
As additional kinds of vehicles are added later, only this class needs to change. Neither the pre-existing vehicle classes nor the client classes that invoke `createVehicle()` need to change.
Note that this is an abstract class with an abstract `createVehicle()` method. This method will be filled in later in subclasses.

## Write Creational Classes for the Course Project

As the final part of the creational classes for the course project, you will need a concrete implementation of the abstract `VehicleFactory` class. In this module, you will write about the simplest such class imaginable.

In the next module we will add one more subclass of VehicleFactory that also uses the Flyweight structural pattern and has some interesting implications for performance in systems with many objects.

### Summary of Creational Patterns

1. The Factory Pattern is used to choose and return an instance of a class from a number of similar classes based on data you provide to the factory.
2. The Abstract Factory Pattern is used to return one of several groups of classes. In some cases it actually returns a Factory for that group of classes.
3. The Builder Pattern assembles a number of objects to make a new object, based on the data with which it is presented. Frequently, the choice of which way the objects are assembled is achieved using a Factory.
4. The Prototype Pattern copies or clones an existing class rather than creating a new instance when creating new instances is more expensive.
5. The Singleton Pattern is a pattern that insures there is one and only one instance of an object, and that it is possible to obtain global access to that one instance.

## ConcreteVehicleFactory Class - Exercise

**Objective**: Write creational classes for the course project.

Write a concrete subclass of `VehicleFactory` called (obviously enough) `ConcreteVehicleFactory` which is shown in this UML diagram:

Class diagram for the ConcreteVehicleFactory

ConcreteVehicleFactory

- methods:

  - \_\_contractor(float chanceCar, float chanceBus, float chanceBicycle, float chancePedestrian)
  - createVehicle(): AbstractVehicle

<https://www.gofpatterns.com/design-patterns/module4/factory-module-conclusion.php>
