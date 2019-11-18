# pr0gramm-loganalyzer
:scroll: CLI Tool zum Auswerten der verschiedenen Votes aus dem Sync-Log.

## Abhängigkeiten
Damit das Script funktioniert muss der [pr0gramm-apiCall](https://github.com/RundesBalli/pr0gramm-apiCall) eingebunden werden.  
Der apiCall muss in [Zeile 22](https://github.com/RundesBalli/pr0gramm-loganalyzer/blob/master/loganalyzer.php#L22) eingebunden werden.

## Verwendung
Man startet das Script in der CLI mit:  
`php loganalyzer.php`

## Log-ActionIDs
Das Log gibt verschiedene ActionIDs zurück, worauf hier näher eingegangen wird.
1. Man hat einen Post hochgevotet.
2. Man hat einen Vote entfernt und den Post neutral belassen.
3. Man hat einen Post runtergevotet.
4. Man hat einen Kommentar hochgevotet.
5. Man hat einen Vote entfernt und den Kommentar neutral belassen.
6. Man hat einen Kommentar runtergevotet.
7. Man hat einen Tag hochgevotet.
8. Man hat einen Vote entfernt und den Tag neutral belassen.
9. Man hat einen Tag runtergevotet.
10. Man hat einen Post favorisiert.
11. Man hat einen Kommentar favorisiert.
12. Man folgt jemandem (Stelz).
13. Man entfolgt jemandem.
14. Man aktiviert Benachrichtigungen (Glocke).
15. Man entfernt die Benachrichtigungen, behält aber den Stelz.
Wichtig ist hierbei, dass es sich nicht um die absolute Anzahl an Votes geht, sondern nur um die Anzahl der Handlungen.  
Wenn man ein und den selben Post je 30x hoch und runter votet, dann hat man bei 1 und 3 jeweils 30 mehr.

## Danke
Danke an @Mopsalarm für seine Hilfe beim unpacken der Daten und für seine Übersicht der ActionIDs:
[Quelle](https://github.com/mopsalarm/Pr0/blob/62b3e13a5961424ae32e918a10736eba5710d7fa/app/src/main/java/com/pr0gramm/app/services/VoteService.kt#L241-L258)
