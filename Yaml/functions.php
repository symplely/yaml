<?php

use Async\Yaml;

if(!function_exists('yaml_load')) {
  /**
   * Parses YAML to array.
   * @param string $string YAML string.
   * @return array
   */
  function yaml_load($string) {
    return Yaml::loadString($string);
  }
}

if(!function_exists('yaml_load_file')) {
  /**
   * Parses YAML to array.
   * @param string $file Path to YAML file.
   * @return array
   */
  function yaml_load_file($file) {
    return Yaml::loader($file);
  }
}

if(!function_exists('yaml_dump')) {
  /**
   * Dumps array to YAML.
   * @param array $data Array.
   * @return string
   */
  function yaml_dump($data) {
    return Yaml::dumper($data, false, false, true);
  }
}
