#include <stdio.h>
#define A 1
#define B 2
#define C 3
#define Dirty 4
#define Clean 5
#define Vacuum 6
#define Go_Left 7
#define Go_Right 8
#define Invalid 9

int prev_loc=0;
int Agent_Function(int percept1, int percept2){
    if(percept1==A && percept2==Dirty && prev_loc==0)
    {
        prev_loc==percept1;
        return Vacuum;
    }
    else if(percept1==A && percept2==Clean && prev_loc==0)
    {
        prev_loc==percept1;
        return Go_Right;
    }
    else if(percept1==A && percept2==Dirty && prev_loc==B)
    {
        prev_loc==percept1;
        return Vacuum;

    }
    else if(percept1==A && percept2==Clean && prev_loc==B)
    {
        prev_loc==percept1;
        return Go_Right;

    }
     else if(percept1==B && percept2==Dirty && prev_loc==0)
    {
        prev_loc==percept1;
        return Vacuum;
    }
    else if(percept1==B && percept2==Clean && prev_loc==0)
    {
        prev_loc==percept1;
        return Go_Right;
    }
    else if(percept1==B && percept2==Dirty && prev_loc==A)
    {
        prev_loc==percept1;
        return Vacuum;
    }
    else if(percept1==B && percept2==Dirty && prev_loc==C)
    {
        prev_loc==percept1;
        return Vacuum;
    }
    else if(percept1==B && percept2==Clean && prev_loc==A)
    {
        prev_loc==percept1;
        return Go_Right;
    }
    else if(percept1==B && percept2==Clean && prev_loc==C)
    {
        prev_loc==percept1;
        return Go_Left;

    }
    else if(percept1==C && percept2==Dirty && prev_loc==0)
    {
        prev_loc==percept1;
        return Vacuum;

    }
    else if(percept1==C && percept2==Clean && prev_loc==0)
    {
        prev_loc==percept1;
        return Go_Left;

    }
    else if(percept1==C && percept2==Dirty && prev_loc==C)
    {
        prev_loc==percept1;
        return Vacuum;
    }
    else if(percept1==C && percept2==Clean && prev_loc==C)
    {
        prev_loc==percept1;
        return Go_Left;
    }
    else
        return Invalid;

}
int main(){
    int action,loc,stat;
    scanf("%d",&loc);
    scanf("%d",&stat);
    action = Agent_Function(loc,stat);
    if(action == Go_Left)
        printf("Go Left");
    else if(action == Go_Right)
        printf("Go Right");
    else if(action == Vacuum)
        printf("Vacuum");
    else
        printf("Invalid");

}

