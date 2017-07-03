@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=C:\PHP7;%PATH%
c:\bin\RunHiddenConsole.exe C:\PHP7\php-cgi.exe -b 127.0.0.1:9000