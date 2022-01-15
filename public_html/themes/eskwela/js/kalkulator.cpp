#include <iostream>
#include <cstdio>

using namespace std;
//Maksymilian Mastalerczyk
int main( void )
{
    int statystyka=0;
    unsigned int n; //z tej liczby będziemy liczyć silnię
    long long silnia = 1; //ta zmienna będzie przechowywać wynik
    int dzialanie, a, b; // zmienne przechowujace podstawowe dzialania
    dzialanie = 0;
   
    do {
        statystyka++;
        cout << "Bardzo prosty kalkulator Maksa"
        << endl << "Wpisz numer dzialania, ktore chcesz wykonac"
        << endl << "[1] Dodawanie"
        << endl << "[2] Odejmowanie"
        << endl << "[3] Mnozenie"
        << endl << "[4] Dzielenie"
        << endl << "[5] Silnia"
        << endl << "[6] Zatrzymaj kalkulator"
        << endl << "Numer działania: ";
       
        cin >> dzialanie;
       
        switch( dzialanie ) {
        case 1://dodawanie
            cout << "Podaj pierwsza liczbe:";
            cin >> a;
            cout << "Podaj druga liczbe:";
            cin >> b;
            cout << "Wynik: " << a + b << endl;
            break;
           
        case 2://odejmowanie
            cout << "Podaj pierwsza liczbe:";
            cin >> a;
            cout << "Podaj druga liczbe:";
            cin >> b;
            cout << "Wynik: " << a - b << endl;
            break;
           
        case 3://mnozenie
            cout << "Podaj pierwsza liczbe:";
            cin >> a;
            cout << "Podaj druga liczbe:";
            cin >> b;
            cout << "Wynik: " << a * b << endl;
            break;
           
        case 4://dzielenie
            cout << "Podaj pierwsza liczbe:";
            cin >> a;
            cout << "Podaj druga liczbe:";
            cin >> b;
            while(b==0){
                cout << "Druga liczba nie moze być 0, podaj drugą liczbe:";
                cin >> b;
            }
            cout << "Wynik: " << a / b << endl;
           
            break;
           
        case 5://silnia
            cout<<"Podaj n: ";
            cin>>n;
            for(int i=n;i>1;i--)
                silnia*=i; //lub silnia = silnia * i
            cout<<n<<"Silnia to: "<<silnia<<endl;
            break;
        case 6://koniec programu
        break;
        default:
            cout << "Nieprawidlowe dzialanie." << endl;
        }
    } while( dzialanie != 6 );
    5
    
    if(statystyka<3){
         cout << "Wykonales bardzo malo obliczen!";
    }else if(statystyka<6){
        cout << "Wykonales kilka obliczen!";
    }else if(statystyka<10){
        cout << "Wykonales bardzo duzo obliczen!";
    }

    cout << "No to dowidzenia!";
    system("pause");
    return 0;
   
}