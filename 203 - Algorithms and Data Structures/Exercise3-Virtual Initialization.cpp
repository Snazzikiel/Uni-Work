/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 3 - Virtual Initialization
***********************************************/

#include <iostream>
#include <fstream>

using namespace std;

bool addData(int,int);
bool isValid(int);

int data[100];
int forwardd[100];
int backward[100];
int counter = 0;

int main() {
    string FileName;
    int LineData;
    ifstream fin;

    int what = 0;
    int where = 0;
    int probe = 0;

    //cout << "Enter file name: ";
    //cin >> FileName;
    FileName = "Ex3.txt";

    fin.open(FileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }

    while (fin >> what >> where){
        if (!addData(what,where)){
            break;
        }
    }

    while (fin >> probe){
        if (!isValid(probe)){
            break;
        }
    }
    fin.close();

    return 0;

}


//To check whether an element of data[] contains a valid value
bool isValid(int probe){
    if (probe == -1){
        return false;
    }

    if (backward[probe] > 0 && backward[probe] <= counter && forwardd[backward[probe]] == probe){
        cout << "Position "<< probe << " has been initialized to value " << data[probe] << "." << endl;
    } else {
        cout << "Position "<< probe << " has not initialized." << endl;
    }

    return true;
}

//Adding data taken from text document to sufficient locations and also
//keeping track whether an element of data[] contains a valid value.
bool addData(int what, int where){

    if (what == -1 && where == -1){
        return false;
    }

    counter++;
    data[where] = what;
    forwardd[counter] = where;
    backward[where] = counter;

    return true;
}