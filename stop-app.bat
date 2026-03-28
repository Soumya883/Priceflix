@echo off
setlocal

for /f "tokens=2" %%P in ('tasklist ^| findstr /i "php.exe"') do taskkill /PID %%P /F >nul 2>nul
for /f "tokens=2" %%P in ('tasklist ^| findstr /i "node.exe"') do taskkill /PID %%P /F >nul 2>nul

echo Stopped php/node processes used by dev servers.
exit /b 0
