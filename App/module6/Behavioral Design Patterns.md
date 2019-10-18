# Behavioral Design Patterns

## Examples of Behavioral Design Patterns

1. **Chain of responsibility pattern**: Command objects are handled or passed on to other objects by logic-containing processing objects
1. **Command pattern**: Command objects encapsulate an action and its parameters
1. **Externalize the Stack**: Turn a recursive function into an iterative one that uses a stack.
1. **Hierarchical visitor pattern**: Provide a way to visit every node in a hierarchical data structure such as a tree.
1. **Interpreter pattern**: Implement a specialized computer language to rapidly solve a specific set of problems
1. **Iterator pattern**: Iterators are used to access the elements of an aggregate object sequentially without exposing its underlying representation
1. **Mediator pattern**: Provides a unified interface to a set of interfaces in a subsystem
1. **Memento pattern**: Provides the ability to restore an object to its previous state (rollback)
1. **Null Object pattern**: designed to act as a default value of an object
1. **Observer pattern**: aka Publish/Subscribe or Event Listener. Objects register to observe an event that may be raised by another object
1. **Weak reference pattern**: De-couple an observer from an observable.
1. **Protocol stack**: Communications are handled by multiple layers, which form an encapsulation hierarchy.
1. **Scheduled-task pattern**: A task is scheduled to be performed at a particular interval or clock time (used in real-time computing)
1. **Single-serving visitor pattern**: Optimise the implementation of a visitor that is allocated, used only once, and then deleted
1. **Specification pattern**: Re-combinable Business logic in a boolean fashion
1. **State pattern**: A clean way for an object to partially change its type at runtime
1. **Strategy pattern**: Algorithms can be selected on the fly
1. **Template method pattern**: Describes the program skeleton of a program
1. **Visitor pattern**: A way to separate an algorithm from an object

## Testing Interface - Exercise

**Objective**: Run a test on your Vehicle classes.

We are close to finishing the course project. Only two major classes remain. The `Timer` class will serve as a central clock for the rest of the system. The `SignalMediator` class will manage the state of the different traffic lights. These will be developed later in the module, using two behavioral patterns.
For this exercise, you will run a test on the Vehicle classes you have already created. To do so, you will write a program that:

1. Creates a VehicleQueue
1. Inserts 100 vehicles in the queue
1. Prints out the total length of the queue, the number of vehicles in the queue, and a list of vehicles in the queue.

## Common Behavioral Patterns

Other behavioral object patterns are concerned with encapsulating behaviour in an object and delegating requests to it.

1. The Strategy pattern encapsulates an algorithm in an object and makes it easy to specify and change the algorithm an object uses.
1. The Command pattern encapsulates a request in an object so that it can be passed as a parameter, stored on a history list, or manipulated in other ways.
1. The State pattern encapsulates the states of an object so that the object can change its behaviour when its state object changes.
1. Visitor encapsulates behaviour that would otherwise be distributed across classes, and
1. Iterator abstracts the way you access and traverse objects in an aggregate.

**Chain of Responsibility Pattern** describes a system in which different objects each receive an opportunity to handle a request.

**Command Pattern** wraps requests from one object to another within a class. This allows requests to be easily stored, queued, and undone.

**Iterator Pattern** describes an abstract means of passing through each of the elements in a collection, whether that collection is a set, a list, an array, a hash table, or some other data structure.

**Mediator Pattern** allows many different objects of the same or different classes that need to communicate with each other to each communicate only with a single, central mediator.

**Observer Pattern** allows an Observer object to notice and react to changes in an Observed object. Each observed object maintains a list of Observers and notifies each of them whenever its relevant state changes.

**Strategy Pattern** allows different algorithms to be incorporated into different classes. The algorithms can then be changed dynamically at runtime and adjusted to fit the needs of a specific situation.

**Visitor Pattern** lets you define a new operation without changing the classes of the elements on which it operates.

## Observed Object - Exercise

**Objective**: Write a `Time` class as an Observed object.

Rewrite the Time class from Module three so that it adheres to both the Singleton and the Observed pattern. This class should simply count seconds for an amount of time given in the constructor. Each second, it should notify registered observers of the current time using their timeChanged() method.

When you are finished, the class should look like this:

Class **Time**

- properties

  - currentTime
  - endOfTime

- methods
  - \_\_constructor(int endOfTime)
  - getInstance(): Time
  - init(endOfTime): void
  - run(): void
  - addTimeObserver(): void
  - removeTimeObserver(): void

