// Includes required (headers located in /usr/include) 
#include "../include/databaseFunctions.h"
#include "../include/pcanFunctions.h"
#include <stdlib.h>
#include <string>
#include <iostream>
#include <mysql_connection.h>
#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>
 
using namespace std; 
 
// Get current floor
int db_getFloorNum() {

	int currentFloor;
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::PreparedStatement *pstmt; 		// Create a pointer to a prepared statement

	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");	
	

	currentFloor = pcanRx(1); 	// Receive 1 message

	switch (currentFloor) {
		case 0x5:
			currentFloor = 1;
			break;
		case 0x6:
			currentFloor = 2;
			break;
		case 0x7:
			currentFloor = 3;
			break;
		default:
			//currentFloor = 0;
			break;
	}

	printf("Current floor = %d\n", currentFloor);
	// Update database
	// *****************************
	pstmt = con->prepareStatement("UPDATE elevatorNetwork SET currentFloor = ? WHERE nodeID = 1");
	pstmt->setInt(1, currentFloor);
	pstmt->executeUpdate();

	delete pstmt;
	delete con;

	return currentFloor;

}
 
 
int db_setFloorNum(int floorNum) {
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::Statement *stmt;				// Crealte a pointer to a Statement object to hold statements 
	sql::ResultSet *res;				// Create a pointer to a ResultSet object to hold results 
	sql::PreparedStatement *pstmt; 		// Create a pointer to a prepared statement	
	
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");										
	
	// Query database (possibly not necessary)
	// ***************************** 
	stmt = con->createStatement();
	res = stmt->executeQuery("SELECT currentFloor FROM elevatorNetwork WHERE nodeID = 1");	// message query
	while(res->next()){
		res->getInt("currentFloor");
	}
		
	// Update database
	// *****************************
	pstmt = con->prepareStatement("UPDATE elevatorNetwork SET currentFloor = ? WHERE nodeID = 1");
	pstmt->setInt(1, floorNum);
	pstmt->executeUpdate();
		
	// Clean up pointers 
	delete res;
	delete pstmt;
	delete stmt;
	delete con;
} 

int db_getQueuedFloor() {

	sql::Driver *driver; 			// Create a pointer to a MySQL driver object
	sql::Connection *con; 			// Create a pointer to a database connection object
	sql::Statement *stmt1;			// Crealte a pointer to a Statement object to hold statements 
	sql::Statement *stmt2;
	sql::ResultSet *res;			// Create a pointer to a ResultSet object to hold results 
	int floorNum;					// Floor number 
	//char result[255] = "";
		
	sql::Statement *diagStmt;
	sql::PreparedStatement *diagStmt2;
	sql::Statement *diagStmt3;
	int queueID = 0;				//queueID should never be 0

	std::string up ("up");
	std::string down ("down");
	std::string stopped ("stopped");
	
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");		
	
	// Query database for current status
	// ***************************** 
	stmt1 = con->createStatement();
	res = stmt1->executeQuery("SELECT status FROM elevatorNetwork WHERE nodeID = 1");

//|| res->getString("status").compare(stopped)) 
	// Query database for next destination floor
	// *****************************
	stmt2 = con->createStatement();
	res->next();
	if (!res->getString("status").compare(up)) {
		res = stmt2->executeQuery("SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor LIMIT 1");	// message query
		while(res->next()){
			floorNum = res->getInt("destinationFloor");
		}
	}

	else if (!res->getString("status").compare(down)) {
		res = stmt2->executeQuery("SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor DESC LIMIT 1");	// message query
		while(res->next()){
			floorNum = res->getInt("destinationFloor");
		}
	}

	else {
		res = stmt2->executeQuery("SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor LIMIT 1");
		while(res->next())
		{
			floorNum = res->getInt("destinationFloor");
		}
	}
		
	diagStmt = con->createStatement();
	res = diagStmt->executeQuery("SELECT queueNumber FROM elevatorQueue ORDER BY queueNumber");
	while(res->next())
	{
		queueID = res->getInt("queueNumber");
	}
	
	diagStmt3 = con->createStatement();
	res = diagStmt3->executeQuery("SELECT queueID FROM elevatorDiagnostics ORDER BY nodeID");
	while(res->next())
	{
		if(res->getInt("queueID") > queueID) queueID = res->getInt("queueID");
	}
	
	if(queueID)
	{
		diagStmt2 = con->prepareStatement("UPDATE elevatorDiagnostics SET queueID = ? WHERE nodeID = 1");
		diagStmt2->setInt(1, queueID);
		diagStmt2->executeUpdate();
		
		delete diagStmt2;
	}
	
	// Clean up pointers 
	delete res;
	delete stmt1;
	delete stmt2;
	delete con;
	
	delete diagStmt;
		
	return floorNum;
}

