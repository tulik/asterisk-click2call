#include <stdlib.h>
#include <stdio.h>


int main (int argc, char **argv){

	argv[0] = "/usr/sbin/asterisk";
	argv[1] = "-rx";
	argv[2] = "sip show peers";

	execv(*argv, argv);

}
