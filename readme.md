# Laravel Media Handler
Laravel Media Handler package.

### Content
1. [Installtion](https://github.com/bedus-creation/laravel-media#installation)
2. [Publish Assets and Migration](https://github.com/bedus-creation/laravel-media#publish-assests)
3. [Use Trait in model](https://github.com/bedus-creation/laravel-media#add-hasmedia-trait-to-your-model)
4. [Call from anywhere](https://github.com/bedus-creation/laravel-media#use-with-model-form-whereever)
5. [Standalone Storing Media](https://github.com/bedus-creation/laravel-media#standalone-storing-media)

### Add ```HasMedia``` Trait to your model.
```
use Aammui\LaravelMedia\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasMedia;
}
```
### Use with model form whereever.
```
$user->addMedia(request()->file);
$user->addMedia([request()->file1,request()->file2]);
$user->toCollection('profilePicture')
    ->addMedia(request()->file);
$user->toCollection('profilePicture')
    ->toStorage('s3')
    ->addMedia(request()->file);
$user->toCollection('profilePicture')
    ->toStorage('local')
    ->addMedia(request()->file);
```
### Add Media From URL
```This doesnot download media into your storage.``` It just add url to the database and when your application serve, media will load from remote url.
```
$user->addMediaFromUrl('http://example.com/image.jpeg');
```
##### Download and Add Media From Remote URL.
```
$user->setDownloadTrue()
    ->addMediaFromUrl('http://example.com/image.jpeg');
```

### Retrive media from your model
```
$user->getMedia();
$user->fromCollection('profilePicture')
    ->fromStorage('local')
    ->getMedia();
```
### Setup Responsive images
```
'responsive'=>[
    '50*50','100*100'
]
```
### Enable Image optimization
```
'optimize'=>true
```

### Standalone Storing Media
Suppose you want to add file which doesnot belong to any model, then you can create standalone media. Use case could be you are storing images in description of some products in ecommerce shop, Where you simply store images in database before the product form is submitted via api, which returns public image url. 

```php
Media::addMedia(request()->file); // returns Media Object
Media::addMedia([request()->file1,request()->file2]); // Returns Media Object Collection
Media::toCollection('profilePicture')
    ->addMedia(request()->file); // returns Media Object while storing grouping files in profilepicture
Media::toCollection('profilePicture')
    ->toStorage('s3')
    ->addMedia(request()->file); // returns Media Object while storing files in s3
``` 

### Installation
```
composer require aammui/laravel-media
```
### Publish assests
```
php artisan vendor:publish --provider="Aammui\LaravelMedia\LaravelMediaServiceProvider"
php artisan migrate
```