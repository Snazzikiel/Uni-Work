/********************************************************************
 * CSCI251 - Ass1
 * David Azzi - da291
 * ass1.cpp - Contains function definitions for student records database
 ********************************************************************/
#include <iostream>
#include <fstream>
#include <cstring>
#include <iomanip>

using namespace std;

// ============== Constants ==========================================

const char cTextFileName[]   = "ass1.txt";
const char cBinaryFileName[] = "ass1.dat";
const int cMaxRecs = 100;
const int cMaxChars = 30;
const int cMaxSubjects = 8;

// ============= User Defined types ==================================

enum StatusType{eEnrolled,eProvisional,eWithdrawn};
struct SubjectType{ char Code[8]; StatusType Status; int Mark;};

struct StudentRecord{
    long StudentNo;
    char FirstName[cMaxChars];
    char LastName[cMaxChars];
    int NumSubjects;
    SubjectType Subjects[cMaxSubjects];
};


// ============= Global Data =========================================

StudentRecord gRecs[cMaxRecs];
int gNumRecs=0;


// ============= Private Function Prototypes =========================

void PrintRecord(int i);
int FindRecord(long StudentNum);
int FindSubject(int i, string SubjectCode);
bool ReadTextFile(char Filename[]); //reads text data from file to gRecs[] array
bool WriteTextFile(char Filename[]); //writes text data from gRecs[] to file
bool ReadBinaryFile(char Filename[]); //reads binary data from file to gRecs[] array
bool WriteBinaryFile(char Filename[]); //writes binary data from gRecs[] to file
void WriteBinaryRecord(char Filename[], int Pos); //Seeks through binary file and updates record

// ============= Public Function Definitions =========================


void ReadFile() {
/* Reads the Binary file first, if unable to locate the binary file, attempt to read the text file.
 * If the text file is found successfully, write a binary file. If not, error and exit program.
 * */
    if (!ReadBinaryFile((char*)cBinaryFileName)) {
        if (!ReadTextFile((char*)cTextFileName)) {
            cerr << "There is a problem with Binary or Text file! Exiting program..";
            exit(1);
        } else {
            WriteBinaryFile((char*)cBinaryFileName);
        }
    }
}

void DisplayRecord() {
// Displays specified record on screen
    int iStuNumb = 0;

    cout << "Enter student number: ";
    cin >> iStuNumb;
    while (!cin) { // Test to see if an integer was entered
        cout << "You must enter an integer." << endl;
        cin.clear();
        cin.ignore();
        cout << "Enter student number: ";
        cin >> iStuNumb;
    }

    int i = FindRecord(iStuNumb);

    if ( i == -1) {
        cout << "Record not found" << endl;
    } else {
        PrintRecord(i);
    }

}

void SaveFile() {
// Writes all records to the binary file, if unable to it will write all records to a text file.

    if (!WriteBinaryFile((char*)cBinaryFileName)) {
        if (!WriteTextFile((char*)cTextFileName)) {
            cerr << "There is a problem with Binary or Text file! Exiting program..";
            exit(1);
        }
    }
}

