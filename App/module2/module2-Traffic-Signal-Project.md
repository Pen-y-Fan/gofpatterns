# GoGPatterns

[Defining Design Patterns](https://www.gofpatterns.com/design-patterns/module2/intro-defining-design-patterns.php)

## Traffic Signals Course Project

Write the classes for the traffic signals in the course project. As the first part of the course project, let us create the traffic lights and Walk/Don't Walk signs.

Here are some of the specifications for the project:

- Traffic lights have an intermediate yellow state, and always pass through their three possible states in the cyclic order red/green/yellow/red.
- Walk/Don't Walk signs have an intermediate flashing don't walk state, and always pass through their three possible states in the cyclic order walk/flashing don't walk/don't walk/walk.
- There should be a minimum time associated with each light state (for instance, you don't want pedestrians to have to race across the street in under 5 seconds). However, the traffic light probably should not have a maximum time on green.
- Other states may need maximum times to allow the traffic light to revert to green (Remember, pedestrians have to push a button to get a walk sign. If no one pushes a button, the pedestrian signal remains locked in "Don't Walk").
- By default, the traffic light is green until a pedestrian pushes a button on the light indicating they wish to cross the street.
- Most importantly, the lights must be connected. It is important to insure that whenever the traffic light is green, the crosswalk sign reads, **Don't Walk**

## PHP version

- Code

  - AbstractTrafficSignal.php
  - TrafficLight.php
  - WalkSign.php

- Tests

  - TrafficLightTest.php
  - WalkSignTest.php
