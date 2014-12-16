<?php namespace App\Sop;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model {

    protected $table = 'sop_checklist';

    public function phase()
    {
        return $this->belongsTo('App\Sop\Phase', 'phase_id');
    }

    public function templates(){
    	return $this->hasMany('App\Model\Template','checklist_id');
    }

    public function getIsNextAttribute()
    {
        return $this->direction == 'next';
    }

    public static function availableChecklists(){
    	$rows = Checklist::all();
    	$result = array();
    	foreach($rows as $row){
    		$result[$row->id] = $row->name;
    	}
    	return $result;
    }
}
