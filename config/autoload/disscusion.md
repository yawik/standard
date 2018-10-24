How will the new project structure work, if installing a fresh YAWIK instance?
----

Fresh yawik installation can be done with composer create-project command:
```sh
composer create-project yawik/standard
```
Please take a look at this repository:

https://github.com/yawik/standard

And try fresh yawik installation:
```sh
$ composer create-project yawik/standard path/to/fresh

# install additional module
$ composer install yawik/orders ^0.32@dev

# testing fresh yawik
$ cd path/to/fresh
$ php -S localhost:8000 -t public/

# or if you prefer docker-compose
$ docker-compose up --build
```

How can an existing YAWIK instance be updated to the new structure?
----
1. Backup existing files.
2. Create a new fresh yawik installation by using composer create-project command
3. Restore ```old/config/autoload``` into ```new/config/autoload```;
4. Restore ```old/module/custom-theme-or-module``` into ```new/module/custom-theme-or-module``` and have them activated.
5. Restore old assets files like css, images, etc. into public/* directories 

I am not sure about backup a database, but I think we don't need db backup
for upgrading from 0.31 to 0.32.

Must we stop active developing on the current YAWIK repository until the code is separated in the new structures?
----
We should continue developing on current YAWIK repository,
and we will always develop required Yawik module in this current repository
(Applications, Auth, Core, Organizations, etc.)

We should stop additional module development (Orders, SimpleImport, etc. ) or installation
with ```git clone``` command.  This module should be develop in separate directories:
```sh
$ git clone git@github.com:yawik/Orders.git /path/to/orders

# install yawik/core and all requirements with composer
$ composer install

# now we can have yawik running during module development
# with their own customized configuration ;-)
$ cd /path/to/orders
$ php -S localhost:8000 -t test/sandbox/public
```

How will the code be separated in dedicated repositories?
----
I have created a new command to git subsplit current yawik development repository
into yawik/core, yawik/applications, yawik/auth:
```sh
$ bin/yawik dev:subsplit
```

How will the new project structure work, if installing a fresh YAWIK instance?
----

Fresh yawik installation can be done with composer create-project command:
```sh
composer create-project yawik/standard
```
Please take a look atI have create this skeleton in:
https://github.com/yawik/standard

How can an existing YAWIK instance be updated to the new structure?
----
1. Backup their existing files, and database.
2. Create a new fresh yawik installation by using composer create-project command
3. Restore their customized modules/theme into new module/* directories, and have them activated
4. Restore all existing assets files like css, etc into public/* directories

Must we stop active developing on the current YAWIK repository until the code is separated in the new structures?
----
We can continue developing on current YAWIK repository,
and we will always develop required Yawik module in this current repository
(Applications, Auth, Core, Organizations, etc.)

In local development we can develop additonal modules like yawik/Orders, yawik/SimpleImport
in separate directories without git clone into main yawik repository:
```sh
$ git clone git@github.com:yawik/Orders.git /path/to/orders

# install yawik/core and all requirements with composer
$ composer install
```

What's changed/new? 
----
1. Project Directories
* ```log``` and ```cache``` dir moved into ```var/log```, ```var/cache```
* ```.travis``` dir moved into ```etc/travis```
* removed ```/path/to/yawik/test``` directory because we can use ```config/*```
  to put test config like ```config/autoload/config.test.php```
* configured modules directory to meet psr-4 requirements.
* moved module assets file from ```public/module-name``` into ```public/modules/module-name```
* ```/path/to/yawik/less``` moved into ```modules/Core/public/less``` so it can be used in module
  (Order, SimpleImport) or fresh yawik installation. 

2. Added/changed features
* added ```APPLICATION_ENV=test``` for phpunit tests in ```phpunit.xml.dist``` file,
  so yawik can load additional test configuration in ```config/autoload/*.test.php```
* integrated ```@symfony/webpack-encore``` in node requirements to minified js and css, and also move images,
  fonts into ```public/build/modules```. We can change this later with gulp/grunt.
* provided feature for versioned assets like ```yawik.a2134.css``` using zf3 asset view helper
  configured in ```public/build/manifest.json``` file (generated automatically).

3. New way to install or update modules.
```sh
# install additional module
$ cd /path/to/yawik-standard
$ composer require yawik/demo-skin
$ composer require yawik/orders
$ composer require yawik/simple-import

# updating modules should be easy now ;-)
$ composer update
```

4. New Console Command
I use ```symfony/console``` library for new command, because I have read that ```zendframework/console```
is [deprecated](https://docs.zendframework.com/zend-mvc-console/intro/#deprecated) and we need to 
find better solution.

There are 2 new command:
* ```bin/yawik assets:install``` for installing assets from ```module/public``` directory
  into ```public/modules/module-name``` directory (by using copy or relative symlink method).
* ```bin/yawik dev:subsplit``` to push commit from ```cross-solution/YAWIK``` into ```yawik/*```
