#include <windows.h>
#include <stdio.h>
#include <time.h>
#include <gl/gl.h>
#include <math.h>

#define CASE case
#define BREAK break
#define IF if
#define SWITCH switch
#define ELSE else
#define ELSEIF else if
#define elseif esle if
#define equals ==
#define less <
#define more >
#define cls system("cls")
#define NewLine \n
#define Tab \t

#include "h:\OpenGLL\stb-master\stb_easy_font.h"
float theta = 0.0f, theta1 = 0.0f;
LRESULT CALLBACK WindowProc(HWND, UINT, WPARAM, LPARAM);
void EnableOpenGL(HWND hwnd, HDC*, HGLRC*);
void DisableOpenGL(HWND, HDC, HGLRC);
RECT rect;
char ch = 0;
FILE* f;
long int step, colorStep = 0;
int width = 0;
int height = 0;
BOOL painted1 = FALSE, painted2 = FALSE, painted3 = FALSE;
long int speed = 0;
short colorR = 0, colorG = 0, colorB = 0;
char thbool = 0;
char txt[] = "Intro Maker 1.0";
short colorBool = 0;
short showPS = 0;
short translate = 1;
int x,y,z;
typedef char* str;
void print_string(float x, float y, char text[], float r, float g, float b)
{
  static char buffer[99999]; // ~500 chars
  int num_quads;

  num_quads = stb_easy_font_print(x, y, text, NULL, buffer, sizeof(buffer));

  glColor3f(r,g,b);
  glEnableClientState(GL_VERTEX_ARRAY);
  glVertexPointer(2, GL_FLOAT, 16, buffer);
  glDrawArrays(GL_QUADS, 0, num_quads*4);
  glDisableClientState(GL_VERTEX_ARRAY);
}
void Stealth()
{
 HWND Stealth;
 AllocConsole();
 Stealth = FindWindowA("ConsoleWindowClass", NULL);
 ShowWindow(Stealth,0);
}
void CloseText()
{
    strcpy (txt, "");
}
int WINAPI WinMain(HINSTANCE hInstance,
                   HINSTANCE hPrevInstance,
                   LPSTR lpCmdLine,
                   int nCmdShow)
{
    HWND myConsole = GetConsoleWindow();
    ShowWindow(myConsole,SW_HIDE);
    /**f = fopen("text.spec", "w+");
        fscanf(f, "%s", &openedFileText);
    fclose(f);**/
    WNDCLASSEX wcex;
    HWND hwnd;
    HDC hDC;
    HGLRC hRC;
    MSG msg;
    BOOL bQuit = FALSE;


    /* register window class */
    wcex.cbSize = sizeof(WNDCLASSEX);
    wcex.style = CS_OWNDC;
    wcex.lpfnWndProc = WindowProc;
    wcex.cbClsExtra = 0;
    wcex.cbWndExtra = 0;
    wcex.hInstance = hInstance;
    wcex.hIcon = LoadIcon(NULL, IDI_APPLICATION);
    wcex.hCursor = LoadCursor(NULL, IDC_ARROW);
    wcex.hbrBackground = (HBRUSH)GetStockObject(BLACK_BRUSH);
    wcex.lpszMenuName = NULL;
    wcex.lpszClassName = "GLSample";
    wcex.hIconSm = LoadIcon(NULL, IDI_APPLICATION);;


    if (!RegisterClassEx(&wcex))
        return 0;

    /* create main window */
    hwnd = CreateWindowEx(0,
                          "GLSample",
                          "Генератор заставок",
                          WS_OVERLAPPEDWINDOW & ~WS_MAXIMIZEBOX & ~WS_MINIMIZEBOX & ~WS_SIZEBOX,
                          CW_USEDEFAULT,
                          CW_USEDEFAULT,
                          1200,
                          860,
                          NULL,
                          NULL,
                          hInstance,
                          NULL);

    ShowWindow(hwnd, nCmdShow);
    printf ("Window created!\n");

    /* enable OpenGL for the window */
    EnableOpenGL(hwnd, &hDC, &hRC);

    /* program main loop */
    while (!bQuit)
    {
        /* check for messages */
        if (PeekMessage(&msg, NULL, 0, 0, PM_REMOVE))
        {
            /* handle or dispatch messages */
            if (msg.message == WM_QUIT)
            {
                bQuit = TRUE;
            }
            else
            {
                TranslateMessage(&msg);
                DispatchMessage(&msg);
            }
        }
        else
        {
            /* OpenGL animation code goes here */

            glClearColor(0.0f, 0.0f, 0.0f, 0.0f);
            glClear(GL_COLOR_BUFFER_BIT);
            glPushMatrix();
                glScalef(0.015, -0.015, 1);
                if (showPS == 0)
                    print_string(-30,-50,txt,0,1,1);
            glPopMatrix();
            glPushMatrix();
            glRotatef(theta, 0.0f, 0.0f, 0.0f);
            /**glPointSize (10);
            glBegin(GL_POINTS);
                glColor3f(0,0,0);
                glVertex2f(0.5, 0.5);
                glVertex2f(-0.5, -0.5);
                glVertex2f(-0.5, 0.5);
                glVertex2f(0, 0);
                glVertex2f(0.5, -0.5);
            glEnd();**/

            glEnable(GL_LINE_STIPPLE);

            glLineStipple(1, 0x00ff);

            glLineWidth(5);
            glBegin(GL_LINE_LOOP);
                glColor3f(colorR + 1,colorG,colorB);
                glVertex2f(0.5, 0.5);
                glVertex2f(-0.5, 0.5);
                glColor3f(colorR,colorG,colorB + 1); ///colorR, colorG, colorB
                glVertex2f(-0.5, -0.5);
                glVertex2f(0.5, -0.5);

            glEnd();
            if (painted1 != TRUE)
                printf ("Painted first quad\n"); painted1 = TRUE;
            glBegin(GL_LINE_LOOP);
                glColor3f(colorR + 1,colorG,colorB);
                glVertex2f(0.3, 0.3);
                glVertex2f(-0.3, 0.3);
                glColor3f(colorR,colorG,colorB + 1);
                glVertex2f(-0.3, -0.3);
                glVertex2f(0.3, -0.3);
            glEnd();
            if (painted2 != TRUE)
                printf ("Painted second quad\n"); painted2 = TRUE;
            glDisable(GL_LINE_STIPPLE);

            glBegin(GL_LINE_LOOP);
                glColor3f(colorR + 1,colorG,colorB);
                glVertex2f(0.4, 0.4);
                glVertex2f(-0.4, 0.4);
                glColor3f(colorR,colorG,colorB + 1);
                glVertex2f(-0.4, -0.4);
                glVertex2f(0.4, -0.4);
            glEnd();
            if (painted3 != TRUE)
                printf ("Painted third quad\n"); painted3 = TRUE;

            glPopMatrix();
            SwapBuffers(hDC);
            theta1 += 1.0f;
            if (thbool != 1) {
                theta += 1.0f + speed;
                printf("step: %d\n", step);
            }
            else
            {
                theta = theta;
            }
            step += 1;
            if (step >= 547)
            {
                if (colorBool != 1) {
                    colorStep += 1;
                    if (colorStep == 1) {
                        srand(time(0));
                        step = 0;
                        colorR = 0;
                        colorG = 1;
                        colorB = 0;
                    }
                    else if (colorStep == 2)
                    {
                        srand(time(0));
                        step = 0;
                        colorR = 0;
                        colorG = 0;
                        colorB = 1;
                    }
                    else if (colorStep == 3)
                    {
                        srand(time(0));
                        step = 0;
                        colorR = 1;
                        colorG = 0;
                        colorB = 0;
                    }
                    else if (colorStep == 4)
                    {
                        srand(time(0));
                        step = 0;
                        colorR = -1;
                        colorG = 1;
                        colorB = 0;

                    }
                    else if (colorStep == 5)
                    {
                        step = 0;
                        colorR = 0;
                        colorG = 1;
                        colorB = -1;
                    }
                    else if (colorStep == 6)
                    {
                        step = 0;
                        colorR = 0;
                        colorG = 0;
                        colorB = 0;
                        colorStep = 0;
                    }
                }
                printf("Setted new color\n");
            }
            Sleep (1);
        }
    }

    /* shutdown OpenGL */
    DisableOpenGL(hwnd, hDC, hRC);

    /* destroy the window explicitly */
    DestroyWindow(hwnd);

    return msg.wParam;
}

