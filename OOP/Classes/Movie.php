<?php

namespace OOP\Classes;

class movie extends DbConnection { // All class that operates with db is supposed to inherite the DbConnection class.

	//rating constant variables.
	const RATING_ONE = 1;
	const RATING_TWO = 2;
	const RATING_THREE = 3;
	const RATING_FOUR = 4;
	const RATING_FIVE = 5;

	//Scope Resolution operators, for ratings in dropdown menu, used to call 
	public static $ratings = [
		self:: RATING_ONE => 'one star',
		self:: RATING_TWO => 'two stars',
		self:: RATING_THREE => 'three stars',
		self:: RATING_FOUR => 'four stars',
		self:: RATING_FIVE => 'five stars',
	];
	
	//Search function
    public function search($search='', $rating=0) {
		//base query
		$sql = "SELECT * FROM movies";

		$conditions=[];
		$params = [];

		//if we have filters - apply it
        if ($search!='' || $rating!= 0) {

        	//we have search query? apply
        	if ($search!='') {
        		$conditions[] = 'CONCAT(NAME, description) LIKE :search';
        		$params['search'] = '%'.$search.'%';
			}

        	//we have rating filter? apply
        	if ($rating!=0) {
				$conditions[] = 'rating = :rating';
				$params['rating'] = $rating;
        	}

        	//implode (join array elements with a string) conditions.
        	$sql .= ' WHERE '.implode(' AND ', $conditions);
		}

        //return results
        return $this->findAll($sql, $params);
    }

    public function find($id){

		//return results
		return $this->findOne(
			"SELECT * FROM movies  WHERE id=:id",
			['id'=>$id]
		);
    }

    public function create($name, $image, $description, $rating){

		$image_path = Storage::save($image, 'images');

		//execute query with params
		$this->execute(
			"INSERT INTO movies (name, image, description, rating) VALUES (:name, :image, :description, :rating)",
			[
				'name'=>$name,
				'image'=>$image_path,
				'description'=>$description,
				'rating'=>$rating
			]
		);
	}

    public function update($id, $name, $image, $description, $rating){

		if($image["error"] != 0){
			//update row without image, if error
			$this->execute(
				"UPDATE movies SET name=:name, description=:description, rating=:rating WHERE id=:id",
				['id'=>$id, 'name'=>$name, 'description'=>$description, 'rating'=>$rating]
			);

        }else{
            $old_data = $this->find($id);
            $old_image = $old_data['image'];

            Storage::delete($old_image);

            $image_path = Storage::save($image, 'images');

            //update image, if successfully uploaded
            $this->execute(
            	"UPDATE movies SET name=:name, image=:image, description=:description, rating=:rating WHERE id=:id",
				['id'=>$id, 'name'=>$name, 'image'=>$image_path, 'description'=>$description, 'rating'=>$rating]
			);
        }
	}
	
    //delete a movie.
    public function delete($id){
        $old_data = $this->find($id);
        $old_image = $old_data['image'];
        Storage::delete($old_image);
        $this->execute("DELETE FROM movies WHERE id=:id", ['id'=>$id]);
    }
}