void UpdateRecord() {
// updates status or mark of specified subject of specified student number
    int iStuNumber = 0; // Student Number
    int i = 0; // Record Variant
    int j = 0; // Subject Variant

    //User Input Variables
    string sSubjectCode;
    char cUserSelection;
    int iMarkUpdate;

    cout << "Enter student number: ";
    cin >> iStuNumber;
    while (!cin) { // Test to see if an integer was entered
        cout << "You must enter an integer." << endl;
        cin.clear();
        cin.ignore();
        cout << "Enter student number: ";
        cin >> iStuNumber;
    }

    i = FindRecord(iStuNumber); // call to function for finding student record

    if (i == -1) {
        cout << "Record not found!" << endl;
    } else {
        PrintRecord(i);
        cout << endl;
        cout <<"Enter subject code: ";
        cin >> sSubjectCode;
        j = FindSubject(i, sSubjectCode); // find if subject code exists

        if (j == -1) {
            cout << "Subject code not found!" << endl;
        } else {
            while (true){ // run loop until user enters s or m
                cout << "Select status or mark (s/m): ";
                cin >> cUserSelection;
                switch(cUserSelection) {
                    case 's':
                        while (true) { // run loop until user enters e, p or w
                            cout << "Select new status" << endl;
                            cout << "    e: enrolled" << endl;
                            cout << "    p: provisional" << endl;
                            cout << "    w: withdrawn" << endl;
                            cout << "Status: ";
                            cin >> cUserSelection;
                            switch (cUserSelection) {
                                case 'e':
                                    gRecs[i].Subjects[j].Status = StatusType(0);
                                    cout << "Record " << iStuNumber << " Updated." << endl;
                                    break;
                                case 'p':
                                    gRecs[i].Subjects[j].Status = StatusType(1);
                                    cout << "Record " << iStuNumber << " Updated." << endl;
                                    break;
                                case 'w':
                                    gRecs[i].Subjects[j].Status = StatusType(2);
                                    cout << "Record " << iStuNumber << " Updated." << endl;
                                    break;
                                default:
                                    cout << "You must select 'e', 'p' or 'w'" << endl;
                                    continue;
                            }
                            break; //break while true loop - status
                        }
                        break; // break case 's'
                    case 'm':
                        cout << "Select new mark" << endl;
                        cout << "Mark: ";
                        cin >> iMarkUpdate;
                        while (!cin || (iMarkUpdate < 0 || iMarkUpdate > 100)) { // Test to see if an integer was entered between 0-100
                            cout << "You must enter an integer between 0 - 100 inclusive" << endl;
                            cin.clear();
                            cin.ignore();
                            cout << "Mark: ";
                            cin >> iMarkUpdate;
                        }
                        gRecs[i].Subjects[j].Mark = iMarkUpdate;
                        cout << "Record " << iStuNumber << " Updated." << endl;
                        break; // break case 'm'
                    default:
                        cout << "Must select an 's' or 'm'" << endl;
                        continue;
                }
                break; // break while true loop - status or mark
            }
        }
    }

    //Update the binary file with record
    //Not much alteration to add update to binary as Update file is updating the structs only.
    WriteBinaryRecord((char*)cBinaryFileName, i);
}

// ============= Private Function Definitions =========================
void WriteBinaryRecord(char Filename[], int Pos){
// Used to alter a record in the binary file by using the seekg function to gather the location.
    fstream fFile(Filename, ios:: in | ios:: out | ios::binary | ios::app); //append file, not replace

    if (!fFile.good()){
        cerr << "Problem opening data file!\n";
        exit(1);
    }

    fFile.seekg(Pos);
    fFile.write((char*)&gRecs, Pos);

    fFile.close();
}

