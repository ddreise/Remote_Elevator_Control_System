<?php    
    require_once("exceptions.php");

    class Node { 
        protected $id; //The unique identifier of a node 


        // Function for creating new Node
        public function __construct (int $i ) { $this->id = $id;}

        //Return the ID of a given node 
        public function getId() { return $this->id; } 

    } 

    interface I_SupervisoryController { 
        public function setStatus($enableStatus);
        public function getFloor();
        public function setFloor(int $floorNumber);
    } 

    class SupervisoryController extends Node implements I_SupervisoryController{
 
        //Review or change the activation state of the elevator 
        public function setStatus($enableStatus) { 
            if(is_bool($enableStatus))
                $this->elevatorStatus = $enableStatus;
            else 
                throw new InvalidStatusException();
        } 

        //Review or change the last reported floor/next requested floor 
        public function getFloor() { 
            return $this->lastReportedFloor; 
        } 

        public function setFloor(int $floorNumber) {
            if($floorNumber < 0)
                throw new InvalidFloorException("Exception: Floor number is negative.");
            else if($floorNumber == 0)
                throw new InvalidFloorException("Exception: Floor number is 0.");
            else if($floorNumber > 3)
                throw new InvalidFloorException();
            else
                $this->nextRequestedFloor = $floorNumber; 
        } 
    }

    interface I_ElevatorController { 
        public function getStatus();
        public function getIsMoving();
        public function setIsMoving($newMoveStatus);
        public function getCurrentFloor();
        public function setCurrentFloor(string $newFloor);
    } 

    class ElevatorController extends Node implements I_ElevatorController{

        //Review or change the status of the elevator (enabled/disabled) 
        public function getStatus () { 
            return $this->status; 
        } 

        //Review or change the elevator moving status 
        public function getIsMoving () { 
            return $this->isMoving; 
        } 

        public function setIsMoving ($newMoveStatus) { 
            if(is_bool($enableStatus))
                $this->isMoving = $newMoveStatus;
            else 
                throw new InvalidStatusException(); 
        } 

        //Review or change the current floor of the elevator 
        public function getCurrentFloor () { 
            return $this->currentFloor; 
        } 

        public function setCurrentFloor (string $newFloor) { 
            if($floorNumber < 0)
                throw new InvalidFloorException("Exception: Floor number is negative.");
            else if($floorNumber == 0)
                throw new InvalidFloorException("Exception: Floor number is 0.");
            else if($floorNumber > 3)
                throw new InvalidFloorException();
            else
                $this->currentFloor = $newFloor; 
        } 

    }

    interface I_ElevatorCar { 
        public function getCarPosition();
        public function setCarPosition(int $newPosition);
    } 

    class ElevatorCar extends Node implements I_ElevatorCar {

        //Review or change the distance from the car to the position sensor 
        public function getCarPosition() { 
            return $this->carPosition; 
        } 
        public function setCarPosition(int $newPosition) { 
            $this->carPosition = $newPosition; 
        } 

    }

    interface I_CarController { 
        public function getRequests();
        public function setRequest(int $floorNumber);
        public function unsetRequest();
    } 

    class CarController extends Node implements I_CarController {

        //Review or change the list of active buttons on the car control panel 
        public function getRequests() { 
            return $this->requestedFloors; 
        } 

        public function setRequest(int $floorNumber) { 
            if($floorNumber < 0)
                throw new InvalidFloorException("Exception: Floor number is negative.");
            else if($floorNumber == 0)
                throw new InvalidFloorException("Exception: Floor number is 0.");
            else if($floorNumber > 3)
                throw new InvalidFloorException();
            else
            {
                $this->requestedFloors = $floorNumber; 
                ++self::$numRequests; 
            }
        } 

        public function unsetRequest() { 
            unset($requestedFloors[self::$numRequests]); 
            --self::$numRequests; 
        } 
    }

    interface I_FloorNode { 
        public function getNodeFloor();
        public function setRequest($buttonPressed);
        public function getRequest();
    } 

    class FloorNode extends Node implements I_FloorNode {


        //Returns the floor of a given floor node 
        public function getNodeFloor() { 
            return $this->$nodeFloor; 
        } 

        //Review or change the state of the button (whether or not the car is being called to this floor) 

        public function getRequest() { 
            return $this->buttonState; 
        } 

        public function setRequest($buttonPressed) { 
            if(is_bool($enableStatus))
                $this->buttonState = $buttonPressed; 
            else 
                throw new InvalidStatusException(); 
        } 
    }

#    require_once __DIR__ . '/Node.php'; 
#    require_once __DIR__ . '/SupervisoryController.php'; 
#    require_once __DIR__ . '/ElevatorController.php'; 
#    require_once __DIR__ . '/CarController.php'; 
#    require_once __DIR__ . '/ElevatorCar.php'; 
#    require_once __DIR__ . '/FloorNode.php'; 

#    $SC = new SupervisoryController(); 
#    $EC = new ElevatorController(); 
#    $CC = new CarController(); 
#    $car = new ElevatorCar(); 

#    $floor1 = new FloorNode(1); 
#    $floor1 = new FloorNode(2); 
#    $floor1 = new FloorNode(3); 
?> 