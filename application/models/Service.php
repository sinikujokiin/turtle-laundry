<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

$CI =& get_instance();
$CI->load->model('ServiceDetail');
class Service extends Eloquent{
    protected $table = 'services';
    use SoftDeletes;
    

    public function detail()
    {
        return $this->hasMany(ServiceDetail::class, 'service_id');
    }

}
