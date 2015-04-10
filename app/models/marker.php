<?php

class Marker extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'markers';

	protected $fillable = array('latitude', 'longitude', 'location_id');

}