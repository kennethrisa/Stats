@ECHO OFF
REM Stop Nginx
tasklist /FI "IMAGENAME eq nginx.exe" 2>NUL | find /I /N "nginx.exe">NUL
IF "%ERRORLEVEL%"=="0" (
   REM Nginx is currently running, so quit it
   c:
   cd \nginx
   nginx.exe -s quit
   ECHO Nginx quit issued.
) else (
   ECHO Nginx is not currently running.
)