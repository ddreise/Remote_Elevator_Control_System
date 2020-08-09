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
						if (currentFloor != queuedFloor) {                                                         // If fl$
							pcanTx(ID_SC_TO_EC, HexFromFloor(queuedFloor));                                 // change floor $
							if(!lalaFlag)
							{
								system("mpg123 ./elevator-music-tropical-vibe.mp3 &");
								lalaFlag = 1;
							}
						}
						else if (currentFloor == queuedFloor) {
							sleep(2);                               // wait for elevator to slow down
							db_deleteQueuedFloor();
							system("killall mpg123");
							lalaFlag = 0;
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






	
