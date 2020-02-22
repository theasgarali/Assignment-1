<?php

namespace OOP\Classes;

use PDO; //PHP Data Objects (PDO) extension.
use PDOException;//Class that represents an error raised by PDO.


class DbConnection{ // Database connection class that will be used as base class in other classes.

	private $connection;

    private function getConnection() {

		//try to open connection if it is empty
		if (!isset($this->connection)) {
			try {
				//create new PDO object
				$this->connection = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			} catch (PDOException $e) {
				//die if we catch PDO exception
				echo "Failed Connection:" . $e->getMessage();
				die();
			}
		}

		return $this->connection;
	}

    protected function findOne($sql, $params=[]) {
		//prepare statement
		$sth = $this->getConnection()->prepare($sql);

		//execute statement
		$sth->execute($params);

		//return results
		return $sth->fetch();
	}

	protected function findAll($sql, $params=[]) {
		//prepare statement
		$sth = $this->getConnection()->prepare($sql);

		//execute statement
		$sth->execute($params);

		//return results
		return $sth->fetchAll();
	}

	protected function execute($sql, $params=[]) {

    	//prepare the statement
		$sth = $this->getConnection()->prepare($sql);
		$sth->execute($params);
	}
}