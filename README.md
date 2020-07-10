# AirTable API client for Laravel

AirTable API client for Laravel. Used library [AirTable PHP)(https://github.com/lee-to/php-airtable)

## Installation

The AirTable Client Laravel can be installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer require lee-to/laravel-airtable
```

## Publish provider

```sh
php artisan vendor:publish --provider="AirTableLaravel\Providers\AirTableServiceProvider"
```

## .env:

```bash
AIRTABLE_TOKEN=
AIRTABLE_BASE=
AIRTABLE_TABLE=
```

## Usage

Get token and base from [AirTable Account](http://airtable.com/account) and [AirTable API](http://airtable.com/api)

### Import.
```php
use Airtable;
```

#### Get records from that table
- List table records

``` php
Airtable::table('table_name')->get();
```

Or use default table

``` php
Airtable::get();
```

Or get all records

``` php
Airtable::all();
```

#### Get one record from table.
``` php
Airtable::table('table_name')->find('ID');
```

Or use default table

``` php
Airtable::find('ID');
```

#### Filter records
- First argument is the column name
- Second argument is the operator or the value if you want to use equal '=' as an operator.
- Third argument is the value of the filter
``` php
Airtable::table('table_name')->where("column", "operator", "value")->get();
```

#### Sort records
- First argument is the column name
- Second argument is direction.

``` php
Airtable::table('table_name')->orderBy("column", "direction")->get();
```

#### Fields
- Only data for fields whose names are in this list will be included in the result. If you don't need every field, you can use this parameter to reduce the amount of data transferred

``` php
Airtable::table('table_name')->fields(["Column1", "Column2"])->get();
```

Or

``` php
Airtable::all(["Column1", "Column2"]);
```

#### Max records 
- The maximum total number of records that will be returned in your requests. If this value is larger than pageSize (which is 100 by default), you may have to load multiple pages to reach this total.

``` php
Airtable::table('table_name')->limit(5)->get();
```

#### Update 
- Update one record

``` php
Airtable::table('table_name')->update('ID', ["Column1" => "Value"]);
```

OR 

``` php
foreach(Airtable::get() as $record) {
    $record->update(["Column1" => "Value"]);
}
```

#### Update or create
- Update or create record

``` php
Airtable::table('table_name')->updateOrCreate('ID', ["Column1" => "Value"]);
```

#### Create
- Create a new record

``` php
Airtable::table('table_name')->create(["Column1" => "Value"]);
```

#### First or create
- Create a new record or find first match

``` php
Airtable::table('table_name')->firstOrCreate(["Column1" => "Value"]);
```

#### Delete
- Delete one record

``` php
Airtable::table('table_name')->delete('ID');
```

OR 

``` php
foreach(Airtable::table('table_name')->get() as $record) {
    $deleted = $record->delete();
    
    $deleted->isDeleted(); // Check is deleted or not
}
```

#### Get fields of record

``` php
foreach(Airtable::table('table_name')->get() as $record) {
    $record->getId(); // ID 
    
    $record->COLUMN1; // Any fields in table 
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Danil Shutsky](https://github.com/lee-to)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security

If you have found a security issue, please contact the maintainers directly at [leetodev@ya.ru](mailto:leetodev@ya.ru).