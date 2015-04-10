<?php

class Location extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';

	protected $fillable = array('name', 'level', 'polygonal_coordinates');

}