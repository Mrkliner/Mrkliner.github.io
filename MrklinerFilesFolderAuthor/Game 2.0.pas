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
		writeln ('1 - Начать игру');
		writeln ('2 - Выход');
		readln(s);
		if (s = '1') then
		begin
			clrscr;
			while (f = 0) do
			begin
				textcolor (11);
				writeln ('Ваши финансы: ', money, ' рублей');
				writeln ('Ваше сырьё (материал производства): ', mat, ' Тонн');
                                writeln ('Ваша рабочая сила (рабочие): ', work, ' чел.');
                                writeln ('Количество вашего оборудования: ', worki);
                                writeln ('Вашему бизнесу: ', lev, ' лет');
                                writeln ('Желаете сходить в магазин?');
                                write ('<y/n>');
                                readln (s);
                                if (s = 'y') then
                                begin
                                   writeln ('1 - оборудование');
                                   writeln ('2 - сырьё');
                                   write ('Вариант: ');
                                   readln (s);
                                   if (s = '1') then
                                   begin
                                      writeln ('Цена на оборудование составляет 1000 рублей за одну штуку. Вы уверенны что хотите купить оборудование?');
                                      write ('<y/n>');
                                      readln (s);
                                      if (s = 'y') then
                                      begin
                                         writeln ('Введите количество штук оборудования которое хотите купить.');
                                         write ('Кол-во: ');
                                         readln (bworki);
                                         if (money <> 0) then
                                         begin
                                            tmpa := bworki * 1000;
                                            money := money - tmpa;
                                            worki := worki + bworki;
                                            writeln ('Вы купили ', bworki, ' штук оборудования за ', tmpa, ' рублей');
                                            tmpa := 0;
                                         end
                                         else
                                         begin
                                            writeln ('У вас не достаточно денег!');
                                         end
                                      end;
                                   end
                                   else if (s = '2') then
                                   begin
                                      writeln ('Цена на сырьё составляет 100 рублей за одну штуку. Вы уверенны что хотите купить cырьё?');
                                      write ('<y/n>');
                                      readln (s);
                                      if (s = 'y') then
                                      begin
                                         writeln ('Введите количество тонн сырья которое хотите купить.');
                                         write ('Кол-во: ');
                                         readln (bmat);
                                         if (money <> 0) then
                                         begin
                                            tmpa := bmat * 100;
                                            money := money - tmpa;
                                            mat := mat + bmat;
                                            writeln ('Вы купили ', bmat, ' тонн сырья за ', tmpa, ' рублей');
                                            tmpa := 0;
                                         end
                                         else
                                         begin
                                            writeln ('У вас не достаточно денег!');
                                         end
                                   end;
                                end
			end;
                end;
                clrscr;
                writeln ('Ваши финансы: ', money, ' рублей');
		writeln ('Ваше сырьё (материал производства): ', mat, ' Тонн');
                writeln ('Ваша рабочая сила (рабочие): ', work, ' чел.');
                writeln ('Количество вашего оборудования: ', worki);
                writeln ('Вашему бизнесу: ', lev, ' лет');
                writeln ('
	end;
        end;
end.
