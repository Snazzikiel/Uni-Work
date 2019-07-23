/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 5 - Hashing
***********************************************/

#include <iostream>
#include <fstream>

using namespace std;

const int MAX = 100;

struct Node{
    int value;
    Node* next;
} nodes[MAX];

int hashing(int k);
void put(int input, Node nodes[]);
void addChain(Node* currNode, int input);

int forwards[MAX];
int backward[MAX];
int valid_count = 0;

int main()
{
    fstream infile;
    string filename;

    cout << "Enter file name: ";
    cin >> filename;

    infile.open(filename.c_str());
    {
        if(infile.fail())
        {
            cerr << "Unable to open " << filename << endl;
            exit(1);
        }

        int input;
        while(infile >> input)
        {
            //place value in hashNode array
            put(input, nodes);
        }

        //output
        int emptyNodes = 0;
        int longestChain = 1;
        //iterate array
        for(int i = 0; i < MAX; i++)
        {
            //cout << i << "\t" << nodes[i].value << endl;
            //if hash(value) does not equal the key
            if(hashing(nodes[i].value) != i || (hashing(nodes[i].value) == 0 && i == 0))
            {
                //that is an empty node
                emptyNodes++;
            }
            else
            {
                //if node has a link
                if(nodes[i].next != NULL)
                {
                    Node* temp = &nodes[i];
                    int chainLength = 1;

                    //iterate though linked list until end
                    while(temp->next != NULL)
                    {
                        temp = temp->next;
                        chainLength++;
                    }
                    //only keep longest chain
                    if(chainLength > longestChain)
                    {
                        longestChain = chainLength;
                    }
                }
            }
        }
        cout << "Number of empty nodes: \t\t" << emptyNodes << endl;
        cout << "Length of the longest chain: \t" << longestChain << endl;
    }
}

//hash function
int hashing(int k)
{
    //key = value mod n (100)
    k = k % MAX;
    return k;
}

void put(int input, Node nodes[])
{
    //get input key from hash function
    int hashKey = hashing(input);

    //if duplicate input (not key) do nothing
    if(nodes[hashKey].value == input)
    {
        return;
    }

    //if node has valid data already
    if(backward[hashKey] > 0 && backward[hashKey] <= valid_count && forwards[backward[hashKey]] == hashKey)
    {
        //add link
        addChain(&nodes[hashKey], input);
    }
    else
    {
        //add new data
        nodes[hashKey].value = input;
        nodes[hashKey].next = NULL;

        valid_count++;
        forwards[valid_count] = hashKey;
        backward[hashKey] = valid_count;
    }
}

void addChain(Node* currNode, int input)
{
        Node* temp = currNode;

        //increment through list
        while(temp->next != NULL)
        {
            temp = temp->next;
        }

        //create a new node and point last link to it
        Node* link = new Node();
        link->value = input;
        link->next = NULL;
        temp->next = link;
}
