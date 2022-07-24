@echo off

START "" "D:\golang\redis\redis\64bit\redis-server.exe"

START "" "D:\golang\elasticsearch\elasticsearch-7.12.1\bin\elasticsearch.bat"

D:
cd D:\nexconsent\src\nexsoft.co.id\auth
oauth2.exe