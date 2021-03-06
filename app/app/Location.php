<?php

namespace App;
use Eloquent;

class Location extends Eloquent
{
    protected $fillable = [
        'name', 'phone_number', 'longitude', 'latitude', 'owner_user_id',
		'data_source_id', 'universal_rating',
    ];
	public $timestamps = false;

	protected $table = 'location';

    /**
     * The tags that belong to this location.
     */
    public function tags()
    {
        return $this->belongsToMany('App\LocationTag');
    }

    public function personalizedRatings()
    {
        return $this->hasMany('App\UserLocation');
    }
	
    public function comments()
    {
        return $this->hasMany('App\ReviewComment');
    }
	
	public function locationGroup()
	{
        return $this->belongsTo('App\LocationGroup');
	}
	
	public function getName()
	{
		if ($this->name)
			return $this->name;
		if ($this->location_group_id !== null)
			return $this->locationGroup()->name;
	}
	
	public function getAccessibilityRating($ratingSystem)
	{
		if ( $this->universal_rating !== null && $ratingSystem === 'universal' )
		{
			return $this->universal_rating;
		}
		$totalCount = 0;
		$sum = 0;
		$questionCategories = QuestionCategory::get();
		foreach ($questionCategories as $category)
		{
			$sum += $category->getAccessibilityRating($this->id, $ratingSystem);
			$totalCount ++;
		}

		if ($totalCount === 0)
			$result = 0;
		else
			$result = $sum / $totalCount;
		
		if ( $ratingSystem === 'universal' )
		{
			$this->universal_rating = $result;
			$this->save();
		}
		
		return $result;
	}
	
	public function getExternalWebURL()
	{
		if (strlen($this->external_web_url) > 3)
		{
			return $this->external_web_url;
		}
		if ($this->location_group_id !== null)
		{
			$group_url = $this->locationGroup()->first()->external_web_url;
			if (strlen($group_url) > 3)
				return $group_url;
		}
		return 'https://www.google.ca/?q=' . urlencode($this->getName() . ' ' . $this->address);
	}
}