LRESULT CALLBACK WindowProc(HWND hwnd, UINT uMsg, WPARAM wParam, LPARAM lParam)
{
    switch (uMsg)
    {
        case WM_CLOSE:
            thbool = 1;
            if (MessageBoxA(0, "Вы уверенны что хотите закрыть программу?", "Закрыть приложение?", MB_OKCANCEL | MB_ICONQUESTION) == 1)
                PostQuitMessage(0);
            else
                thbool = 0;
        break;

        case WM_DESTROY:
            return 0;

        case WM_KEYDOWN:
        {
            switch (wParam)
            {
                case VK_UP:
                    theta = 0;
                    break;
                case VK_DOWN:
                    thbool = 1;
                    colorBool = 1;
                    break;
                case VK_LEFT:
                    theta -= 1.0;
                    step -= 1;
                    printf("step: %d\n", step);
                    break;
                case VK_RIGHT:
                    theta += 1.0;
                    step += 1;
                    printf("step: %d\n", step);
                    break;
                case VK_RETURN:
                    thbool = 0;
                    colorBool = 0;
                    strcpy(txt, "");
                    break;
                case VK_ADD:
                    speed += 1.0f;
                    break;
                case VK_SUBTRACT:
                    speed -= 1.0f;
                    break;
                case VK_MULTIPLY:
                    speed = 0;
                    break;
                case VK_DIVIDE:
                    step += 540;
                    break;
                case VK_SHIFT:
                    colorBool = 1;
                    break;
                case VK_SPACE:
                    colorBool = 0;
                    break;
                case '1':
                    showPS = 1;
                    break;
                case '2':
                    showPS = 0;
                    break;
                case 'S':
                    colorB = -1;
                    colorG = 0;
                    colorR = -1;
                    thbool = 1;
                    theta = 0;
                    step = 0;
                    colorBool = 1;
                    break;
                case '3':
                    Beep(600, 100);
                    break;
                case '4':
                    Beep(700, 100);
                    break;
                case '5':
                    Beep(800, 100);
                    break;
                case '6':
                    Beep(900, 100);
                    break;
                case '7':
                    Beep(1000, 100);
                    break;
                case 'H':
                    Beep(800, 500);
                    MessageBox(GetDesktopWindow(), "[Up] - восстановить размер куба на стандартный\n[Down] - Остановить изменение (поставить паузу) размера куба\n[Left] - Увеличить размер куба\n[Right] - Уменьшить размер куба\n[Space] - Разрешить изменение цвета куба\n[Shift] - Запретить изменение куба\n[W] -  Пересоздать куб\n[S] - Убрать куб\n[1] - Прекратить показ надпись \"Intro maker 1.0\" (2 - обратный результат)\n[+] и [-] - регулирует скорость изменения размера куба\n[*] - Выставить стандартную скорость\n[Enter] - Выйти из режима паузы\nОт [3] до [7] - выдача звуков\n[8] - Запустить режим \"Debug\"\n[9] - Выключить режим \"Debug\"", "Помощь", MB_ICONINFORMATION | MB_OK);
                    break;
                case '8':
                    ShowWindow(GetConsoleWindow(), TRUE);
                    break;
                CASE '9':
                    ShowWindow(GetConsoleWindow(), FALSE);
                    BREAK;
                CASE 'W':
                    colorR = 0;
                    colorB = 0;
                    thbool = 0;
                    theta = 0;
                    colorBool = 0;
                    break;
                case VK_NUMPAD1:
                    showPS = 1;
                    break;
                case VK_NUMPAD2:
                    showPS = 0;
                    break;
                default:
                    MessageBeep(0);
                    step = step;
                    speed = speed;

            }
        }
        break;
        case WM_TIMER:
            MessageBox (0,"Timer working!", "", MB_OK);
            break;

        default:
            return DefWindowProc(hwnd, uMsg, wParam, lParam);
    }

    return 0;
}

