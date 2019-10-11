# Structural Design Patterns

[Introduction to Structural Design Patterns](https://www.gofpatterns.com/design-patterns/module5/intro-structural-designPatterns.php)

## List of Structural Design Patterns

1. Adapter: Adapts one interface for a class into one that a client expects
1. Bridge: Decouple an abstraction from its implementation so that the two can vary independently
1. Composite: A tree structure of objects where every object has the same interface
1. Decorator : Add additional functionality to a class at runtime where sub-classing would result in an exponential rise of new classes
1. Facade: Create a simplified interface of an existing interface to ease usage for common tasks
1. Flyweight: A high quantity of objects share a common properties object to save space
1. Proxy: A class functioning as an interface to another thing

## Sub-Patterns

1. Aggregate: A version of the Composite pattern with methods for aggregation of children
1. Extensibility: also known as Framework - hide complex code behind a simple interface
1. Pipes and filters: A chain of processes where the output of each process is the input of the next
1. Private class data: Restrict accessor/mutator access

### Backed up Vehicles Intersection - Exercise

**Objective**: Write a class that contains the vehicles currently backed up at the intersection.
The next piece of the traffic flow system is to write a class that creates the vehicle queues at the intersection. This class should be named `VehicleQueue`. One `VehicleQueue` class should be sufficient with different instances for different directions. The basic structure of the class is shown in this diagram:

UML diagram containing the VehicleQueue class.

VehicleQueue

- parameters:

  - theQueue (array)
  - queueLength = 0 (float? or int?)
  - vehiclesPerSecond (float)
  - theFactory (VehicleFactory)

- methods

  - \_\_constructor(float vehiclesPerSecond, VehicleFactory theFactory)
  - enter(): void
  - leave(): void
  - getLength(): float
  - getSize(): int
  - list(): void

The `theFactory` attribute is the creator class that is responsible for creating individual vehicles. It decides what the likelihood is of a particular vehicle appearing in this queue. The `vehiclesPerSecond` attribute is a floating point number between 0 and 1. It determines the likelihood that a vehicle (of any type) appears in this queue in any given second. The `enter()` method is called each second. The `leave()` method is invoked whenever the corresponding light is green.

As well as the attributes and operations documented here, you will need to provide a means of storing and manipulating the list of cars.
In Java 1.1 the `Vector` class is useful, though not terribly efficient for this purpose. In Java 1.2 the `LinkedList` class is a much safer bet. In C++, the standard templates library can be helpful. I have deliberately left the type of the Queue unspecified so you can use whatever is convenient in your environment.

Each `Queue` object knows the chance of a vehicle entering the queue at an arbitrary time slice. Each queue is further parameterized with a `VehicleFactory` object that understands the chances of the different vehicles entering the queue at any time. When the `enter()` method is invoked, a random number function is called to determine whether or not to add a new vehicle to the queue. When the light turns green, the `leave()` method is invoked as many times as possible. We are not quite ready, yet, however, to actually invoke the queuing functions. That will have to wait for the `Timer` class and Observer pattern used later in the course.

1. The `getLength()` method returns the total length in meters of the queue; that is the sum of the lengths of the individual vehicles.
1. The `getSize()` method, by contrast, returns the number of vehicles in the queue. Finally, `list()` is a method intended mostly for debugging that prints the list of vehicles in the queue on the console.
