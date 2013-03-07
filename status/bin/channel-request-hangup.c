#include <stdlib.h>
#include <stdio.h>


int main (int argc, char **argv){

//	argv[0] = "/usr/sbin/asterisk -rx";
//	argv[1] = "channel request hangup";
//	argv[2] = "SIP/6111-00000036";
	char cmd[100] = "/usr/sbin asterisk -rx channel request hangup";
	strcat(cmd, argv[1]);
	system(cmd);
}
