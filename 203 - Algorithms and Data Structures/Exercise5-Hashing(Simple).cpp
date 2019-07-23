/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 5 - Hashing
***********************************************/

#include <iostream>
#include <fstream>

using namespace std;

struct hash_node{
    int value = 0;
    int ChainCount = 0;
    hash_node* next;

    hash_node ( int val ) : value(val), ChainCount(1), next(NULL){};
};
typedef hash_node* NodeTbl;

void InsertItem(int);
void PrintResults();

static const int hashMod = 100;
NodeTbl Data[hashMod];

int LongestChain = 0;

int main(){
    string sFileName;
    int iLineData;
    ifstream fin;

    cout << "Enter file name: ";
    cin >> sFileName;
    fin.open(sFileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }

    while ( fin >> iLineData){
        InsertItem(iLineData);
    }

    PrintResults();
    return 0;

}

int hashFunc(int iInput){
    return iInput % hashMod;
}


void InsertItem(int iInput){

    int pos = hashFunc(iInput);

    if (Data[pos] == nullptr){
        Data[pos] = new hash_node(iInput);
    } else {
        Data[pos]->value = iInput;
        Data[pos]->ChainCount++;
        Data[pos]->next = NULL;
    }
    if (Data[pos]->ChainCount > LongestChain){
        LongestChain = Data[pos]->ChainCount;
    }
}

void PrintResults(){
    int iCount = 0;

    for (int i = 0; i <= hashMod; i++){
        if (Data[i] == NULL)
            iCount++;
    }

    cout << iCount << " empty entries out of the " << hashMod << " hash table." << endl;
    cout << "The longest chain length is " << LongestChain << "." << endl;
}
