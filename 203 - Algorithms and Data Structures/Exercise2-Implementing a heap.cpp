/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 2 - Implementing a Heap
***********************************************/

#include <iostream>
#include <fstream>

using namespace std;

void makeheap();
void siftdown(int);
void siftup(int);
void swap(int*,int*);
int getParent(int);
int getLeftChild(int);

int heap[500];
int index = 0;

//Variable Notes
//p = parent
//c = child

int main() {
    string FileName;
    int LineData;
    ifstream fin;

    cout << "Enter file name: ";
    cin >> FileName;
    //FileName = "Ex2.txt";

    fin.open(FileName.c_str());

    if(!fin.good()){ cerr << "File not found\n"; exit(1); }

    while (fin >> LineData){
        heap[index] = LineData;
        siftup(index);
        index++;
    }
    fin.close();

    cout << "Min Heap (using Siftup): ";
    for(int i = 0; i < 5; i++){
        cout << heap[i] << " ";
    }
    cout << endl;

    makeheap();

    cout << "Max Heap (makeheap/siftdown): ";
    for(int i = 0; i < 5; i++){
        cout << heap[i] << " ";
    }
    cout << endl;
}

void makeheap(){
    for (int i = index / 2; i --> 0; ){
        siftdown(i);
    }
}

//Moving the Child element to the correct position (up)
void siftup(int c){
    int p;

    if (c == 0){ return; };

    p = getParent(c);

    if (heap[c] >= heap[p]){
        return;
    } else {
        swap(&heap[c], &heap[p]);
        siftup(p);
    }
}

//Moving the Parent element to correct position (down)
void siftdown(int p){

    int c = getLeftChild(p);
    //int c = p * 2;

    if (heap[c] < heap[c + 1]) {
           c++;
    }
    if (heap[p] < heap[c]) {
        swap(&heap[p], &heap[c]);
        siftdown(c);
    }
}

int getLeftChild(int p){
    return (2 * p + 1);
}

int getParent(int c){
    return ((c - 1) / 2);
}

//Swaps the parent and the child positions in the heap
void swap(int* p, int* c){
    int iTemp = *p;
    *p = *c;
    *c = iTemp;
}