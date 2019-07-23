/**********************************************
* CSCI203 - Algorithms & Data Structures
* David Azzi - da291 - 4774905
* Exercise 6 - Karp-Rabin String Search
***********************************************/

#include <iostream>
#include <fstream>
#include <cstring>

using namespace std;

static const int alpha = 4;
static const int prime = 257;

char chain[5000];
char key[10];

void fn_KarpRabin();
int get_hash();

int main(){
    string sFileName;
    string sLineData;
    ifstream fin;

    cout << "Enter file name: ";
    cin >> sFileName;
    //sFileName = "Ex6.txt";
    fin.open(sFileName.c_str());

    if (!fin.good()) {
        cerr << "File not found\n";
        exit(1);
    }

    fin >> sLineData;
    strcpy(chain, sLineData.c_str());
    fin >> sLineData;
    strcpy(key,sLineData.c_str());

    cout << "Found PATTERN (" << sLineData << ") at the following locations: " << endl;
    fn_KarpRabin();

    fin.close();

    return 0;

}


int get_hash(){

    int hsh = 1;

    for (int i = 0; i < strlen(key) - 1; i++){
        hsh = (hsh * alpha ) % prime;
    }

    return hsh;
}


void fn_KarpRabin(){

        int M = strlen(key);
        int N = strlen(chain);
		int j = 0;
        int p = 0; // hash value for pattern
        int t = 0; // hash value for txt
        int h = get_hash(); // counter hash %


        for (int i = 0; i < M; i++)
        {
            p = ( alpha * p + key[i])% prime;
            t = ( alpha * t + chain[i])% prime;
        }

        for (int i = 0; i <= N - M; i++)
        {
            if ( p == t )
            {
                for (j = 0; j < M; j++)
                {
                    if (chain[i+j] != key[j])
                        break;
                }

                //print out the match
                if (j == M)
                    cout << i << " ";
            }

            if ( i < N-M )
            {
                t = ( alpha *(t - chain[i]*h) + chain[i+M])% prime;

                //make T a positive if returned negative
                if (t < 0)
                    t = (t + prime);
            }
        }
}


