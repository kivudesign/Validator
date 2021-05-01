# wepesi_validation
this module will help to do your own input validation from http request `POST` or `GET`.

# INTEGRATION
The integration is the simple thing to do.
First you neeed to create a new instance of `Validate` whitch will be use to do our validation.
While have the instance of validation, you can access `check` method, with take two parameters, the `source` and `rules`;
```php
    $valid=new Validate($source);
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
    - ...

```php
    // rules 
    $rules=[
        "email"=>$valid->string("name")->email()->min(9)->max(50)->required()->check(),    
        "year"=>$valid->number("year")->email()->min(35)->max(60)->required()->check()    
    ];
```
in the example bellow, for the first rule
```php
    "email"=>$valid->string("name")->email()->min(9)->max(50)->required()->check()
    
    // check `email` keys should be a:
    // - string: type of the value to be check should be a string
    // - email: that string should be a email
    // - min:9=> the email should have minimum caracters  9 caracter
    // - min:9=> the email should have maximum caracters should exid 50 caracters
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
$valid=new Validate($source);
    $rules=[
        "name"=>$validate->string("name")->required()->min(3)->max(30)->check(),
        "email"=>$validate->string("email")->required()->min(3)->max(60)->email()->check(),
        "link"=>$validate->string("link")->required()->min(3)->max(60)->url()->check(),
        "age"=>$validate->number("age")->required()->positive()->check()
    ];
    
    $valid->check($source,$rules);
    var_dump($valid->passed()); // if everything is correct return true
    var_dump($valid->errors()); // return all errors according to the validation type
```