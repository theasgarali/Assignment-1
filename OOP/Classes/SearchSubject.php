<?php


/*If a user sends a search request, relative observers are invoked.*/

namespace OOP\Classes;

class SearchSubject implements \SplSubject
{
    // this is variable to save observers 
    private $observers = array();

    //a variable to save query
    public $query;

	//a variable to save rating
	public $rating;

	//variable for results count
	public $count;

    //new search happens, It notify to observers and let them update.
    public function notify()
    {
        foreach( $this->observers as $observer )
            $observer->update( $this );
    }

    //detach a observer from subject.
    public function detach( $observer )
    {
        $this->observers []= $observer;
    }

    //attach a observer from subject.
    public function attach( $observer )
    {
        $this->observers []= $observer;
    }

    //Try to find movies and notify observers
    public function search($query, $rating)
    {
        // create Movie instance
		$movieObject = new Movie();

		//search for movies
		$movies = $movieObject->search($query, $rating);

		//save search params & results count
		$this->query = (''==$query?'ALL':$query);
		$this->rating = $rating;
		$this->count = count($movies);

		//notify observers
		$this->notify();

		return $movies;
    }
}