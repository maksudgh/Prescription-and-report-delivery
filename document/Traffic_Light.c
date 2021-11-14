#include <stdio.h>
#define UD 1
#define LR 2
#define Heavy 3
#define NotHeavy 4
#define Green_UD 5
#define Green_LR 6
#define Red_UD 7
#define Red_LR 8
#define Invalid 9

int Agent_Function(int location, int traffic){
    if(location==UD && traffic==Heavy)
        return Green_UD;
    else if(location==LR && traffic==Heavy)
        return Green_LR;
    else if(location==LR && traffic==NotHeavy)
        return Red_LR;
    else if(location==UD && traffic==NotHeavy)
        return Red_UD;
    else
        return Invalid;
}
int main(){
    int action,loc,traf;
    scanf("%d",&loc);
    scanf("%d",&traf);
    action = Agent_Function(loc,traf);
    if(action == Green_UD)
        printf("Turn On Green UD");
    else if(action == Red_UD)
        printf("Turn On Red UD");
    else if(action == Green_LR)
        printf("Turn On Green LR");
    else if(action == Red_LR)
        printf("Turn On Red LR");
    else
        printf("Invalid");

}
