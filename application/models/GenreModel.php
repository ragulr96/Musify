<?php

class GenreModel extends CI_Model
{
	public $userId;
	public $favoriteGenres = '';

	/**
	 * gets the userId
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * sets the userId
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * get favoriteGenres
	 * @return string
	 */
	public function getFavoriteGenres()
	{
		if ($this->favoriteGenres !== NULL) {
			return $this->favoriteGenres;
		} else {
			return '';
		}
	}

	/**
	 * set favoriteGenres
	 * @param string $favoriteGenres
	 */
	public function setFavoriteGenres($favoriteGenres)
	{
		$this->favoriteGenres = $favoriteGenres;
	}

	/**
	 * Function to set genre details on registration
	 * @param $userId
	 * @param $favoriteGenres
	 */
	public function setFavoriteGenresOnReg($userId,$favoriteGenres)
	{
		$this->userId = $userId;
		$this->favoriteGenres = $favoriteGenres;
	}

	/**
	 * Function to update genre data object
	 * @param $userId
	 * @param $favoriteGenres
	 */
	public function updateGenreData($userId,$favoriteGenres)
	{
		$this->userId = $userId;
		$this->favoriteGenres = implode(',', $favoriteGenres);
	}
}
