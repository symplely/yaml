[![Build Status](https://travis-ci.org/symplely/yaml.svg?branch=master)](https://travis-ci.org/symplely/yaml)[![Codacy Badge](https://api.codacy.com/project/badge/Grade/cf23167ee99d4fe8a56f5886226de70d)](https://app.codacy.com/app/symplely/yaml?utm_source=github.com&utm_medium=referral&utm_content=symplely/yaml&utm_campaign=Badge_Grade_Dashboard)
[![codecov](https://codecov.io/gh/symplely/yaml/branch/master/graph/badge.svg)](https://codecov.io/gh/symplely/yaml)[![Maintainability](https://api.codeclimate.com/v1/badges/414f3b593f321f4f255f/maintainability)](https://codeclimate.com/github/symplely/yaml/maintainability)

This is a YAML loader/dumper written in pure PHP.

- Given a YAML document, will return an array that you can use however you see fit.

- Given an array, will return a string which contains a YAML document built from your data.

**YAML** is an amazingly human friendly and strikingly versatile data serialization language which can be used 
for log files, config files, custom protocols, the works. For more information, see http://www.yaml.org.

Supporting YAML 1.1 specification.

## Installation

    composer require symplely/yaml

## Usage

Using Yaml is trivial:

```php
require 'vendor/autoload.php';

$Data = Yaml::loader('config.yaml');
```

or (if you prefer functional syntax)

```php
require 'vendor/autoload.php';

$Data = yaml_load_file('config.yaml');
```
