<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Unas Api Extension</h1>
    <br>
</p>




Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```
composer require --prefer-dist vadgab/yii2-unas-api
```

Basic Usage
-----------

General use can be tried through the following examples:

- Get Orders

```php

    use vadgab\Yii2UnasApi\UnasApi;
    use vadgab\Yii2UnasApi\UnasOrders\UnasOrdersSchema;

    $apicall = new UnasApi('*apikey*');
    $schema = new UnasOrdersSchema($apicall);
    $schema->DateStart = '2022-10-01';
    $schema->DateEnd = '2022-11-30';
    $schema->Status = 0;
    $schemaXml = $schema->createGetOrdersSchema();
    $result = $apicall->getOrders($schemaXml);
    var_dump($result);

	// Full avaiable variables: https://unas.hu/tudastar/api/megrendelesek-getOrder-keres 	

```

- Set Orders

```php

    use vadgab\Yii2UnasApi\UnasApi;
    use vadgab\Yii2UnasApi\UnasOrders\UnasOrdersSchema;

    $apicall = new UnasApi('*apikey*');
    $schema = new UnasOrdersSchema($apicall);
    $schema->setOrderParams['Key']  = '32117-869609';
    $schema->setOrderParams['Status'] = 0;
    //multi dimesional parameters example
    $schema->setOrderParams['Customer']['Contact']['Name'] = 'John Doe';
    $schemaXml = $schema->createSetOrdersSchema();
    $result = $apicall->setOrders($schemaXml);
    var_dump($result);

	// Full avaiable variables: https://unas.hu/tudastar/api/megrendelesek-adatszerkezet

```

