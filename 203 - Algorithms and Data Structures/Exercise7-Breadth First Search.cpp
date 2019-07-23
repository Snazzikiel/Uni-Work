/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 7 - Breadth First Search
***********************************************/

#include <iostream>
#include <iomanip>
#include <fstream>

using namespace std;

void inputVertGraph(int);
void BFS(int);
int pop();

int** iAdjList;
bool* bVisited;
int* iQueue;
int iTotVertice = 0;
int iQueueCounter = 0;
int iVisitedCounter = 0;
int iQueueTracker = 0;


int main()
{
    string sFileName;
    int v1 = 0;
    int v2 = 0;

    ifstream fin;

    cout << "Enter file name: ";
    sFileName = "Ex7.txt";
    //cin >> sFileName;

    fin.open(sFileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }

    fin >> iTotVertice;
    inputVertGraph(iTotVertice);

    while (fin >> v1 >> v2){
        iAdjList[v1][v2] = 1;
        iAdjList[v2][v1] = 1;
    }

    cout << "Total number of Vertices: " << iTotVertice << endl;
    cout << "Starting BFS" << endl;
    BFS(0);

    delete [] iAdjList;
    delete [] bVisited;
    delete [] iQueue;

}


void inputVertGraph(int totVertice)
{
    iTotVertice = totVertice;

    iAdjList = new int*[iTotVertice];
    bVisited = new bool[iTotVertice];
    iQueue = new int[iTotVertice];

    //make each Visited boolean false
    for (int i = 0; i <= iTotVertice; i++){
        bVisited[i] = false;
    }

    //input to the matrix
    for(int i = 0; i < totVertice; i++)
    {
        iAdjList[i] = new int[totVertice];
        for(int x = 0; x < totVertice; x++)
        {
            iAdjList[i][x] = 0;
        }
    }
}

void BFS(int iStart){

    int vNumber = 0;

    bVisited[iVisitedCounter] = true;
    iQueue[iQueueCounter] = iStart;
    iVisitedCounter++;
    iQueueCounter++;

    //While queue is not empty
    while(iQueueTracker != iQueueCounter)
    {
        vNumber = pop();
        for(int i = 0; i <= iTotVertice; i++)
        {
            if(iAdjList[vNumber][i] == 1)
            {
                if(!bVisited[i])
                {
                    bVisited[i] = true;
                    iQueue[iQueueCounter] = i;
                    iVisitedCounter++;
                    iQueueCounter++;
                    cout << setw(2) << vNumber << setw(4) << i << endl;
                }
            }
        }
    }
}

int pop(){
    int q = iQueue[iQueueTracker];
    iQueueTracker++;
    return q;
}