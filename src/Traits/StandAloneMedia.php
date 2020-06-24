<?php

namespace Aammui\LaravelMedia\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait StandAloneMedia
{
    protected $_collection;

    /** Base URL for media */
    protected $_host;

    protected $_disk = "public";

    protected $_query;

    /** Set download true or false */
    protected $_download;

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

    public function getMedia()
    {
        $query = $this->_query;
        $this->_query = [];

        if (empty($query)) {
            return $this->get();
        };
        return $this->where($query)->get();
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

    public function addMediaFromUrl($url)
    {
        $url = parse_url($url);
        $this->_host =  $url['scheme'] . '://' . $url['host'];
        $path =  $url['path'];
        return $this->createMedia(null, $path, $path);
    }

    public function addMediaFromPath($path)
    {
        $file = new File($path);
        return $this->addMedia($file);
    }

    /**
     * Insert into media Database
     * @param mixed $fileUid 
     * @return Media 
     */
    private function createMedia($fileUid, $url = null, $path = null)
    {
        return $this->create([
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
