@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../scrutinizer/ocular/bin/ocular
php "%BIN_TARGET%" %*
