## Image Resizing  Package for Laravel 5.* (update 17/09/2017)

[![Laravel](https://img.shields.io/badge/Laravel-5.*-orange.svg?style=flat-square)](http://laravel.com)
[![Software License][ico-license]](LICENSE.md)

Based on **[anakadote/laravel-5-image-manager.][anakadote]**

Resize images with predefined sizes in config / imageManager.php

# Attention!!!!!!!!!!!!
## 
# important changes were made in how to obtain the cropped images, please read the new documentation. 
# If you don't want to replace the changes but want to use Auto-Discovery you can use version 5.5.0

## Install

Edit your project's composer.json

``` bash
"require": {
    "anakadote/laravel-5-image-manager": "dev-master", 
    "kujjs/resize-image": "^0.5.5.1"
}
```

Add the service provider. config/app.php

```php
'providers' => [
    kujjs\imageManager\imageManagerServiceProvider::class, // optional, you can use Auto-Discovery
    Anakadote\ImageManager\ImageManagerServiceProvider::class,
];
```

If not use Auto-Discovery your add next alias in config/app.php
```php
'aliases' => [
  ...
  'Image' => 'kujjs\imageManager\Facades\ImageManager',
];
```

And run the following command

``` bash
$ php artisan vendor:publish
``` 
## Usage

Set sizes in **config/imageManager.php**
```php
    'sizes' => [
        'thumbnail' => [
          'width'   => 120,
          'height'  => 120,
            'mode'    => 'crop', || fit || fit-x || fit-y
            'quality' => 90
          ]
    ];
```
| Property || Description |
|--------|----|-------------|
|`width`|*required*|The width of the generated image in pixels.|
|`height`|*required*|The height of the generated image in pixels.|
|`mode`|*required*|Defines the way the image will be transformed. See the table below for accepted modes|
|`quality`|*required*|The quality that will have the final image. range 0-100|

###

|Mode|Description|
|------|-----------|
|`crop`|Will smart crop an image to make it fit the desired dimensions. It will cut content of the image off the top/bottom and sides if required to preserve the aspect ratio.|
|`fit`| Fit while maintaining aspect ratio|
|`fit-x`| Fit to the given width while maintaining aspect ratio|
|`fit-y`| Fit to the given height while maintaining aspect ratio|


## **Image::make($file , $size='thumbnail'))** ##

```php
     {{ Image::make(public_path('img/image.jpg'),'thumbnail') }} 
OR
      {{ Image::make(public_path('img/image.jpg')) }}
```
Return
```html
    img/120-120/crop/image.jpg
```
| Property || Description |
|--------|----|-------------|
|`File`|*required* *(string)*| The fully qualified name of image file. The file must reside in your app's public directory. You'll need to grant write access by the web server to the public directory and its children|
|`Size Name`|*(optional)* *(string)*|The name of the size that is defined in **config/imageManager.php**.|

## get full url 
#### **toUrl()**
```php
    {{ Image::make(public_path('img/image.jpg'),'thumbnail')->toUrl() }}
```
return 
```html
    http://mysite.dev/img/120-120/crop/image.jpg
```
## Get tag img  
#### **toHtml( $attributes = [] )** 

```php
    {!! Image::make(public_path('img/image.jpg'),'thumbnail')->toHtml() !!}
```
Return 
```html
  <img src="http://mysite.dev/img/120-120/crop/image.jpg">
``` 
Or
```php
    {!! Image::make(public_path('img/image.jpg'),'thumbnail')->toHtml(['class'=>'my-class','alt'=>'my alt','title'=>'my title', 'attributes'=>'values']) !!}
```
Return 
```html
    <img src="http://mysite.dev/img/120-120/crop/image.jpg" "alt"="my alt" "title"="my title" "class"="my-class" "attributes"="values">
``` 
| Property || Description |
|--------|----|-------------|
|`attributes`|*optional* *(array)*| Attributes html you can inset in the tag img|





## Remove
### **Image::delete($file)**

remove image with all size declarade in config/imageManager.php
```php
    Image::delete(public_path('img/image.jpg'))
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-travis]: https://travis-ci.org/:vendor/:package_name

[anakadote]: https://github.com/anakadote/ImageManager-for-Laravel-5

