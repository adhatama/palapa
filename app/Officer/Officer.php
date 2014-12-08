<?php namespace App\Officer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model {

    use SoftDeletes;

    protected $table = 'officers';

    protected $fillable = ['name', 'nip', 'pangkat_id', 'jabatan_id'];

    public function pangkat()
    {
        return $this->belongsTo('App\Lookup\Lookup', 'pangkat_id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Lookup\Lookup', 'jabatan_id');
    }

    public function getPangkatNameAttribute()
    {
        if($this->pangkat)
        {
            return $this->pangkat['name'];
        }

        return null;
    }

    public function getJabatanNameAttribute()
    {
        if($this->jabatan)
        {
            return $this->jabatan['name'];
        }

        return null;
    }
}