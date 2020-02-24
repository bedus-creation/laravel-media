<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait HasMedia
{
    protected $_collection;

    /** Base URL for media */
    protected $_host;

    protected $_disk = "local";

    protected $_query;

    /** Set download true or false */
    protected $_download;

    public function media()
    {
        $query = $this->morphMany(Media::class, 'model');
        if (!empty($this->_query)) {
            $query = $query->where($this->_query);
        };
        return $query;
    }

    public function toDisk($name)
    {
        $this->_disk = $name;
        return $this;
    }

    public function toCollection($name)
    {
        $this->_collection = $name;
        return $this;
    }

    public function fromCollection($name)
    {
        $this->_query['collection'] = $name;
        return $this;
    }

    /**
     * @return void 
     */
    public function addMedia($file)
    {
        $fileUid = Storage::disk($this->_disk)
            ->putFileAs('documents', $file, $file->hashName());
        $media = $this->createMedia($fileUid);
        $this->_collection = null;
        return $media;
    }

    public function getMedia()
    {
        $media = $this->media()->get();
        $this->_query = [];
        return $media;
    }

    public function addMediaFromPath($path)
    {
        $file = new File($path);
        return $this->addMedia($file);
    }

    public function addMediaFromUrl($url)
    {
        $url = parse_url($url);
        $this->_host =  $url['scheme'] . '://' . $url['host'];
        $path =  $url['path'];
        return $this->createMedia(null, $path, $path);
        // $content = file_get_contents($path);
        // $file = tmpfile();
        // $path = stream_get_meta_data($file)['uri'];
        // return $this->addMediaFromPath($path);
    }

    /**
     * Insert into media Database
     * @param mixed $fileUid 
     * @return Media 
     */
    private function createMedia($fileUid, $url = null, $path = null)
    {
        return $this->media()->create([
            'disk' => 'local',
            'collection' => $this->_collection,
            'model_id' => $this->id,
            'model_type' => get_class($this),
            'base_url' => $this->_host ?? url('/'),
            'in_json' => json_encode([
                'url' => [
                    'small' => $url ?? Storage::url($fileUid),
                    'medium' => $url ?? Storage::url($fileUid),
                    'big' => $url ?? Storage::url($fileUid),
                ],
                'path' => [
                    'small' => $path ?? storage_path('app/public') . '/' . $fileUid,
                    'medium' => $path ?? storage_path('app/public') . '/' . $fileUid,
                    'big' => $path ?? storage_path('app/public') . '/' . $fileUid,
                ]
            ]),
        ]);
    }
}
