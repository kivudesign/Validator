# wepesi_validation
this module will help to do your own input validation from http request `POST` or `GET`.

# INTEGRATION
The integration is the simple thing to do.
First you need to define the rule of the input data, and easy way to do so is by using a schema model which help hundle all of the process,
then create an instance of `Validate` which will help validate data input according to rules already defined.
While have the instance of validation, you can access `check` method, with take two parameters, the `source` and `rules`;
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

 * `Validation Method`
    now you can validate your keys according to a specify type witch are:
    - string
    - number
    - date,
    - boolean
    - file

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
    
    // check `email` keys should be a:
    // - string: type of the value to be check should be a string
    // - email: that string should be a email
    // - min:9=> the email should have minimum caracters  9 caracter
    // - max:50=> the email should have maximum caracters should exid 50 caracters
    // - required=> it will no be empty
```

`STRING` method allow to validation:
    - `required`: this to specify that the key will be required means `is not null`.
    - `min`: this will check the minimum length of a string,
    - `max`: this will check the maximum length of a string,
    - `email`: this will check if the value is an email,
    - `url`: this will check if the value is url or a link,
    - `matches`: this is used tho check if two key has the same value, you should specify the second field to check.

In the example bellow, you can see a complete procured on how to validate data-source

```php
    $source=[
        "name"=>"wepesi",
        "email"=>"infos@wepesi.cd",
        "link"=>"https://github.com/bim-g/wepesi_validation/",
        "age"=>1
        ];
$valid = new \Wepesi\App\Validate();
$schema = new \Wepesi\App\Schema();
    $rules=[
        "name"=>$schema->string()->required()->min(3)->max(30)->generate(),
        "email"=>$schema->string()->required()->min(3)->max(60)->email()->generate(),
        "link"=>$schema->string()->required()->min(3)->max(60)->url()->generate(),
        "age"=>$schema->number()->required()->positive()->generate()
    ];
    
    $valid->check($source,$rules);
    var_dump($valid->passed()); // if everything is correct return true
    var_dump($valid->errors()); // return all errors according to the validation type
```