<?php
    require_once("exceptions.php");

    class Node { 
        private $id; //The unique identifier of a node 

        //Return the ID of a given node 
        public function getId() { 
            return $this->id;
        } 
    } 

    class SupervisoryController extends Node { 
        private $lastReportedFloor; //The most recent current floor as reported by the elevator controller 
        private $nextRequestedFloor; //The next requested floor as signaled by the car controller or floor nodes 
        private $elevatorStatus; 

        public function __construct () { 
            $this->id = 100; //The supervisory controller must have an ID of 0x100 
            $this->$lastReportedFloor = 1; //The elevator begins at floor 1 
            $this->$nextRequestedFloor = 1; //The supervisory controller begins with no floor change requests 
            $this->elevatorStatus = false; //The elevator starts in an inactive state (false) 
        } 

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

    class ElevatorController extends Node { 
        private $status; //Whether or not the elevator is enabled or disabled 
        private $isMoving; //Whether or not the elevator is moving 
        private $currentFloor; //The current floor at which the elevator is positioned 

        public function __construct () { 
            $this->id = 101; //The elevator controller must have an ID of 0x101 
            $this->currentFloor = 1; //Elevator controllers always start with their cars at floor 1 
        } 

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

    class ElevatorCar { 
        private $carNumber; //A unique identifier for each car 
        private static $lastCarNumber = 0; //The number of cars instantiated 
        private $carPosition; //The position of the car relative to the distance sensor 

        public function __construct () { 
            $this->carNumber = ++self::$lastCarNumber; //The car number will reflect the number of cars already established upon construction 
            $this->carPosition = 0; //Cars always begin at position 0 (floor 1) 
        } 

        //Review or change the distance from the car to the position sensor 
        public function getCarPosition() { 
            return $this->carPosition; 
        } 
        public function setCarPosition(int $newPosition) { 
            $this->carPosition = $newPosition; 
        } 
    } 

    class CarController extends Node { 
        private $requestedFloors; //The list of buttons currently active in the car 
        private static $numRequests = 0; //The number of buttons pressed on the control panel 

        public function __construct () { 
            $this->id = 200; //The car controller must have an ID of 0x200 
            $this->requestedFloors = array(); //Prepare an empty array for the list of active buttons 
        } 

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

    class FloorNode extends Node { 
        private $nodeFloor; //The floor at which the floor node is positioned 
        private $buttonState; //The state of the call button at the floor node 

        public function __construct (int $objNodeFloor) {
            if($objNodeFloor < 0)
                throw new InvalidNodeIDException("Exception: FloorNode cannot be negative.");
            else if($objNodeFloor == 0)
                throw new InvalidNodeIDException();
            else
            {
                $this->id = $objNodeFloor + 200; //Floor nodes begin after the car controller at 0x200 
                $this->nodeFloor = $objNodeFloor; //The floor of the floor node is represented by the total number of nodes already established upon construction 
                $this->buttonState = false; //Buttons begin in the inactive state (false) 
            }
        } 

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