<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
	return $this->belongsToMany('App\User', 'user_section', 'section_id', 'user_id');
    }
}
