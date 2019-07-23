/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 4 - BST Sort
***********************************************/


#include <iostream>
#include <fstream>
#include <iomanip>

using namespace std;

struct bst_node{
    bst_node* left = 0;
    bst_node* right = 0;
    int data = 0;
};
typedef bst_node *BstPtr;

BstPtr root;
bool bFirst = false;
int iLineCount = 0;

//function initialisers
void insert_first(int, BstPtr);
void insert(int, BstPtr);
void InOrder(BstPtr);

int main(){
    string sFileName;
    int iLineData;
    ifstream fin;

    //cout << "Enter file name: ";
    //cin >> sFileName;
    sFileName = "Ex4.txt";
    fin.open(sFileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }

    root = new bst_node();

    while ( fin >> iLineData){
        if (!bFirst){
            insert_first(iLineData, root);
            bFirst = true;
        } else {
            insert(iLineData, root);
        }
    }

    InOrder(root);

    return 0;

}

//insert integer value in to tree
//filter through tree, find parent and identify if it is to be placed left or right
void insert(int value, BstPtr node){

    bool left = false;
    BstPtr next;

    int xx = node->data;
    if (root == NULL){
        return;
    } else if (value == node->data){
        return;
    } else if (value < node->data ) {
        next = node->left;
        left = true;
    } else {
        next = node->right;
        left = false;
    }

    if ( next != NULL){
        insert(value, next);
    } else {
        next = new bst_node;
        next->data = value;
        if (left) {
            node->left = next;
        } else {
            node->right = next;
        }
    }
}

//printout the tree
void InOrder(BstPtr node){
    if(node != NULL)
    {

        if(node->left) {
            InOrder(node->left);
        }
        if (iLineCount%10 == 0 && iLineCount != 0){
            cout << endl;
        }
        cout<< setw(5) << node->data <<" ";
        iLineCount++;

        if(node->right) {
            InOrder(node->right);
        }
    }
    else {
        return;
    }
}

//initialise the first parent of the tree
void insert_first(int value, BstPtr root){
    root->data = value;
    root->left = NULL;
    root->right = NULL;
}
