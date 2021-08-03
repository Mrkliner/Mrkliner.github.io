#include <stdio.h>
#include <stdlib.h>
#include <windows.h>
#define NEW_LINE printf ("\n")
#define LANG_RUS Lang_rus()
#define TRUE_C 't'
#define FALSE_C 'f'
#define B_OK 'k'
#define B_OK_B_CANCLE 'c'
#define B_YES_B_NO 'y'
/*
	Information: Use the command in your compiler -std=c99 or -std=gnu99
*/
typedef unsigned long int ULI;
typedef short shortint;
typedef int integer;
typedef long longont;
typedef float Float;
typedef char BOOLEAN_C;
typedef char Mbuttons;
/**/
int PrntText (char Text[])
{
	printf ("%s", Text);
}	
int PrintTextLine (char TextLine[])
{
	printf ("%s\n", TextLine);
}
int summ(ULI first_num, ULI second_num)
{
	ULI result = first_num + second_num;
	return result;
}
int PrintNumber (ULI numb)
{
	printf ("%d", numb);
}
int PrintNumberLine (ULI numbLine)
{
	printf ("%d\n", numbLine);
}
int mul (ULI first, ULI second)
{
	ULI result = first * second;
	return result;
}
int divup(ULI first, ULI second)
{
	ULI result = first / second;
	return result;
}
int DisplayStrByQuantity(ULI amount, char symbol[])
{
	for (int i; i<amount; i++)
	{
		printf ("%s", symbol);
	}
}
int DisplayStrLineByQuantity(ULI amount, char symbol[])
{
	for (int i; i<amount; i++)
	{
		printf ("%s\n", symbol);
	}
}
void Lang_rus (void)
{
	setlocale (0, "rus");
}
int random(ULI first, ULI second)
{
	ULI res = first + rand() % second;
	return res;
}
int MBoxI(char Caption[], char Text[], Mbuttons Button)
{
	if (Button == B_OK)
	{
		MessageBox (0, Text, Caption, MB_OK | MB_ICONINFORMATION);
	}
	if (Button == B_OK_B_CANCLE)
	{
		MessageBox (0, Text, Caption, MB_OKCANCLE | MB_ICONINFORMATION);
	}
	if (Button == B_YES_B_NO)
	{
		MessageBox (0, Text, Caption, MB_YESNO | MB_ICONINFORMATION);
	}
}
int MBoxW (char Caption[], char Text[], Mbuttonts Button)
{
	if (Button == B_OK)
	{
		MessageBox (0, Text, Caption, MB_OK | MB_ICONWARNING);
	}
	if (Button == B_OK_B_CANCLE)
	{
		MessageBox (0, Text, Caption, MB_OK_CANCLE | MB_ICONWARNING);
	}
	if (Button == B_YES_B_NO)
	{
		MessageBox (0, Text, Caption, MB_YES_NO | MB_ICONWARNING);
	}
}
