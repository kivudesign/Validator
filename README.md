# wepesi_validation
this module will help to do your own input validation from http request `POST` or `GET`.

# INTEGRATION
The integration is the simple thing to do.
First you neeed to create a new instance of `Validate` whitch will be use to do our validation.
While have the instance of validation, you can access `check` method, with take two parameters, the `source` and `rules`;
```php
    $valid=new Validate();
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
    The `rules` containe all the rule for each element of the source to be checked.

```php
    // rules 
    $rules=[
        "email"=>[
        "required"=>true,
        "email"=>true
        ]        
    ];
```
This module allow to validation on:
- `required`: this to specifie that the key will be required [true], the fact of add only required, it will directly verify if it required.
- `number`: this will check if the value is a number [true]
- `positive`: this will check if the number is positive,
- `min`: this will check the minimum lenght of a string,
- `max`: this will check the maximum lenght of a string,
- `email`: this will check if the value is an email,
- `url`: this will check if the value is url or a link,
- `matches`: this is used tho check if two key hase the same value, you shoudl specify the second field to check.
- `boolean`: check if the value is a bolean [true,false] or not also u can use [0,1] to check bolean value.

In the exampole bellow, you can see a comple procured on how to validate data-source

```php
    $source=[
        "name"=>"wepesi",
        "email"=>"infos@wepesi.cd",
        "link"=>"https://github.com/bim-g/wepesi_validation/",
        "age"=>1
        ];
    $rules=[
        "email"=>[
        "required"=>true,
        "min"=>3,
        "max"=>60,
        "url"=>true
        ],
        "link"=>[
            "required"=>true,
            "min"=>6,
            "max"=>20,
            "email"=>true
        ],
        "age"=>[
        "required"=>true,
        "number"=>true,
        "positive"=>true
    ]
    ];
    $valid=new Validate();
    $valid->check($source,$rules);
    var_dump($valid->passed());
    var_dump($valid->errors());
```