The run() method increments the currentTime, and notifies each registered listener of that change.

## Write Time Class as an Observed Object

There are many variations on the Observer pattern. Three of the more common variations are:

1. To make the associated classes concrete. It is often quite easy to make the `Observed` class concrete, especially if you only plan on having one Observer. The main advantage of making the `Observed` class abstract is that different classes can share the same list management logic.
1. To require the `Observed` object to pass the changed state to the Observer object's update() method.
1. To manipulate exactly which state changes trigger notifications. It may be the case that not all changes of state are of equal interest to Observers. For instance, an object observing a word processing document may care a great deal if the user types a new letter, but not much at all if they merely scroll the screen up or down.

So far, I have implicitly assumed a multicast model for the `Observed` object; that is, a change to a single `Observed` object may result in notifications to an indefinite number of objects. Occasionally, you may want to use a unicast model that only allows a single Observer object to be registered with one `Observed` object at a time.

A **_typical_** observer is an object with interest or dependency in the state of the subject. A subject can have more than one such observer and each of these observers needs to know when the subject undergoes a change in its state.

The subject cannot maintain a static list of such observers as the list of observers for a given subject could change dynamically. Hence any object with interest in the state of the subject needs to explicitly register itself as an observer with the subject. Whenever the subject undergoes a change in its state, it notifies all of its registered observers. Upon receiving notification from the subject, each of the observers queries the subject to synchronize its state with that of the subject's. Thus a subject behaves as a publisher by publishing messages to all of its subscribing observers.

In other words, the scenario contains a one-to-many relationship between a subject and the set of its observers. Whenever the subject instance undergoes a state change, all of its dependent observers are notified and they can update themselves. Each of the observer objects has to register itself with the subject to get notified when there is a change in the subject's state. An observer can register or subscribe with multiple subjects. Whenever an observer does not wish to be notified any further, it unregisters itself with the subject. For this mechanism to work:

- The subject should provide an interface for registering and unregistering for change notifications
- One of the following two must be true:

  - In the pull model: The subject should provide an interface that enables observers to query the subject for the required state information to update their state.
  - In the push model: The subject should send the state information that the observers may be interested in.

- Observers should provide an interface for receiving notifications from the subject.

## The Observer pattern

**Objective**: Write a TimeObserver interface.

Define an interface (Java) or abstract class (C++) called TimeObserver that has the following structure:

**TimeObserver** class

- method
  - timeChanged(int \$newTime): void

## Signal Mediator Class - Exercise

Course project, part 6

**Objective**: Write a `SignalMediator` class for the intersection that manages the four lights.

The `SignalMediator` is responsible for queuing requests and making sure that each light is green for a minimum amount of time. Furthermore, the mediator should provide access to the individual lights.

The basic algorithm you want to implement has seven states that are cycled through in the following order. You can play with the minimum and maximum times if you like, but you must keep this order.

| State | East    | West    | North   | South   | Walk request | Min | Max |
| ----- | ------- | ------- | ------- | ------- | ------------ | --: | --: |
| 1     | Go      | Go      | Stop    | Stop    | false        | 120 | Inf |
| 2     | Go      | Go      | Stop    | Stop    | true         |   0 |  60 |
| 3     | Caution | Caution | Stop    | Stop    | true         |  12 |  12 |
| 4     | Stop    | Stop    | Stop    | Stop    | true         |   5 |   5 |
| 5     | Stop    | Stop    | Go      | Go      | false        |  60 |  60 |
| 6     | Stop    | Stop    | Caution | Caution | false        |  20 |  20 |
| 7     | Stop    | Stop    | Stop    | Stop    | false        |   5 |   5 |
| 1     | Go      | Go      | Stop    | Stop    | false        | 120 | inf |

The `Inf` in state one means that the east-west lights stay green until a pedestrian on the north-south direction explicitly requests a walk signal.

This is one of the most important classes in the system. It also offers many options for how it is written, so I'm going to leave the exact details open.

## Observer Class - Exercise

Flexibility

**Objective**:Make the `VehicleQueue` an `Observer` of the `Time` class.

Make the `VehicleQueue` an Observer of the `Time` class. Every five seconds the vehicle queue should attempt to dequeue a vehicle but if and only if the light is green. Consider whether you need to make any changes to the standard Observer pattern to make this work.