// Delete most recent queue request from the queue table
int db_deleteQueuedFloor() {
	
	char error[250] = "";
	int queueNumber;
	sql::Driver *driver; 			// Create a pointer to a MySQL driver object
	sql::Connection *con; 			// Create a pointer to a database connection object
	sql::Statement *stmt;			// Crealte a pointer to a Statement object to hold statements 
	sql::Statement *stmt1;
	sql::ResultSet *res;
	//char result[250] = "";

	std::string up ("up");
	std::string down ("down");
	std::string stopped ("stopped");
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");	

	// Query database for current status
	// ***************************** 
	stmt1 = con->createStatement();
	res = stmt1->executeQuery("SELECT status FROM elevatorNetwork WHERE nodeID = 1");

	// Query database
	// ***************************** 
	stmt = con->createStatement();
	res->next();
	if (!res->getString("status").compare(up) || !res->getString("status").compare(stopped)) {
		stmt->execute("DELETE FROM elevatorQueue ORDER BY destinationFloor LIMIT 1;");	// message
	}

	else if (!res->getString("status").compare(down)){
		stmt->execute("DELETE FROM elevatorQueue ORDER BY destinationFloor DESC LIMIT 1;");	// message
	}
	else
	{
		stmt->execute("DELETE FROM elevatorQueue ORDER BY destinationFloor LIMIT 1;");
	}

	delete con;
	delete stmt;
	delete stmt1;
	delete res;

	return 0;
}

int diagnosticUpdateDirection(std::string direction)
{
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::PreparedStatement *pstmt;
	
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");
	
	pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET direction = ? WHERE nodeID = 1");
	pstmt->setString(1, direction);
	pstmt->executeUpdate();
}

int diagnosticUpdateDoors(std::string doors)
{
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::PreparedStatement *pstmt;
	
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");
	
	pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET doors = ? WHERE nodeID = 1");
	pstmt->setString(1, doors);
	pstmt->executeUpdate();
}

int diagnosticUpdateFloorVisits(int floor)
{
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::PreparedStatement *pstmt;
	sql::Statement *stmt;
	sql::ResultSet *res;			// Create a pointer to a ResultSet object to hold results 

	int floorVisits = 0;

	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");
	
	stmt = con->createStatement();
	switch(floor)
	{
		case 1:
			res = stmt->executeQuery("SELECT floor1Visits FROM elevatorDiagnostics WHERE nodeID=1");
			while(res->next())
			{
				floorVisits = res->getInt("floor1Visits");
			}
			pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET floor1Visits = ? WHERE nodeID = 1");
			pstmt->setInt(1, ++floorVisits);
			pstmt->executeUpdate();
		break;
		case 2:
			res = stmt->executeQuery("SELECT floor2Visits FROM elevatorDiagnostics WHERE nodeID=1");
			while(res->next())
			{
				floorVisits = res->getInt("floor2Visits");
			}
			pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET floor2Visits = ? WHERE nodeID = 1");
			pstmt->setInt(1, ++floorVisits);
			pstmt->executeUpdate();
		break;
		case 3:
			res = stmt->executeQuery("SELECT floor3Visits FROM elevatorDiagnostics WHERE nodeID=1");
			while(res->next())
			{
				floorVisits = res->getInt("floor3Visits");
			}
			pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET floor3Visits = ? WHERE nodeID = 1");
			pstmt->setInt(1, ++floorVisits);
			pstmt->executeUpdate();
		break;
	}
	
	delete stmt;
	delete pstmt;
}

//Does not work - don't use
int diagnosticStringUpdate(std::string key, std::string value)
{
	sql::Driver *driver; 				// Create a pointer to a MySQL driver object
	sql::Connection *con; 				// Create a pointer to a database connection object
	sql::PreparedStatement *pstmt;
	
	// Create a connection 
	driver = get_driver_instance();
	con = driver->connect("tcp://127.0.0.1:3306", "ese", "ese");	
	con->setSchema("elevatorProject");
	
	pstmt = con->prepareStatement("UPDATE elevatorDiagnostics SET ? = ? WHERE nodeID = 1");
	pstmt->setString(1, key);
	pstmt->setString(2, value);
	pstmt->executeUpdate();
}
