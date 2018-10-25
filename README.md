# Yawik Standard Application

[![Build Status](https://travis-ci.org/yawik/standard.svg?branch=master)](https://travis-ci.org/yawik/standard)

## Introduction

This is a skeleton application for Yawik.

## Installation using Composer

The easiest way to create a new Yawik installation is to use
[Composer](https://getcomposer.org/).  If you don't have it already installed,
then please install as per the [documentation](https://getcomposer.org/doc/00-intro.md).

To create your new Yawik application:

```bash
$ composer create-project -sdev yawik/standard path/to/install
```

Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ cd path/to/install
$ composer run --timeout 0 serve
```

This will start the cli-server on port 8080, and bind it to all network
interfaces. You can then visit the site at http://localhost:8080/

**Note:** The built-in CLI server is *for development only*.


## Using docker-compose

This skeleton provides a `docker-compose.yml` for use with
[docker-compose](https://docs.docker.com/compose/); it
uses the `Dockerfile` provided as its base. Build and start the image using:

```bash
$ docker-compose up --build
```

At this point, you can visit http://localhost:8080 to see the site running.