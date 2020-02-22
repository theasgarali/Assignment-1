<?php

namespace OOP\Classes;

// Observer pattern - splObserver. Logs all search requests

class SearchObserver implements \SplObserver{

	public function update($observable)
    {
		//create Movie object
        $movieObject = new Movie();

		//write search data
		$movieObject->write_search($observable->query, $observable->rating, $observable->count);
    }
}