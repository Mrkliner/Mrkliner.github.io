format pe console


include 'win32ax.inc'

entry main

section '.data!!!' data readable writeable

strHello db 'Hello World !',13,10,0
strPause db 'pause',0

section '.txt' code executable readable

main:
       ; you can use crt functions or windows API.
       cinvoke printf,strHello
       cinvoke system,strPause; or import getc()
       ; or
       ; invoke printf,srtHello
       ; add esp, 4

       ; or use WriteFile and GetStdHandle APIs
       push 0
       call [ExitProcess]
      
section '.blah' import data readable

library kernel32,'kernel32.dll',\
    msvcrt,'msvcrt.dll'    ;; C-Run time from MS. This is always on every windows machine

import kernel32,\
          ExitProcess,'ExitProcess'
import msvcrt,\
          printf,'printf',\
          system,'system', \
          scanf, 'scanf'
