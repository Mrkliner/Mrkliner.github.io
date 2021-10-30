' InputBoxes
Contact = InputBox("Com qual contato voce quer fazer DDos?" & vbNewLine & vbNewLine &  "Nao use acentuacao no nome do contato!", "WhatsApp DDos")
Message = InputBox("Qual e a mensagem a ser enviada?","WhatsApp DDos")
T = InputBox("Quantas vezes a mensagem precisa ser enviada?" & vbNewLine & vbNewLine & "Informe um numero inteiro!","WhatsApp DDos")
If MsgBox("Deseja continuar?" & vbNewLine & vbNewLine & "Aperte NAO para cancelar!", vbYesNo + vbQuestion + vbSystemModal, "WhatsApp DDos") = vbYes Then
 
    ' Abre o WhatsApp
    Set WshShell = WScript.CreateObject("WScript.Shell")
    Return = WshShell.Run("https://web.whatsapp.com/", 1)
 
    ' Loading Time
 
    If MsgBox("O WhatsApp Web esta aberto?" & vbNewLine & vbNewLine & "Espere a pagina carregar!" & vbNewLine & vbNewLine & "Aperte NAO para cancelar!", vbYesNo + vbQuestion + vbSystemModal, "WhatsApp DDos") = vbYes Then
 
    ' Editado por Limontec.com para evitar bloqueio do WhatsApp
    MsgBox "Nao toque no navegador durante o ataque!" & vbNewLine & vbNewLine & "Tempo para iniciar ataque 10 segundos.", 1024 + vbSystemModal, "Preparando DDos"
 
    ' Abre o WhatsApp Search Bar
    WScript.Sleep 50
    WshShell.SendKeys "{TAB}"
 
    ' Busca pelo contato
    WScript.Sleep 50
    WshShell.SendKeys Contact
    WScript.Sleep 5000
    WshShell.SendKeys "{ENTER}"
    WScript.Sleep 5000
 
    ' Loop das mensagens
    For i = 0 to T
    WScript.Sleep 5
    WshShell.SendKeys Message
    WScript.Sleep 5
    WshShell.SendKeys "{ENTER}"
    Next
 
    ' Fim do Script
    WScript.Sleep 3000
    MsgBox "DDosing no " + Contact + " foi feito com sucesso, visite Limontec.com", 1024 + vbSystemModal, "DDos feito"
 
    ' Mensagem de Script cancelado
    Else
    MsgBox "O processo foi cancelado com sucesso", vbSystemModal, "DDos Cancelado"
    End If
Else
MsgBox "O processo foi cancelado com sucesso", vbSystemModal, "DDos Cancelado"
End If
 
' Abre o Limontec.com
Set WshShell = WScript.CreateObject("WScript.Shell")
Return = WshShell.Run("https://www.limontec.com/2015/12/curso-hacker-wi-fi-limon-tec.html", 1)