void EnableOpenGL(HWND hwnd, HDC* hDC, HGLRC* hRC)
{
    PIXELFORMATDESCRIPTOR pfd;

    int iFormat;

    /* get the device context (DC) */
    *hDC = GetDC(hwnd);

    /* set the pixel format for the DC */
    ZeroMemory(&pfd, sizeof(pfd));

    pfd.nSize = sizeof(pfd);
    pfd.nVersion = 1;
    pfd.dwFlags = PFD_DRAW_TO_WINDOW |
                  PFD_SUPPORT_OPENGL | PFD_DOUBLEBUFFER;
    pfd.iPixelType = PFD_TYPE_RGBA;
    pfd.cColorBits = 24;
    pfd.cDepthBits = 16;
    pfd.iLayerType = PFD_MAIN_PLANE;

    iFormat = ChoosePixelFormat(*hDC, &pfd);

    SetPixelFormat(*hDC, iFormat, &pfd);

    /* create and enable the render context (RC) */
    *hRC = wglCreateContext(*hDC);

    wglMakeCurrent(*hDC, *hRC);
}

void DisableOpenGL (HWND hwnd, HDC hDC, HGLRC hRC)
{
    wglMakeCurrent(NULL, NULL);
    wglDeleteContext(hRC);
    ReleaseDC(hwnd, hDC);
}

