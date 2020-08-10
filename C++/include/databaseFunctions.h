#ifndef DB_FUNCTIONS
#define DB_FUNCTIONS

#include <string>

int db_getFloorNum();
int db_setFloorNum(int floorNum);
int db_getQueuedFloor();
int db_deleteQueuedFloor();
int diagnosticUpdateDirection(std::string direction);
int diagnosticUpdateDoors(std::string doors);
int diagnosticUpdateFloorVisits(int floor);
int sabbathCheck();
int diagnosticStringUpdate(std::string key, std::string doors); // not working - DO NOT USE

#endif
