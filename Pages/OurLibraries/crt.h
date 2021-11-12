/*
-----------------------------------
Эта библиотека позволяет нам
использовать функции паскаля
которые очень удобны. Скачивай!
-----------------------------------
*/
#include <conio.h>
#include <windows.h>
#include <stdio.h>
#include <time.h>
#include <string.h>
#define readln scanf
#define read scanf
#define readkey getch
#define now_time time_t now = time(0)
#define write printf
#define red 12
#define cyan 11
#define green 10
#define magenta 13
#define yellow 14
#define centerX 38
#define centerY 11
typedef unsigned long int uli;
typedef long double ld;
typedef void v;
int gotoxy(int x, int y) {
    COORD position = {x,y}; //позиция x и y
    HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
    SetConsoleCursorPosition(hConsole, position);
    return (x, y);
}
int textcolor(short color) {
	WORD wColor;

    HANDLE hStdOut = GetStdHandle(STD_OUTPUT_HANDLE);
    CONSOLE_SCREEN_BUFFER_INFO csbi;

                       //We use csbi for the wAttributes word.
    if(GetConsoleScreenBufferInfo(hStdOut, &csbi))
    {
                 //Mask out all but the background attribute, and add in the forgournd     color
        wColor = (csbi.wAttributes & 0xF0) + (color & 0x0F);
        SetConsoleTextAttribute(hStdOut, wColor);
    }
}
int SeparatingLine(char symbol)
{
    for (int i; i < 79; i++)
    {
        printf("%c", symbol);
    }
}

int SeparatingLineN(char symbol)
{
    for (int i; i < 79; i++)
    {
        printf("%c", symbol);
    }
    printf ("\n");
}

/*
int clrscr() {
	HANDLE                     hStdOut;
  	CONSOLE_SCREEN_BUFFER_INFO csbi;
  	DWORD                      count;
 	DWORD                      cellCount;
 	COORD                      homeCoords = { 0, 0 };

	hStdOut = GetStdHandle( STD_OUTPUT_HANDLE );
	if (hStdOut == INVALID_HANDLE_VALUE) return;
	if (!GetConsoleScreenBufferInfo( hStdOut, &csbi )) return;
	cellCount = csbi.dwSize.X *csbi.dwSize.Y;
	if (!FillConsoleOutputCharacter(
		hStdOut,
	    (TCHAR) ' ',
	    cellCount,
	    homeCoords,
	    &count
	    )) return;

	  if (!FillConsoleOutputAttribute(
	    hStdOut,
	    csbi.wAttributes,
	    cellCount,
	    homeCoords,
	    &count
	    )) return;

	  	SetConsoleCursorPosition( hStdOut, homeCoords );
	  	return 0;
}
void IntToString(int value)
{
    char text[] = "";
    text = sprintf (text,value);
    return text;
}*/
