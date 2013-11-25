<?php

class Classification extends Eloquent {

	protected $table = 'classifications';

    public function places()
    {
        return $this->belongsToMany('Places' , 'places_classifications', 'classification_id', 'place_id');
    }

}