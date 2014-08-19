LBS
==========

> This library is part of [Project Golem](http://golem.yoozi.cn/), see [yoozi/golem](https://github.com/yoozi/golem) for more info.

本 LBS 库是[百度地图 LBS WEB API](http://developer.baidu.com/map/webservice.htm) 的简单 PHP 封装。目前支持如下几个 API：

* [Place API](http://developer.baidu.com/map/wiki/index.php?title=webapi/guide/webservice-placeapi)
* [Place Suggestion API](http://developer.baidu.com/map/wiki/index.php?title=webapi/place-suggestion-api)
* [Geocoding API](http://developer.baidu.com/map/wiki/index.php?title=webapi/guide/webservice-geocoding)
* [IP 定位 API](http://developer.baidu.com/map/wiki/index.php?title=webapi/ip-api)

## Installation

The best and easy way to install the Golem package is with [Composer](https://getcomposer.org).

1. Open your composer.json and add the following to the require array:

    ```
    "yoozi/lbs": "1.0.*"
    ```

2. Run Composer to install or update the new package dependencies.

    ```
    php composer install
    ```

    or

    ```
    php composer update
    ```

## Usage Example

以下使用 Place Suggestion API 查询关键词为 ``广州市`` ``尚德大厦`` 地标信息：

```php
<?php

use Yoozi\LBS\Query\Place;
use Yoozi\LBS\Search;

$place = new Place;
$place->set('method', 'suggestion');
$place->set('q', '尚德大厦');
$place->set('region', '广州市');

$search = new Search('E4805d16520de693a3fe707cdc962045', $place);

var_dump($search->run()->toArray());
```

Data returned:

```php
array(3) {
  ["status"]=>
  int(0)
  ["message"]=>
  string(2) "ok"
  ["result"]=>
  array(4) {
    [0]=>
    array(5) {
      ["name"]=>
      string(12) "尚德大厦"
      ["city"]=>
      string(9) "广州市"
      ["district"]=>
      string(9) "天河区"
      ["business"]=>
      string(0) ""
      ["cityid"]=>
      string(3) "257"
    }
    [1]=>
    array(5) {
      ["name"]=>
      string(16) "尚德大厦a座"
      ["city"]=>
      string(0) ""
      ["district"]=>
      string(0) ""
      ["business"]=>
      string(0) ""
      ["cityid"]=>
      string(1) "0"
    }
    [2]=>
    array(5) {
      ["name"]=>
      string(22) "尚德大厦-停车场"
      ["city"]=>
      string(9) "广州市"
      ["district"]=>
      string(9) "天河区"
      ["business"]=>
      string(0) ""
      ["cityid"]=>
      string(3) "257"
    }
    [3]=>
    array(5) {
      ["name"]=>
      string(18) "西安尚德大厦"
      ["city"]=>
      string(9) "西安市"
      ["district"]=>
      string(9) "新城区"
      ["business"]=>
      string(0) ""
      ["cityid"]=>
      string(3) "233"
    }
  }
}
```