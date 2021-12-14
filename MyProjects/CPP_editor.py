import os.path
import os
from kivy.app import App
from kivy.uix.button import Button
from kivy.uix.widget import Widget
from kivy.core.window import Window
from kivy.uix.codeinput import CodeInput
from kivy.uix.boxlayout import BoxLayout
from pygments.lexers import CppLexer
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from sys import getdefaultencoding
text = CodeInput(lexer = CppLexer(), font_size=18, text = "#include <iostream>\n#include <string>\n\nusing namespace std;\n\nint main() {\n\t//Здесь ваш код...\n}")
class CPP_editorApp(App):
	def build(self):
		Window.clearcolor = (255,255,255,255)
		bl = BoxLayout(orientation='vertical')
		bl.add_widget(Button(text='Сохранить cpp файл', on_press = self.btn_press, size_hint= (None, None), size = (200, 30)))
		bl.add_widget(Button(text='Открыть cpp файл', on_press = self.btn_press_open, size_hint= (None, None), size = (200, 30)))
		bl.add_widget(Button(text='Компилировать cpp файл', on_press = self.compileFile, size_hint= (None, None), size = (200, 30)))
		bl.add_widget(text);

		return bl

		return Button(text = "Кликни!", 
			font_size = 30,
			on_press = self.btn_press,
			background_color = [1, 2, 0, 1])
	def btn_press(self, instance):
		a = open ('main.cpp', 'w');
		global text
		#getdefaultencoding()
		encodedText = text.text#.encode('866')
		a.write(str(encodedText));
		a.close()
		popup = Popup(title='main.cpp',
		    content=Label(text='Файл успешно сохранён!\nКликните на пустое место чтобы закрыть это окно'),
		    size_hint=(None, None), size=(400, 400))
		popup.open() 
	def btn_press_open(self, instance):
		if (os.path.isfile('main.cpp') == False):
			c = open('main.cpp', 'w');
			c.write('Windows.FileCreate.Error');
		a = open ('main.cpp', 'r');
		global text
		text.text = a.read()
		a.close()
		popup = Popup(title='main.cpp',
			content=Label(text='Файл успешно открыт!\nКликните на пустое место чтобы закрыть это окно'),
			size_hint=(None, None), size=(400, 400))
		popup.open() 
	def compileFile():
		os.system('g++.exe main.cpp');
		Pauser.run()
if __name__ == "__main__":
	CPP_editorApp().run()
