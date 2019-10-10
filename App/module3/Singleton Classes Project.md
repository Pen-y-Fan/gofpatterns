# Singleton Classes for the Course Project

**Objective**: Write the Singleton classes for the course project.

For the simulation you will need:

1. Create a clock that can be shared between the different classes. This is not a real-time clock
   but a simulated clock. There should only be one so that time is the same across the classes.
2. This `Clock` or Time class should have a single int field called `currentTime` which is initialized to zero.
   Provide a getter method that returns the value of the field, but no corresponding setter method.
   Add a field called `endOfTime` which will store the number of seconds the clock is to run. Set this field in the constructor.
3. Provide a `run()` method that increments the value of the `currentTime` attribute by 1 until it reaches the
   value of `endOfTime`. In other words, the `run()` method counts from the initial value of seconds up to the end
   of the simulation.

Write this `Clock` class as a Singleton.
