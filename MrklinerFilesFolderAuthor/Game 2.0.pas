uses Crt;
var
	s: string;
	money: longint;
	f: integer;
        work: longint;
        mat: longint;
        lev: longint;
        worki: longint;
        bworki: longint;
        tmpa: longint;
        bmat: longint;
label cm;
begin
	f := 0;
	money := 10000;
        lev := 1;
        mat := 10;
        work:= 30;
        worki:= 10;
	while (f = 0) do
        begin
		textcolor (10);
		writeln ('          *       *  ****  ****      **        ****  ****  ****');
		writeln ('          *     * *  *     *  *     *  *       *  *  *  *  *  *');
		writeln ('          *   *   *  *     ****    ******      *  *  ****  *  *');
		writeln ('          * *     *  *     *      *      *     *  *  *     *  *');
		writeln ('          *       *  *     *     *        *    *  *  *     ****');
		writeln ('');
		writeln ('          *****  *     *  ****  *  * ****  ****   ****       ****');
		writeln ('          *      *   * *     *  *  * *     *     *  *        *  *');
		writeln ('          *****  *  *  *  ****  **** ****  *       *         *  *');
		writeln ('          *   *  * *   *     *  *  * *     *      *      **  *  *');
		writeln ('          *****  *     *  ****  *  * ****  ****   *****  **  ****');
		writeln ('');
		writeln ('1 - ����� ����');
		writeln ('2 - ��室');
		readln(s);
		if (s = '1') then
		begin
			clrscr;
			while (f = 0) do
			begin
				textcolor (11);
				writeln ('��� 䨭����: ', money, ' �㡫��');
				writeln ('��� ����� (���ਠ� �ந�����⢠): ', mat, ' ����');
                                writeln ('��� ࠡ��� ᨫ� (ࠡ�稥): ', work, ' 祫.');
                                writeln ('������⢮ ��襣� ����㤮�����: ', worki);
                                writeln ('��襬� �������: ', lev, ' ���');
                                writeln ('������ �室��� � �������?');
                                write ('<y/n>');
                                readln (s);
                                if (s = 'y') then
                                begin
                                   writeln ('1 - ����㤮�����');
                                   writeln ('2 - �����');
                                   write ('��ਠ��: ');
                                   readln (s);
                                   if (s = '1') then
                                   begin
                                      writeln ('���� �� ����㤮����� ��⠢��� 1000 �㡫�� �� ���� ����. �� 㢥७�� �� ��� �㯨�� ����㤮�����?');
                                      write ('<y/n>');
                                      readln (s);
                                      if (s = 'y') then
                                      begin
                                         writeln ('������ ������⢮ ��� ����㤮����� ���஥ ��� �㯨��.');
                                         write ('���-��: ');
                                         readln (bworki);
                                         if (money <> 0) then
                                         begin
                                            tmpa := bworki * 1000;
                                            money := money - tmpa;
                                            worki := worki + bworki;
                                            writeln ('�� �㯨�� ', bworki, ' ��� ����㤮����� �� ', tmpa, ' �㡫��');
                                            tmpa := 0;
                                         end
                                         else
                                         begin
                                            writeln ('� ��� �� �����筮 �����!');
                                         end
                                      end;
                                   end
                                   else if (s = '2') then
                                   begin
                                      writeln ('���� �� ����� ��⠢��� 100 �㡫�� �� ���� ����. �� 㢥७�� �� ��� �㯨�� c����?');
                                      write ('<y/n>');
                                      readln (s);
                                      if (s = 'y') then
                                      begin
                                         writeln ('������ ������⢮ ⮭� ����� ���஥ ��� �㯨��.');
                                         write ('���-��: ');
                                         readln (bmat);
                                         if (money <> 0) then
                                         begin
                                            tmpa := bmat * 100;
                                            money := money - tmpa;
                                            mat := mat + bmat;
                                            writeln ('�� �㯨�� ', bmat, ' ⮭� ����� �� ', tmpa, ' �㡫��');
                                            tmpa := 0;
                                         end
                                         else
                                         begin
                                            writeln ('� ��� �� �����筮 �����!');
                                         end
                                   end;
                                end
			end;
                end;
                clrscr;
                writeln ('��� 䨭����: ', money, ' �㡫��');
		writeln ('��� ����� (���ਠ� �ந�����⢠): ', mat, ' ����');
                writeln ('��� ࠡ��� ᨫ� (ࠡ�稥): ', work, ' 祫.');
                writeln ('������⢮ ��襣� ����㤮�����: ', worki);
                writeln ('��襬� �������: ', lev, ' ���');
                writeln ('
	end;
        end;
end.
