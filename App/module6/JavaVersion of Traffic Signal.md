```Java Version
/* For a more general system that could handle different intersections this would likely be an abstract class */
public class SignalMediator implements TimeObserver {

  // North is 0 degrees on the compass
  // directions are counter clockwise
  TrafficSignal northSignal = new WalkSign();
  TrafficSignal southSignal = new WalkSign();
  TrafficSignal eastSignal = new TrafficLight();
  TrafficSignal westSignal = new TrafficLight();


  public SignalMediator() {

    // initialize traffic lights to green
    // and pedestrian lights to Do not walk
    // This violates encapsulation but not seriously,
    // and is much easier than the alternatives
    northSignal.state = TrafficSignal.STOP;
    southSignal.state = TrafficSignal.STOP;
    eastSignal.state = TrafficSignal.GO;
    westSignal.state = TrafficSignal.GO;

    Time.getInstance().addTimeObserver(this);
  }

  /*
     Here are the states, which must be cycled in this order
     and the minimum and maximum times the lights may stay in that state

State  East    West     North    South  walk request Min  Max
    1   Go      Go       Stop     Stop    false     120   Inf
    2   Go      Go       Stop     Stop    true      0    60
    3   Caution Caution  Stop     Stop    true      12   12
    4   Stop    Stop     Stop     Stop    true      5    5
    5   Stop    Stop     Go       Go      false     60   60
    6   Stop    Stop     Caution  Caution false     20   20
    7   Stop    Stop     Stop     Stop    false     5    5
    1   Go      Go       Stop     Stop    false     120   Inf

  */

  // time when next change may take place, based on above table
  private int nextChange = 0;



public void timeChanged(int newTime) {

    if (newTime >= nextChange) {
      switch (this.getState()) {
        case 1:
          // wait two minutes, before checking if
          // state has changed
          nextChange = nextChange + 120;
          break;
        case 2:
          eastSignal.changeState();
          westSignal.changeState();
          nextChange = newTime + 12;
          break;
        case 3:
          eastSignal.changeState();
          westSignal.changeState();
          nextChange = newTime + 5;
          break;
        case 4:
          northSignal.changeState();
          southSignal.changeState();
          northSignal.passageGranted();
          southSignal.passageGranted();
          nextChange = newTime + 60;
          break;
        case 5:
          northSignal.changeState();
          southSignal.changeState();
          nextChange = newTime + 20;
          break;
        case 6:
          northSignal.changeState();
          southSignal.changeState();
          nextChange = newTime + 5;
          break;
        case 7:
          eastSignal.changeState();
          westSignal.changeState();
          nextChange = newTime + 120;
          break;
        default:
          System.err.println("Illegal State: Bug");
          System.err.println(northSignal);
          System.err.println(southSignal);
          System.err.println(eastSignal);
          System.err.println(westSignal);
          System.exit(0);
      }

    }
  }



  private int getState() {

    if (eastSignal.getState() == TrafficSignal.GO
     && northSignal.getState() == TrafficSignal.STOP
     && !northSignal.getPassageRequested()
     && !southSignal.getPassageRequested()) {
      return 1;
    }
    else if (eastSignal.getState() == TrafficSignal.GO
     && northSignal.getState() == TrafficSignal.STOP
     && (northSignal.getPassageRequested()
     || southSignal.getPassageRequested())) {
      return 2;
    }
    else if (eastSignal.getState() == TrafficSignal.CAUTION
     && northSignal.getState() == TrafficSignal.STOP
     && (northSignal.getPassageRequested()
     || southSignal.getPassageRequested())) {
      return 3;
    }
    else if (eastSignal.getState() == TrafficSignal.STOP
     && northSignal.getState() == TrafficSignal.STOP
     && (northSignal.getPassageRequested()
     || southSignal.getPassageRequested())) {
      return 4;
    }
    else if (eastSignal.getState() == TrafficSignal.STOP
     && northSignal.getState() == TrafficSignal.GO
     && !northSignal.getPassageRequested()
     && !southSignal.getPassageRequested()) {
      return 5;
    }
    else if (eastSignal.getState() == TrafficSignal.STOP
     && northSignal.getState() == TrafficSignal.CAUTION
     && !northSignal.getPassageRequested()
     && !southSignal.getPassageRequested()) {
      return 6;
    }
    else if (eastSignal.getState() == TrafficSignal.STOP
     && northSignal.getState() == TrafficSignal.STOP
     && !northSignal.getPassageRequested()
     && !southSignal.getPassageRequested()) {
      return 7;
    }
    else { // invalid state
      return 3;
    }

  }

  public TrafficSignal getNorthSignal() {
    return northSignal;
  }

  public TrafficSignal getSouthSignal() {
    return southSignal;
  }

  public TrafficSignal getEastSignal() {
    return eastSignal;
  }

  public TrafficSignal getWestSignal() {
    return westSignal;
  }

}
```
