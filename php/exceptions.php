<?php
# All exception classes - based on UML design

# Node
class InvalidNodeIDException extends Exception          # For when an invalid node id is requested (negative number)
{
    public function __construct($message = null)
    {
        $message = $message ?: "Invalid node ID.";
        parent::__construct($message);
    }
}

class InvalidFloorException extends Exception           # For when an invalid floor is requested
{
    public function __construct($message = null)
    {
        $message = $message ?: "Invalid floor.";
        parent::__construct($message);
    }
}

class InvalidStatusException extends Exception          # For when an invalid status is selected / requested
{
    public function __construct($message = null)
    {
        $message = $message ?: "Invalid status.";
        parent::__construct($message);
    }
}

class InvalidInputException extends Exception           # Catch all for any invalid input
{
    public function __construct($message = null)
    {
        $message = $message ?: "Invalid input.";
        parent::__construct($message);
    }
}

class ConnectionFailedException extends Exception           # For when connection to the database fails
{
    public function __construct($message = null)
    {
        $message = $message ?: "Unable to connect to the database.";
        parent::__construct($message);
    }
}
?>