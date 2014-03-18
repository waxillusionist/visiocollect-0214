Visiocollect 02/14 Wordpress Theme
==================================

## Einrichtung der Entwicklungsumgebung

Stelle sicher, dass [Node](http://nodejs.org/), [Grunt](http://gruntjs.com/) und [Bower](http://bower.io/) auf deinem System installiert sind.

Erstelle einen [lokalen Klon](github-mac://openRepo/https://github.com/simbo/visiocollect-0214) des Repositories oder lade die [ZIP-Datei](https://github.com/simbo/visiocollect-0214/archive/master.zip) herunter und entpacke sie.

Gib im Stammverzeichnis des Projekts folgende Befehle ein, um alle Abhängigkeiten herunterzuladen:

```bash
npm install
bower install
```

Anschließend kann mit dem Befehl `grunt` die Entwicklung gestartet werden. Als Editor empfehle ich [Sublime](http://www.sublimetext.com/).

Der Watch Task überwacht nun sämtliche Projektdateien und löst gegebenenfalls die Preprocessor Tasks und/oder einen Reload des Browsers aus. (CTRL-C beendet den Task)

Für den Livereload Funktion wird ein entsprechner Browser Plugin benötigt. (z.b. [Livereload für Chrome](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei))

Bevor das Projekt hochgeladen bzw. mit der Online Version synchronisiert wird, sollte der Task `grunt build` ausgeführt werden um *aufzuräumen*.

## Shortcodes

...kommt noch...
