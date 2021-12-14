#include <windows.h>
#include <string.h>
#include <stdio.h>
HWND bt_save;
HWND e_note;
HWND bt_open;
HWND bt_clear;
BOOL FileOpened = FALSE;
LPOPENFILENAMEA ofn;
char textOfEdit[15000];
char tempTextOfEdit[15000];

/* This is where all the input to the window goes to */
LRESULT CALLBACK WndProc(HWND hwnd, UINT message, WPARAM wparam, LPARAM lparam) {
	switch(message) {

		/* Upon destruction, tell the main thread to stop */
		case WM_DESTROY: {
			PostQuitMessage(0);
			break;
		}
		case WM_CREATE:
            GetWindowText(e_note, tempTextOfEdit, 15000);
            break;
		case WM_COMMAND: {
			if (bt_save == lparam) {
                FILE *f = fopen("Text.txt", "w");
                GetWindowText(e_note, textOfEdit, 15000);
                fprintf(f, textOfEdit);
                fclose(f);
                FileOpened = FALSE;
                MessageBox (0, "Сохранено в файл Text.txt", "Сохранение документа", MB_ICONINFORMATION | MB_OK);
			}
			else if (bt_open == lparam)
            {
                if (FileOpened == FALSE) {
                    FILE *f = fopen("Text.txt", "r");
                    if (f == 0)
                    {
                        MessageBox (0, "Файл не найден!", "Ошибка открытия файла", MB_ICONERROR);
                    }
                    GetWindowText(e_note, tempTextOfEdit, 15000);
                    fscanf(f, &textOfEdit);
                    printf("%s", textOfEdit);
                    SetWindowText(e_note, textOfEdit);
                    fclose(f);
                }
                else
                {
                    MessageBox(0, "Файл уже открыт!", "Ошибка открытия файла", MB_ICONERROR);
                }
            }
            if (bt_clear == lparam)
            {
                if (MessageBox(0, "Вы уверенны что хотите очстить текст?", "Очистить текст?", MB_ICONQUESTION | MB_OKCANCEL) == 1)
                {
                    SetWindowText(e_note, "");
                }
                else
                {
                    //************//
                }
            }
			break;
		}

		/* All other messages (a lot of them) are processed using default procedures */
		default:
			return DefWindowProc(hwnd, message, wparam, lparam);
	}
	return 0;
}

/* The 'main' function of Win32 GUI programs: this is where execution starts */
int WINAPI WinMain(HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow) {
	WNDCLASSEX wc; /* A properties struct of our window */
	HWND hwnd; /* A 'HANDLE', hence the H, or a pointer to our window */
	MSG Msg; /* A temporary location for all messages */

	/* zero out the struct and set the stuff we want to modify */
	memset(&wc,0,sizeof(wc));
	wc.cbSize		 = sizeof(WNDCLASSEX);
	wc.lpfnWndProc	 = WndProc; /* This is where we will send messages to */
	wc.hInstance	 = hInstance;
	wc.hCursor		 = LoadCursor(NULL, IDC_ARROW);

	/* White, COLOR_WINDOW is just a #define for a system color, try Ctrl+Clicking it */
	wc.hbrBackground = (HBRUSH)(COLOR_WINDOW+1);
	wc.lpszClassName = "WindowClass";
	wc.hIcon		 = LoadIcon(NULL, IDI_APPLICATION); /* Load a standard icon */
	wc.hIconSm		 = LoadIcon(NULL, IDI_APPLICATION); /* use the name "A" to use the project icon */

	if(!RegisterClassEx(&wc)) {
		MessageBox(NULL, "Window Registration Failed!","Error!",MB_ICONEXCLAMATION|MB_OK);
		return 0;
	}

	hwnd = CreateWindowEx(WS_EX_TOPMOST,"WindowClass","CPad",WS_VISIBLE|WS_OVERLAPPEDWINDOW & ~WS_MAXIMIZEBOX & ~WS_SIZEBOX,
		CW_USEDEFAULT, /* x */
		CW_USEDEFAULT, /* y */
		660, /* width */
		480, /* height */
		NULL,NULL,hInstance,NULL);
    setlocale(0, "rus");
	bt_save = CreateWindowA("button", "Сохранить",
							WS_VISIBLE | WS_CHILD,
							1, 1, 100, 50,
							hwnd, NULL, NULL, NULL);
    bt_open = CreateWindow("button", "Открыть",
                           WS_VISIBLE | WS_CHILD,
                           100,1,100,50,
                           hwnd, NULL, NULL, NULL);
    bt_clear = CreateWindow ("button", "Очистить",
                             WS_VISIBLE | WS_CHILD,
                             200,1,100,50,
                             hwnd, NULL, NULL, NULL);
    e_note = CreateWindow("edit", 0,
							WS_VISIBLE | WS_CHILD | WS_BORDER | WS_HSCROLL | WS_VSCROLL | ES_MULTILINE,
							1, 50, 651, 400,
							hwnd, NULL, NULL, NULL);
	while(GetMessage(&Msg, NULL, 0, 0) > 0) { /* If no errГЇГЇГЇГЇГЇГЇГЇГЇГЇГЇГЇГЇГ ceived... */
		TranslateMessage(&Msg); /* Translate key codes to chars if present */
		DispatchMessage(&Msg); /* Send it to WndProc */
	}
	return Msg.wParam;
}
