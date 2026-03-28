@echo off
setlocal

set "PHP_EXE=%LOCALAPPDATA%\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"

if not exist "%PHP_EXE%" (
  echo [ERROR] PHP not found at:
  echo %PHP_EXE%
  echo Install PHP first, then run this script again.
  pause
  exit /b 1
)

echo Starting Laravel server on http://localhost:8000 ...
start "Laravel Server" cmd /k ""%PHP_EXE%" artisan serve --host=127.0.0.1 --port=8000"

echo Starting Vite dev server on http://localhost:5173 ...
start "Vite Server" cmd /k "npm.cmd run dev"

echo.
echo App startup launched.
echo Open: http://localhost:8000
echo.
exit /b 0
