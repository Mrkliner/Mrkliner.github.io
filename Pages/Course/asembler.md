<h1>Что такое Assembler (NASM, FASM, TASM, WASM)</h1>
<h3>Ассеблер - это машинный язык программирования. Его очень хорошо понимает процессор вашей машины. На нём писать программы трудно, но они получаются очень маленькие по размеру и быстрые. Ассемблер появился в 1947 году прошлого века. И в этом курсе от разработчика mrkliner.github.io мы изучим базовые комманды ассемблера.</h3>
<h4>Во всём курсе мы будем использовать синтаксис FASM</h4>
<h2>---Комманда mov---</h2>
<h3>Синтаксис такой </h3> <a>mov отправитель, получатель</a>
<h3>Она используется для пермещения или задaвания значения переменной или регистра (список регистров можно найти в интернете).</h3>
<h3>Пример программы синтаксиса FASM</h3>
<h3>format mz
    mov ax, bx
</h3>
<h3>Это был пример использования комманды mov в ассемблере используя синтаксис FASM</h3>
<h2>---Комманда add---</h2>
<h3>Синтаксис такой </h3> <a>add что, к чему</a>
<h3>Прибавляет к регистру или переменной другую переменную или регистр или же число</h3>
<h3>Пример использования комманды add синтаксиса FASM
    format mz
    add ax, 400
    таким образом мы поместили в регистр ax число 400
</h3>
<h2>---Метки в языке ассемблер---</h2>
<h3>Метки это тоже самое что и функции в любом другом языке программироания. Синтаксис метки такой <имя метки>: 
    пример метки в программе будет показан ниже. На метку можно перейти и вызвать её однократно, а таке зациклить
    пример программы с меткой:
    forma mz
    start:
          mov ax, bx
    <hr>
    Пример был очень простой. В метку как и в функцию в С++ вы можете помещать строки кода и вызывать её где угодно ии прыгать на метку отуда угодно.
    <h2>---jmp и call---</h2>
    <h3>Jmp это прыжок на метку - то есть у вас есть метка с код ввода информации от пользователя и вам её надо либо её вызывать либо же прыгать на неё вопрос трудный "как лучьше с     длать?!" - выбрать и сделать это очень просто. Если вы вызываете метку то программа не перезапускается с этой метки а продалжает её работу и не удаляет результат работы         прошлой метки, а комманда jmp - перезапускает если можно так сказать программу и начинат её сразу с этой метки, но если вы хотите зациклить выполнение метки то всё же           вам придётся в вашей метке поставить комманду jmp. Синтаксис комманд одинаковый что у call что у jmp. Синтаксис такой: jmp <имя метки> call <имя метки>
    пример этих комманд:
    format mz
    start:
         mov ax, bx
    call start
    jmp start
        </h3>
    </h3>
