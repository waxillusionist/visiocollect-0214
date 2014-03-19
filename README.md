Visiocollect 02/14 WordPress Theme
==================================

## Einrichtung der Entwicklungsumgebung

Stelle sicher, dass [Node](http://nodejs.org/), [Grunt](http://gruntjs.com/) und [Bower](http://bower.io/) auf deinem System installiert sind.

Erstelle einen [lokalen Klon](github-mac://openRepo/https://github.com/simbo/visiocollect-0214) des Repositories oder lade die [ZIP-Datei](https://github.com/simbo/visiocollect-0214/archive/master.zip) herunter und entpacke sie.

Gib im Stammverzeichnis des Projekts folgende Befehle ein, um alle Abhängigkeiten herunterzuladen:

```bash
npm install
bower install
```

Anschließend kann mit dem Befehl `grunt` die Entwicklung gestartet werden.

Der Watch Task überwacht nun sämtliche Projektdateien und löst gegebenenfalls die Preprocessor Tasks und/oder einen Reload des Browsers aus. (CTRL-C beendet den Task)

Für die Livereload Funktion wird ein entsprechender Browser Plugin benötigt. (z.b. [Livereload für Chrome](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei))

Bevor das Projekt hochgeladen bzw. mit der Online Version synchronisiert wird, sollte der Task `grunt build` ausgeführt werden um *aufzuräumen*.

Als Editor empfehle ich [Sublime](http://www.sublimetext.com/) mit diversen Plugins
([Package Control](https://sublime.wbond.net/packages/Package%20Control),
[SideBarEnhancements](https://sublime.wbond.net/packages/SideBarEnhancements),
[EditorConfig](https://sublime.wbond.net/packages/EditorConfig),
[SFTP](https://sublime.wbond.net/packages/SFTP),
[Terminal](https://sublime.wbond.net/packages/Terminal),
[LESS](https://sublime.wbond.net/packages/LESS),
[Better Coffeescript](https://sublime.wbond.net/packages/Better%20CoffeeScript),
[WordPress](https://sublime.wbond.net/packages/WordPress), u.a.).

## Shortcodes

...kommt noch...
