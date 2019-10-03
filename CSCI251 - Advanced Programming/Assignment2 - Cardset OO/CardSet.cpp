/**********************************************
* CSCI251 - Assignment 2
* David Azzi - da291 - 4774905
* CardSet.cpp - Contains implementation of class CardSet
***********************************************/


#include <iostream>
#include <stdlib.h>
#include "CardSet.h"
using namespace std;

//Default Constructor
//Sets up a set of 0 cards
CardSet::CardSet(){
    Card = NULL;
    nCards = 0;
}

//Initialising constructor
//setups a set of cards
//ARGUMENTS:
//iCard = the number of cards in CardSet.
CardSet::CardSet(int iCard){
    Card = new int[iCard];
    nCards = iCard;
    for (int iTmp = 0; iTmp < iCard; iTmp++){
        Card[iTmp] = iTmp % 52; //Mod for remainder of 52
    }

}

//Destructor to clean up any dynamic memory used
CardSet::~CardSet(){
    nCards = 0; //return card count to zero
    delete[] Card; //delete and clear entire Card pointer list
}

//Return the value of nCards
int CardSet::Size() const{
    return nCards;
}

//function should return true if there are no cards in this set.
bool CardSet::IsEmpty() const {
    if (Card == 0){
        return true;
    } else {
        return false;
    }
}


//Deal cards, returning the first card in the set - located in the 0th element of the array.
int CardSet::Deal(){

    //Check to see if cardset is empty, if it is - return error message and quit
    if (IsEmpty()){
        cerr << "Unable to deal a card. CardSet is empty." << endl;
        exit(1);
    }

    int iFirstCard = 0;

    int* NewCard = new int[nCards - 1]; //tmp CardSet is 1 less card

    iFirstCard = Card[0]; //Save first card to random int variable

    for (int i = 1; i < nCards; i++){ // Load rest of cards in to new memory
        NewCard[i-1] = Card[i];
    }

    nCards--; //Cardstack now has 1 less card
    delete Card; // delete old memory
    Card = new int[nCards];
    //Card = NewCard; //Move new card

    for (int i = 0; i < nCards; i++){ // Load rest of cards in to new memory
        Card[i] = NewCard[i];
    }
    return iFirstCard;
}


//Deals current CardSet to 2 Players. Check to see if there is enough cards in the hand to deal,
// if so, deal to each player.
//ARGUMENTS:
//iTotalHand = Total Cards dealt to each player
//Player1 & Player2 = CardSet objects as Players
void CardSet::Deal(int iTotalHand, CardSet& Player1, CardSet& Player2){

    //Check to see if there is enough cards in the hand to deal to 2 players, if not - error and exit.
    if (nCards < (iTotalHand * 2)){
        cerr << "There are not enough cards in the CardSet to deal to 2 players." << endl;
        exit(1);
    }

    //Deal card to each player
    for (int i = 0; i < iTotalHand; i++){
        Player1.AddCard(Deal());
        Player2.AddCard(Deal());
    }
}

//Deals current CardSet to 2 Players. Check to see if there is enough cards in the hand to deal,
// if so, deal to each player.
//individual player.
//ARGUMENTS:
//iTotalHand = Total Cards dealt to each player
//Player1, Player2 Player3, Player4 = CardSet objects as Players
void CardSet::Deal(int iTotalHand, CardSet& Player1, CardSet& Player2, CardSet& Player3, CardSet& Player4){

    //Check to see if there is enough cards in the hand to deal to 4 players, if not - error and exit.
    if (nCards < (iTotalHand * 4)){
        cerr << "There are not enough cards in the CardSet to deal to 4 players." << endl;
        exit(1);
    }

    //Deal card to each player
    for (int i = 0; i < iTotalHand; i++){
        Player1.AddCard(Deal());
        Player2.AddCard(Deal());
        Player3.AddCard(Deal());
        Player4.AddCard(Deal());
    }
}

//Adds a card to the end of the current CardSet.
//Must replace current cardset with extension of memory by 1
//ARGUMENT:
//iCard = Add card to Current Hand
void CardSet::AddCard(int iCard){

    int* tmpCard = new int[Size() + 1];

    //Add CardSet to tmpCardSet with new card as last card
    for (int iTmp = 0; iTmp <= nCards; iTmp++){
        if (iTmp != nCards){
            tmpCard[iTmp] = Card[iTmp];
        } else {
            tmpCard[iTmp] = iCard;
        }
    }

    //Remove current CardSet and extend memory by 1
    nCards++; // add card to total cards
    delete[] Card;
    Card = new int[nCards];
    //Card = tmpCard;
    for (int iTmp = 0; iTmp < nCards; iTmp++){
        Card[iTmp] = tmpCard[iTmp];
    }
    //Clean up
    delete[] tmpCard;
}

//rearranges the cards in the set in a random manner.
//Once the cards have been initiated, they are shuffled to allow player fairness
void CardSet::Shuffle() {

    int iRand = 0; // random number variable

    for (int i = 0; i < nCards; i++){
        iRand = Card[i];
        while (iRand == Card[i]){
            iRand = rand() % (nCards - 1); //while loop to ensure same number card is not dealt
        }
        Card[i] = iRand;
    }
}

//This function takes the current set and the set provided as an argument and makes the current set contain all
//the cards from the two sets, with cards alternating from each set as far as possible.
void CardSet::MergeShuffle(CardSet& objCards){

    int iTmpSize = objCards.Size() + nCards;
    int *tmpCard; // Create temp Card with size of both CardSets
    CardSet tmpCardSet;
    int iCounter = 0;
    int iCounter1 = 0;

    for (int i = 0; i < iTmpSize; i++){
        if (iCounter < nCards){
            tmpCardSet.AddCard(Card[iCounter]);
            iCounter++;
        }
        if (iCounter1 < objCards.Size()){
            tmpCardSet.AddCard(objCards.Card[iCounter1]);
            iCounter1++;
        }
    }

    //Clear both existing CardSets
    delete[] Card;
    delete[] objCards.Card;
    objCards.nCards = 0;

    //Fill with new Cardset
    Card = new int[iTmpSize];
    nCards = iTmpSize;
    //Fill new array with Temp
    for (int iTmp = 0; iTmp < nCards; iTmp++){
        Card[iTmp] = tmpCardSet.Card[iTmp];
    }

    //Cleanup
    delete[] tmpCardSet.Card;

}

//function to print out entire card hard
void CardSet::Print() const {
    int iCount = 0;

    //print 5 cards out with a tab space each and go to new line
    for (int i = 0; i < nCards; i++){
        PrintCard(Card[i]);
        cout << "\t";
        iCount++;
        if (iCount >= 5) {
            cout << endl;
            iCount = 0;
        }
    }
    cout << endl;
}


// Private function to print out usual representation of playing card.
// Input is integer from 0 to 51.  There is no error checking.
void CardSet::PrintCard(int c) const
{
    int Rank = c%13;
    int Suit = c/13;
    const char NameSuit[5] = "SCDH";
    const char NameRank[14] = "23456789XJQKA";
    cout << NameRank[Rank] << NameSuit[Suit];
}



