/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
***********************************************/


#include <iostream>
#include <fstream>
//#include <array>
using namespace std;

//Variables
const int StackSize = 100;
string Words[StackSize];
int StackCount = 0;
ifstream fin;


//Declarations
void push(string);
string top();
void pop();
bool FullStack();
bool EmptyStack();


int main() {
	
	
	string FileName;
	string LineData;
		
	cout << "Enter file name: ";
	cin >> FileName;
	
	fin.open(FileName.c_str());
	
	if(!fin.good()){ cerr << "File not found\n"; exit(1); }

	while (fin >> LineData){
		push(LineData);
	}
	
	fin.close();
	pop();
	
	while (!EmptyStack()){
		cout << top() << " ";
		pop();
	}
	
	return 0;
}

void push(string word){
	
	if (!FullStack()){
		cout << "Stack is full." << endl;
	} else {
		Words[StackCount] = word;	
		StackCount++;
	}
}

string top(){
	return Words[StackCount];
}

void pop(){
	StackCount--;
}

bool EmptyStack(){
	if (StackCount < 0){
		return true;
	}
	return false;
}

bool FullStack(){
	if (StackCount >= StackSize ){
		return false;
	}
	return true;
}
