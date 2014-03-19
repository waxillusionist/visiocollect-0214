Visiocollect 02/14 WordPress Theme
==================================

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->

- [Einrichtung der Entwicklungsumgebung](#einrichtung-der-entwicklungsumgebung)
- [Bilder und Mediendateien](#bilder-und-mediendateien)
- [Shortcodes](#shortcodes)
    - [Grid](#grid)
        - [Grid Beispiel 1](#grid-beispiel-1)
        - [Grid Beispiel 2](#grid-beispiel-2)
        - [Grid Beispiel 3](#grid-beispiel-3)
        - [Grid Beispiel 4](#grid-beispiel-4)
    - [Clear](#clear)
    - [Galerien](#galerien)
    - [Background Container](#background-container)
    - [Parallax Container](#parallax-container)
    - [Google Maps](#google-maps)
    - [Zitate](#zitate)
    - [Hervorgehobene Absätze](#hervorgehobene-absätze)
    - [Buttons](#buttons)
    - [Icons](#icons)
    - [Heightfix](#heightfix)
    - [Spacer](#spacer)
    - [Spektrum](#spektrum)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

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

## Bilder und Mediendateien

Alle Bilder und Medien werden entsprechend ihrer Parent-Container und Platzierung eingepasst. Die Abmessungen der jeweiligen Container variieren abhängig von der Größe des Viewports.

Bilder sollten daher immer mit den größtmöglichen Abmessungen hochgeladen werden und die Skalierung derselben sollte dem Theme überlassen werden. Größenverhältnisse müssen natürlich trotzdem beachtet werden.

Innerhalb des Contents können die drei Standardgrößen der Bilder verwendet werden. Diesen sollten unter *Einstellungen / Medien* folgende Größen zugeordnet sein:

- `thumbnail` 380 x 380 (beschnitten)
- `medium` 640 x 0
- `large` 1280 x 0

Für die Verwendung im Theme werden noch weitere Größen generiert:

- `thumb_ratio` 380 x 0

Bildergalerien verwenden in der Standardeinstellung die Größe `thumb_ratio` für Vorschaubilder und `large` für die Lightbox.

## Shortcodes

### Grid

Die Shortcodes `[row]` und `[col]` erstellen Grid-Container gemäß dem [Bootstrap Gridsystem](http://holdirbootstrap.de/css/#grid).

Während `[row]` keine Parameter hat, kann bei `[col]` die Spaltenbreite für den jeweiligen Viewport `xs`, `sm`, `md` und `lg` eingestellt werden.
Außerdem besteht die Möglichkeit über die Parameter `*_offset`, `*_pull` und `*_push` die Platzierung auf dem jeweiligen Viewport anzupassen.

Da in Wordpress Shortcodes mit gleichem Namen nicht verschachtelt werden können, stehen alternative Namen `[row0]` bis `[row9]` und `[col0]` bis `[col9]` zur Verfügung (siehe Beispiel 4).

#### Grid Beispiel 1

2 Spalten auf Tablets und größer

```
[row]
    [col sm=6]
        Left Column Content
    [/col]
    [col sm=6]
        Right Column Content
    [/col]
[/row]
```

#### Grid Beispiel 2

3 Spalten auf Tablets und größer, wobei die Spalten 1 und 2 ihre Größe abhängig vom Viewport verändern

```
[row]
    [col sm=4 md=3 lg=2]
        Left Column Content
    [/col]
    [col sm=4 md=5 lg=6]
        Middle Column Content
    [/col]
    [col sm=4 md=4 lg=4]
        Right Column Content
    [/col]
[/row]
```

#### Grid Beispiel 3

2 Zeilen, Spalten mit Offset, die Spalten der unteren Zeile tauschen die Position

```
[row]
    [col sm=8 sm_offset=2]
        Centered Column Content
    [/col]
[/row]
[row]
    [col sm=2 sm_push=6 sm_offset=2]
        Right Column Content
    [/col]
    [col sm=4 sm_pull=2]
        Left Column Content
    [/col]
[/row]
```

#### Grid Beispiel 4

Verschachtelte Zeilen und Spalten

```
[row]
    [col sm=3]
        Left Side Column Content
    [/col]
    [col sm=9]
        Right Top Column Content
        [row2]
            [col2 sm=6]
                Left Bottom Column Content
            [/col2]
            [col2 sm=6]
                Right Bottom Column Content
            [/col2]
        [/row2]
    [/col]
[/row]
```

### Clear

### Galerien

### Background Container

### Parallax Container

### Google Maps

### Zitate

### Hervorgehobene Absätze

### Buttons

### Icons

### Heightfix

### Spacer

### Spektrum

