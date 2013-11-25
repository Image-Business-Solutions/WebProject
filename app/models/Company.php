<?php

class Company extends Eloquent {

	protected $table = 'companies';

	public function products()
    {
        return $this->hasMany('Products');
    }

    public function categories()
    {
        return $this->belongsToMany('Category' , 'rel_companies_categories', 'company_id', 'category_id');
    }

}