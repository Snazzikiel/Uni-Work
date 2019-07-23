/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 8 - Crazy Eights
***********************************************/

#include <iostream>
#include <iomanip>
#include <fstream>
#include <cstring>

using namespace std;

struct stCards{
    int iCardNo;
    char cCardSuit;
};

int sortCard(int);
bool isLike(stCards, stCards);
void crazyUp();

stCards Cards[52];
int iCardItr = 0;

int main(){

    string sFileName;
    ifstream fin;
    string sLineData;

    char cstr[4];
    int c = 0;
    int strLength;

    stCards* card;

    cout << "Enter file name: ";
    //sFileName = "Ex8.txt";
    cin >> sFileName;

    fin.open(sFileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }


    while (fin >> sLineData){

        strLength = sLineData.length();
        card = &Cards[iCardItr];
        strcpy(cstr, sLineData.c_str());

        //Add the number of card
        //if the length is 3, value is 10
        if (strLength == 3){
            card->iCardNo = 10;
            card->cCardSuit = cstr[2];
        } else {
            //turn the ASCII char in to a normal number, if it is letter turn it in to 1/11/12/13(A/J/Q/K)
            c = (int)cstr[0] - 48;
            if (c > 9){
                c = sortCard(c);
            }
            card->iCardNo = c;
            card->cCardSuit = cstr[1];
        }

        iCardItr++;
    }

    crazyUp();

    fin.close();

    return 0;

}

void crazyUp(){
    int iLength[52];
    int iMaxLength = 0;
    int len = 0;
    int iLastCard = 0;
    int iFirstCard = 0;

    iLength[0] = 0;

    for (int i = 0; i < iCardItr; i++){
        len = 1;
        if (i == 47){

        }
        for (int j = i - 1; j > 0; j--){
            if (isLike(Cards[i], Cards[j])){
                //len = max(len, iLength[j]+1);
                if (len < iLength[j]+1){
                    len = iLength[j]+1;
                    iLastCard = j;
                }
            }
        }
        iLength[i] = len;
        //iMaxLength = max(iMaxLength, len);
        if (iMaxLength < len){
            iMaxLength = len;
            iFirstCard = i;
        }
    }

    cout << "The Maximum Length of the longest sequence is: " << iMaxLength << endl;
    cout << "The First Card in the sequence is: " << Cards[iFirstCard].iCardNo <<  Cards[iFirstCard].cCardSuit << endl;
    cout << "The Last Card in the sequence is: " << Cards[iLastCard].iCardNo << Cards[iLastCard].cCardSuit << endl;

}

int sortCard(int x){
    //A=17 J=26 Q=33 K=27

    if (x == 17){
        return 1;
    } else if (x == 26){
        return 11;
    }else if (x == 33){
        return 12;
    }else{  // 27
        return 13;
    }
}

bool isLike(stCards cardOne, stCards cardTwo){
    if ((cardOne.cCardSuit == cardTwo.cCardSuit) || (cardOne.iCardNo == 8) || (cardOne.iCardNo == cardTwo.iCardNo) || (cardTwo.iCardNo == 8)){
        return true;
    }
    return false;
}