bool ReadTextFile(char Filename[]){
//reads text data from file to gRecs[] array
    int Tmp; //variable for the enum
    ifstream ifFile(Filename);

    if (ifFile.good()){
        cerr << "Can't find text data file!\n";
        return false;
    }

    int i = 0;

    ifFile >> gRecs[i].StudentNo;

    while (!ifFile.eof()){
        ifFile >> gRecs[i].FirstName;
        ifFile >> gRecs[i].LastName;
        ifFile >> gRecs[i].NumSubjects;

        for (int j = 0; j < gRecs[i].NumSubjects; j++){
            ifFile >> gRecs[i].Subjects[j].Code;

            //Subjects Status is an enum (convert to int first)
            ifFile >> Tmp;
            gRecs[i].Subjects[j].Status = StatusType(Tmp);

            ifFile >> gRecs[i].Subjects[j].Mark;
        }

        i++;
        ifFile >> gRecs[i].StudentNo;
    }

    gNumRecs = i;
    cout << gNumRecs << " records read\n" << endl;
    ifFile.close();
    return true;
}
bool WriteTextFile(char Filename[]){
//writes text data from gRecs[] to file
    ofstream ofFile(Filename);

    if (!ofFile.good()){
        cerr << "Problem opening data file!\n";
        return false;
    }

    for (int i = 0; i < gNumRecs; i++){
        ofFile << gRecs[i].StudentNo << endl;
        ofFile << gRecs[i].FirstName << " " << gRecs[i].LastName << endl;
        ofFile << gRecs[i].NumSubjects << endl;
        for (int j = 0; j < gRecs[i].NumSubjects; j++){
            ofFile << gRecs[i].Subjects[j].Code << " " << gRecs[i].Subjects[j].Status << " ";
            ofFile << gRecs[i].Subjects[j].Mark << endl;
        }
        ofFile << endl;
    }

    cout << gNumRecs << " records saved." << endl;
    ofFile.close();
    return true;
}
bool ReadBinaryFile(char Filename[]){
//reads binary data from file to gRecs[] array
    ifstream ifFile(Filename, ios::in | ios::binary);

    if (!ifFile.good()){
        cerr << "Can't find binary data file!\n" << endl;
        ifFile.clear();
        return false;
    }

    ifFile.read((char*)&gNumRecs, sizeof(int));
    ifFile.read((char*)&gRecs, sizeof(StudentRecord) * gNumRecs);

    cout << gNumRecs << " records read from the binary file.\n" << endl;
    ifFile.close();
    return true;
}
bool WriteBinaryFile(char Filename[]){
//writes binary data from gRecs[] to file
    ofstream ofFile(Filename, ios::out | ios::binary);

    if (!ofFile.good()){
        cerr << "Problem writing to Binary Data file!\n";
        return false;
    }

    ofFile.write((char*)&gNumRecs, sizeof(int));
    ofFile.write((char*)&gRecs, sizeof(StudentRecord) * gNumRecs);
    cout << gNumRecs << " records saved to binary file." << endl;

    ofFile.close();
    return true;
}

void PrintRecord(int i) {
// Prints record that has been requested on screen
    cout << "Student No.    " << setw(8) << gRecs[i].StudentNo << endl;
    cout << "First Name    " << setw(8) << gRecs[i].FirstName << endl;
    cout << "Last Name       " << setw(8) << gRecs[i].LastName << endl;
    cout << "Subjects:" << endl;

    for(int j=0; j < gRecs[i].NumSubjects; j++){
        cout << setw(10) << gRecs[i].Subjects[j].Code << " ";

        //Print enum out with proper words
        switch(gRecs[i].Subjects[j].Status){
            case 0: cout << " Enrolled    " << setw(5);
                break;
            case 1: cout << " Provisional " << setw(5);
                break;
            case 2: cout << " Withdrawn   " << setw(5);
                break;
        }
        cout << gRecs[i].Subjects[j].Mark << endl;
    }
    cout << endl;
}

int FindSubject(int i, string sSubjectCode) {
// returns index of matching Subject records or -1 if not found

    char cSubjectCode[8];

    // Check for users correct input to 8 characters
    for (int ii = 0; ii < sSubjectCode.length(); ++ii){
        if (i <= 7){
            cSubjectCode[ii] = sSubjectCode[ii];
        } else {
            break; // exit for loop once 8 char has been entered
        }
    }

    for(int j = 0; j < gRecs[i].NumSubjects; j++){
        cSubjectCode[7] = gRecs[i].Subjects[j].Code[7]; // Match last symbol of Char for 6 character inputs
        if (strcmp(cSubjectCode, gRecs[i].Subjects[j].Code) == 0){
            return j;
        }
    }
    return -1;

}

int FindRecord(long StudentNo) {
// returns index of matching record or -1 if not found
    for (int i = 0; i < gNumRecs; i++){
        if ( gRecs[i].StudentNo == StudentNo){
            return i;
        }
    }

    return -1;

}
