# Hatch a remix of FoundationPress

The project is a grunt-init scaffold *YOU MUST HAVE GRUNT-INIT installed*

In order for this to work properly you will need to clone this repo into your local ```.grunt-init``` folder (typically within your user ```~``` folder if you're on a mac)

*This is a WordPress starter theme based on*
 * FoundationPress
 * which in turn is based on [Foundation 5](http://foundation.zurb.com) by Zurb.
 * Some snippets from [_s](https://github.com/automattic/_s) (underscore) from [Automattic](http://automattic.com)
 * And a bunch of our own cooking.

The purpose of our version of this project is to act as a small and handy toolbox that contains the essentials needed to a responsive theme based on Foundation 5.x. This theme is meant to be a starting point not a parent theme.

*The biggest difference between this Fork and FoundationPress*
  * Coding methodologies
  * Internal development process.
  * Grunt Scaffold (Please read up on this before starting)
  * Some theme options (Kind of a mishmash of our stuff and the _s theme)
  * Additional mixins that we utilize daily.
  * We've updated the Gruntfile.js to watch different files.
  * Lastly the original FoundationPress project is dequeueing libraries that are available with WordPress core. Based on this we decided to do our own fork.

*Please fork, copy, modify, delete, share or do whatever you like with this.*

All contributions are welcome!

## Requirements

*You'll need to have the following items installed before continuing.*
  * [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
  * [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`
  * [Bower](http://bower.io): Run `[sudo] npm install -g bower`
  * [grunt-init](http://gruntjs.com/project-scaffolding): Run `[sudo] npm install -g grunt-init`
  
## Quickstart / Installation

Once grunt-init is installed, place this template (either manually or cloned from github) into your `~/.grunt-init/` directory. It's recommended that you use git to clone this template into that directory, as follows:

### Linux/Mac Users

```
git clone https://github.com/linchpinagency/hatch.git ~/.grunt-init/hatch
```
This will create a folder named 'hatch' within your .grunt-init the name of the folder is utilized later on when using the project scaffold.

### Windows Users

```
git clone https://github.com/linchpinagency/hatch.git %USERPROFILE%/.grunt-init/hatch
```

## Usage

At the command-line, ```cd``` into an empty directory, run the following command and follow the prompts.

```
grunt-init hatch
```

## Once grunt init completes ##

While you're working on your project you might need to run:

`npm install && bower install`

Lastly just run the grunt command

`grunt` You might need to install other dependencies as well. Install them as needed by using `npm install yadda yadda`

You can also check for Foundation updates. Run: ```foundation update``` (this requires the foundation gem to be installed in order to work. Please see the [docs](http://foundation.zurb.com/docs/sass.html) for details.)

**If you're having issues with Grunt after an update, run the following commands in terminal**
```python
sudo npm cache clean -f
sudo npm install -g n
sudo n stable

bower update
```

## Stylesheet Folder Structure

  * `style.css`: (Used for theme description/details) All styling are handled in the Sass files described below
  * `scss/app.scss`: Sass imports for global config, foundation and site structure
  * `scss/config/_variables.scss`: Your custom variables
  * `scss/config/_colors.scss`: Your custom color scheme
  * `scss/config/_settings.scss`: Original Foundation 5 base settings
  * `scss/site/_structure`: Your custom site structure
  * `css/[theme-name].css`: All Sass files are minified and compiled to this file

## Script Folder Strucutre

  * `bower_components/`: This is the source folder where all Foundation scripts are located. `foundation update` will check and update scripts in this folder
  * `js/`: jQuery, Modernizr and Foundation scripts are copied from `bower_components/` to this directory, where they are minified and concatinated and enqueued in WordPress
  * Please note that you must run `grunt` in your terminal for the scripts to be copied. See [Gruntfile.js](https://github.com/linchpinagency/FoundationPress/blob/master/Gruntfile.js) for details

## You may also find the following plugin(s) useful
* [Linchpin Useful Plugins](http://github.com/linchpinagency/shortcodes/)

## How to get started with Foundation

* [Zurb Foundation Docs](http://foundation.zurb.com/docs/)

## Learn how to use WordPress

* [WordPress Codex](http://codex.wordpress.org/)

## Demo

* [Clean Hatch install](http://hatch.linchpin.agency)
* [Hatch Kitchen Sink - see every single element in action](http://hatch.linchpin.agency/kitchen-sink/)