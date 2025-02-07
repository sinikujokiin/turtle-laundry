<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceDetail extends Eloquent{
    protected $table = 'service_details';
    use SoftDeletes;
    
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
