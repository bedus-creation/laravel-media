# Laravel Media Handler
Laravel Media Handler package.

### Add media to your model
```
use HasMedia;

$user->addMedia(request()->file);
$user->addMedia([request()->file1,request()->file2]);
$user->addMedia(request()->file)
    ->toCollection('profilePicture');
$user->addMedia(request()->file)
    ->toCollection('profilePicture')
    ->toStorage('s3');
$user->addMedia(request()->file)
    ->toCollection('profilePicture')
    ->toStorage('local');
```

### Retrive media from your model
```
$user->getMedia();
$user->getMedia()
    ->fromCollection('profilePicture')
    ->fromStorage('local');
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