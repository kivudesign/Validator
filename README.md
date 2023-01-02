# WEPESI VALIDATION
this module will help to do your own input validation from http request `POST` or `GET`.

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
use this method to valida you array event with element inside. 
Apart from `required`,`min`,`max` and  `generate` method, the array module as also it own method to control elements
- `elements`: it is a method that will allow to control embedded array element as show in the example bellow.
```php
$rules =[
  "name" => $schema->string()->min(1)->max(10)->required()->generate(),
  "email" => $schema->string()->email()->required()->generate(),
  "possessions" => $schema->array()->min(1)->max(2)->required()->elements([
      "cars" => $schema->number()->min(1)->required()->generate(),
      "plane" => $schema->number()->min(1)->required()->generate(),
      "houses" => $schema->number()->min(6)->required()->generate(),
      "children" => $schema->number()->positive()->required()->generate(),
      "location" => $schema->array()->min(2)->elements([
          "goma" => $schema->string()->min(20)->generate(),
          "bukabu" => $schema->string()->min(20)->generate(),
          "kinshasa" => $schema->string()->min(20)->generate(),
      ])->generate()
  ])->generate()
];
```
The method take an array of a schema generated.

You can check the example folder then you can get all exercises for each method.

`Enjoy` :)
