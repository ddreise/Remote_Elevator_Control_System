#include "../include/pcanFunctions.h"
#include "../include/databaseFunctions.h"
#include "../include/mainFunctions.h"

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h> 
#include <iostream>

using namespace std;


// ******************************************************************

int main() {

	int choice; 
	int ID; 
	int data; 
	int numRx;
	int queuedFloor = 1, prev_floorNumber = 1;
	int currentFloor;
	
	int lalaFlag = 0;
	int idleFlag = 0;

	while(1) {
		system("@cls||clear");
		choice = menu(); 
		switch (choice) {
			case 1: 
				ID = chooseID();		// user to select ID depending on intended recipient
				data = chooseMsg();		// user to select message data
				pcanTx(ID, data);		// transmit ID and data 
				db_setFloorNum(FloorFromHex(data)); 		// change floor number in database ** NEW **
				break; 
				
			case 2:
				printf("\nHow many messages to receive? ");
				scanf("%d", &numRx);
				pcanRx(numRx);
				break;
				
			case 3:
				printf("\nNow listening to commands from the website - press ctrl-z to cancel\n");
				// Synchronize elevator db and CAN (start at 1st floor)
				pcanTx(ID_SC_TO_EC, GO_TO_FLOOR1);
				db_setFloorNum(1);
				
				while(1){			
					queuedFloor = db_getQueuedFloor();
					currentFloor = db_getFloorNum();
					printf("Current queued floor: %d \n", queuedFloor);
					if ((queuedFloor == 1) || (queuedFloor == 2) || (queuedFloor == 3)){
						idleFlag = 0;
						if (currentFloor != queuedFloor) {                                                         // If fl$
							pcanTx(ID_SC_TO_EC, HexFromFloor(queuedFloor));                                 // change floor $
							if(!lalaFlag)
							{
								if(currentFloor < queuedFloor) //going up!
								{
									system("killall mpg123");
									system("mpg123 ./elevator-going-up.mp3 &");
									lalaFlag = 1;
								}
								else if(currentFloor > queuedFloor) //going down!
								{
									system("killall mpg123");
									system("mpg123 ./elevator-going-down.mp3 &");
									lalaFlag = 1;
								}
							}
						}
						else if (currentFloor == queuedFloor) {
							//announce floor
							switch(currentFloor)
							{
								case 1:
									system("killall mpg123");
									system("mpg123 ./elevator-floor-1.mp3 &");
									break;
								case 2:
									system("killall mpg123");
									system("mpg123 ./elevator-floor-2.mp3 &");
									break;
								case 3:
									system("killall mpg123");
									system("mpg123 ./elevator-floor-3.mp3 &");
									break;
							}
							
							sleep(5);                               // wait for elevator to slow down and for audio to finish
							db_deleteQueuedFloor();
							
							//elevator stopped - doors open!
							system("killall mpg123");
							system("mpg123 ./elevator-doors-open.mp3 &");
							lalaFlag = 0;
							sleep(5); //let the doors open and people leave
							//ok close the doors!
							system("killall mpg123");
							system("mpg123 ./elevator-doors-close.mp3 &");
							sleep(5);
							system("killall mpg123");
						}
					}
					else
					{
						if(!idleFlag)
						{
							system("killall mpg123");
							system("mpg123 ./elevator-idle.mp3 &");
							idleFlag = 1;
						}
					}								
					//prev_floorNumber = queuedFloor; 
					sleep(1);															// poll database once every second to check for change in floor number
				}
				break;
				
			case 4: 
				return(0);
			
			default:
				printf("Error on input values");
				sleep(3);
				break;
		}
		sleep(1);					// delay between send/receive
	}
	
	return(0);
}






	
