# Creational Design Patterns

- Factory Method
  - When a client object does not know which class to instantiate, it can make use of the factory method to create an instance of an appropriate class from a class hierarchy or a family of related classes. The factory method may be designed as part of the client itself or in a separate class. The class that contains the factory method or any of its subclasses decides on which class to select and how to instantiate it.
- Singleton
  - Provides a controlled object creation mechanism to ensure that only one instance of a given class exists.
- Abstract Factory
  - Allows the creation of an instance of a class from a suite of related classes without having a client object to specify the actual concrete class to be instantiated.
- Prototype
  - Provides a simpler way of creating an object by cloning it from an existing (prototype) object.
- Builder
  - Allows the creation of a complex object by providing the information on only its type and content, keeping the details of the object creation transparent to the client. This allows the same construction process to produce different representations of the object.
