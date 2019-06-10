# Yaml

[![Build Status](https://travis-ci.org/symplely/yaml.svg?branch=master)](https://travis-ci.org/symplely/yaml)[![codecov](https://codecov.io/gh/symplely/yaml/branch/master/graph/badge.svg)](https://codecov.io/gh/symplely/yaml)[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8713c8ff9c8b40d3ba93cc913a66118c)](https://www.codacy.com/app/techno-express/yaml?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=symplely/yaml&amp;utm_campaign=Badge_Grade)

An pure PHP implementation base YAML loader/dumper.

- Given a YAML document, will return an array that you can use however you see fit.

- Given an array, will return a string which contains a YAML document built from your data.

**YAML** is an amazingly human friendly and strikingly versatile data serialization language which can be used 
for log files, config files, custom protocols, the works. For more information, see http://www.yaml.org.

Supporting YAML 1.1 specification.

## Installation

```cmd
composer require symplely/yaml
```

## Usage

Using Yaml is trivial:

The `parse()` or `loader()` method parses a YAML string and converts it to a PHP array:

```php
require 'vendor/autoload.php';

use Async\Yaml;

 // Reading YAML Contents
$Data = Yaml::loader('config.yaml');
// Or
$Data = Yaml::parse("foo: bar");
// Or
$Data = yaml_load("foo: bar");
// $Data = ['foo' => 'bar']
```

or (if you prefer functional syntax)

```php
require 'vendor/autoload.php';

$Data = yaml_load_file('config.yaml');
```

The `dumper()` method dumps any PHP array to its YAML representation:

```php
require 'vendor/autoload.php';

use Async\Yaml;

$array = [
    'foo' => 'bar',
    'bar' => ['foo' => 'bar','bar' => 'baz'],
];

$yaml = Yaml::dumper($array);
// Or
$yaml = yaml_dump($array);

// Writing YAML Files
file_put_contents('/path/to/file.yaml', $yaml);
```
