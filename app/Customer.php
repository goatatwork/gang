<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\OwnsDhcpFilesTrait as OwnsDhcpFiles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Customer extends Model implements HasMedia
{
    use HasMediaTrait, OwnsDhcpFiles;

    protected $fillable = [
        'name',
        'poc_name',
        'poc_email',
        'phone1',
        'phone2',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'notes',
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('dhcp_configs')->useDisk('customer_files');
    }

    /**
     * @return boolean
     */
    public function getProvisionedAttribute()
    {
        return ($this->getMedia('dhcp_configs')->last()) ? true : false;
    }
}
