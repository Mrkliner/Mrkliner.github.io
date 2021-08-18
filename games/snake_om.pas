uses crt;
var
    x,y,vx,vy: integer;
    ch: char;
    doubx: integer;
    textx, texty: integer;
    score, scX, scY: longint;
begin
    clrscr;
    doubx := 1;
    x := 1;
    y := 25 div 2;
    textx := 2 div 2;
    texty := 1;
    scX := 15;
    scY := 15;
    gotoxy (scX, scY);
    write ('*');
    gotoxy (1,1);
    writeln('###############################################################################');
    gotoxy (doubx,24);
    writeln('###############################################################################');
    while (x>=1) and (x<=80) and (y>=-1) and (y<=23) do begin
        gotoxy (textx, texty);
        write ('Score:', score, ' ');
        gotoxy(x,y);
        write('@');
        delay(60);
        if (x = 15) and (y = 15) then begin
           score := score + 1;
        end;
        if keypressed then begin
            ch := readkey;
            case ch of
                'd':begin vx:=1; vy:=0 end;
                'a':begin vx:=-1; vy:=0 end;
                'w':begin vx:=0; vy:=-1 end;
                's':begin vx:=0; vy:=1 end;
            end;
        end;
        gotoxy(x,y);
        write(' ');
        inc(x,vx);
        inc(y,vy);

    end;
end.