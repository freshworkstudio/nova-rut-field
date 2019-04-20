# RUT Field for Laravel Nova

This package adds a Chilean RUT Field to Laravel Nova. 
It uses [this composer package](https://github.com/freshworkstudio/ChileanBundle) behind the scenes.
- Formats the input text on keyup or blur
- Normalizes the format before storing the value on database (without dashes nor dots). You can disable this and store the original text sended by the user. 
- Can validate the value. 

### Getting started `RutField`


```php
use Freshwork\RutField\RutField;
// ...

public function fields(Request $request)
{
    return [
        RutField::make('rut')->rules('required|cl_rut');
    ]
}
```
#### When to format
By default, it format on forms, it format the value on `keyup`. You can change this. 
```php
RutField::make('rut')->formatOnBlur();
```

#### The format
There are three possible formats: 
```
COMPELTE     12.345.678-9
WITH DASH    12345678-9
ESCAPED      123456789
```
By default `COMPLETE` format is used, but you can change it. 
```php
RutField::make('rut')->formatComplete();
RutField::make('rut')->formatWithDash();
RutField::make('rut')->formatEscaped();
```

#### Validation
As you can check on [this composer package](https://github.com/freshworkstudio/ChileanBundle), you can use `cl_rut` laravel validation. 
If you need a custom validation error, you can override your `resources/lang/es/validation.php`. I personally use this package: https://github.com/caouecs/Laravel-lang 
```php
RutField::make('rut')->rules('required|cl_rut');
```

#### Normalize on save
By default, the RUT value is always escaped (`ESCAPED` format) before saving to database. You can change this with `saveWithoutNormalization` saving the same text written by the user on the text field.  
```php
RutField::make('rut')->saveWithoutNormalization();
```


### Format the field as Chilean RUT/DNI. 

Also, you can validate the field using 'cl_rut' laravel validation included on this package: 
https://github.com/freshworkstudio/ChileanBundle

![Screenshot](https://novapackages.com/storage/screenshots/OVgBxmtGwO8yrXeU1GKTivoKhznipJeHQO09onk7.gif)
