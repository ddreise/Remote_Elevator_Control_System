// Includes required (headers located in /usr/include) 
#include "../include/databaseFunctions.h"
#include "../include/pcanFunctions.h"
#include <stdlib.h>
#include <string.h>
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
			currentFloor = 0;
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
	int queueID;

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


	// Query database for next destination floor
	// *****************************
	stmt2 = con->createStatement();
	res->next();
	printf("Status: %s", res->getString("status"));
	if (res->getString("status").compare(up) || res->getString("status").compare(stopped)) {
		res = stmt2->executeQuery("SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor LIMIT 1");	// message query
		while(res->next()){
			floorNum = res->getInt("destinationFloor");
			printf("<<<<<<UP>>>>>>>\n");
		}
	}

	else if (res->getString("status").compare(down)) {
		res = stmt2->executeQuery("SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor LIMIT 1 DESC");	// message query
		while(res->next()){
			floorNum = res->getInt("destinationFloor");
			printf("<<<<<DOWN>>>>>");
		}
	}
		
	diagStmt = con->createStatement();
	res = diagStmt->executeQuery("SELECT queueNumber FROM elevatorQueue ORDER BY queueNumber LIMIT 1");
	while(res->next())
	{
		queueID = res->getInt("queueNumber");	
	}
	diagStmt2 = con->prepareStatement("UPDATE elevatorDiagnostics SET queueID = ? WHERE nodeID = 1");
	diagStmt2->setInt(1, queueID);
	diagStmt2->executeUpdate();
	
	// Clean up pointers 
	delete res;
	delete stmt1;
	delete stmt2;
	delete con;
	
	delete diagStmt;
	delete diagStmt2;
		
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
	if (res->getString("status").compare(up) || res->getString("status").compare(stopped)) {
		stmt->execute("DELETE FROM elevatorQueue ORDER BY destinationFloor LIMIT 1;");	// message
	}

	else if (res->getString("status").compare(down)){
		stmt->execute("DELETE FROM elevatorQueue ORDER BY destinationFloor LIMIT 1 ASC;");	// message
	}

	delete con;
	delete stmt;
	delete stmt1;
	delete res;

	return 0;
}

//int diagnosticUpdate(

