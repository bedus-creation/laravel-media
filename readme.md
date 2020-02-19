# Laravel Media Handler
Laravel Media Handler package.

### Add media to your model
```
use HasMedia;

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