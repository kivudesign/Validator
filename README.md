# WEPESI VALIDATION
Validate your input value with a simple model tools.

## INTEGRATION
The integration is the simple thing to do.
First you need to define the rule of the input data, and easy way to do so is by using a schema model which help handle all the process,
then create an instance of `Validate` which will help validate data input according to rules already defined.
While have the instance of validation, you can access `check` method, with take two parameters, the `source` and `rules`;
The `schema` will be used to generate the model for each data type validate, 
and to `validate` will define the result of the data field checked.
```php
    $valid = new \Wepesi\App\Validate();
    $schema = new \Wepesi\App\Schema();
    $source = [];
    $rules = ["name" => $schema->string()->min(3)->max(5)->generate()];    
    $valid->check($source,$rules);
```
* `source` 
    The `source` is array object of information to be checked.
```php
    $source=[
        "name"=>"wepesi",
        "email"=>"infos@wepesi.cd",
        "link"=>"https://github.com/bim-g/wepesi_validation/",
        "age"=>1
        ];
```
* `rules` 
    The `rules` contains all the rule for each element of the source to be checked.
    you start with the name of the index key you want to check, the  with the method you want to check.
different method are now available according to you need.

 ## VALIDATION METHOD
The schema as several method according to different data type that will help to validate your field according to your input.
- any       : validate nothing
- string    : validate string data
- number    : validate number(integer)
- date      : validate your date(datetime) not yet full supported
- boolean   : validate boolean
- array     : validate array data
- file      :(_experimental_)

```php
    // rules 
    $rules=[
        "email"=>$schema->string()->email()->min(9)->max(50)->required()->generate(),    
        "year"=>$schema->number()->email()->min(35)->max(60)->required()->generate()    
    ];
```
in the example bellow, for the first rule
```php
    "email"=>$schema->string()->email()->min(9)->max(50)->required()->generate()
    
    // check `email` field should be a:
    // - string     : type of the value to be checked should be a string
    // - email      : that string should be an email
    // - min=>9     : the email should have minimum of  9 character
    // - max=>50    : the email should have maximum of 50 characters
    // - required   : it should not be empty
```

## Methods
### `any`
In case there you don't want to validate data sent, use this method, it will not be taken into consideration but the field should be defined.

### `string` 
use this method your string value, it has built in method for different scenario such:
- `required`    : this to specify that the key will be required means `is not null`.
- `min`         : check the minimum length of a string,
- `max`         : check the maximum length of a string,
- `email`       : check if the value is an email,
- `url`         : used to check url link,
- `matches`     : this is used tho check if two key has the same value, you should specify the second field to check.
- `generate`    : this methode will generate the array structure that will be used to validate the value, and should be called and the end of each element. In case it's not called there will be an error.

### supported `url` :
* `http(s)://[domain].[extension]` ,
* `http(s)://www.[domain].[extension]`,
* `www.[domain].[extension]`

In the example bellow, you can see a complete procured on how to validate data-source

```php
    $source=[
        "name"=>"wepesi",
        "email"=>"infos@wepesi.cd",
        "link"=>"https://github.com/bim-g/wepesi_validation/",
        "age"=>1
        ];
    $validate = new \Wepesi\App\Validate();
    $schema = new \Wepesi\App\Schema();
    $rules = [
        "name"=>$schema->any(),
        "email"=>$schema->string()->required()->min(3)->max(60)->email()->generate(),
        "link"=>$schema->string()->required()->min(3)->max(60)->url()->generate(),
        "age"=>$schema->number()->required()->positive()->generate()
    ];
    
    $validate->check($source,$rules);
    var_dump(["passed"=>$validate->passed()]); // return true if there is no error
    var_dump(["errors"=>$validate->errors()]); // return an array with different related errors
```
After generating the schema, now it is required to validate the schema data information,
from the validate instance object `three` method are available to do all the operation:
- `check`  : used to validate your source data according to schema, it take two paramaters, 
 * the first one is the source data which need to checked and
 * the second parameters is the generated schema.
 
- `passed` : return boolean value, is `true` if there is no problem
- `errors` : return an array, in case the `passed` return false the array will not be empty.

### `number`
validate integer is now quite difficult, but it required to be consistent in what you are doing.

### `date`      
validate your date(datetime) not yet full supported

### `boolean`   
validate boolean.
```php
    $rules = [
        "name"=>$schema->any(),
        "email"=>$schema->string()->required()->min(3)->max(60)->email()->generate(),
        "link"=>$schema->string()->required()->min(3)->max(60)->url()->generate(),
        "age"=>$schema->number()->required()->positive()->generate(),
        "agreement" => $schema->boolean()->isValid('TRUE')->required()->generate()
    ];
```

### `array`
use this method to validate your array  data object. 
- `required` : the field should be an array,
- `min` : define minimum number of elements the field should have,
- `max` : define maximum number of elements the field should have,
- `string` : check if content of an array are string,
- `number` : check if content of an array are numbers,

```php
$schema = [
    "names" => $schema->array()->min(1)->max(10)->string()->generate();
    "ages" => $schema->array()->min(2)->max(5)->number()->generate()
]
// name should be an array and should have a minimum of 1 element and maximum should be 10, each element should be a type string
// ages should be an array and should have a minimum of 2 elements and does not exceed 5, each element should be a type number

```
In some case the array can have children, and 
method, the array module as also it own method to control elements,
- `structure`: will allow to multidimensional array.
Resources
```php
$source = [
    "name" =>"wepesi",
    "email" => "info@wepesi.com",    
    "possessions" => [
        "cars" => 2,
        "plane" => 0,
        "houses" => 4,
        "children" => -3,
        "children_name" => ["alfa",3,false,"rachel"],
        "children_age" => [20,"15.7","rachel"],
        "location" => [
            "goma" => "Q.Virunga 08",
            "bukabu" => "Bagira 10",
            "kinshasa" => "matadi kibala 05"
        ]
    ]
];
```
Validation Schema

```php
$rules =[
  "name" => $schema->string()->min(1)->max(10)->required()->generate(),
  "email" => $schema->string()->email()->required()->generate(),
  "possessions" => $schema->array()->min(1)->max(2)->required()->structure([
      "cars" => $schema->number()->min(1)->required()->generate(),
      "plane" => $schema->number()->min(1)->required()->generate(),
      "houses" => $schema->number()->min(6)->required()->generate(),
      "children" => $schema->number()->positive()->required()->generate(),
      "children_name" => $schema->array()->string()->generate(),
      "children_age" => $schema->array()->number()->generate(),
      "location" => $schema->array()->min(2)->structure([
          "goma" => $schema->string()->min(20)->generate(),
          "bukabu" => $schema->string()->min(20)->generate(),
          "kinshasa" => $schema->string()->min(20)->generate(),
      ])->generate()
  ])->generate()
];
```
The method take an array of a schema generated.
In case you want to validate array with string content use `string` from array schema
`Note`: while using array you can not use `string` method or `number` with `structure` at the sametime it will cause an error,
event you can not use `string` with `number` at once, it should be one or another.

```php
$schema->array()->string()->structure([])->generate()
```
This will throw an error, each one should be used separately.
You can check the example folder then you can get all exercises for each method.

Enjoy :)
