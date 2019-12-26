<?php

include_once 'GenreModel.php';


class GenreManager extends CI_Model
{
	/**
	 * GenreManager constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Function to get favorite genres of a user
	 * @param $userId
	 * @return mixed
	 */
	public function getUserGenreDetails($userId)
	{
		// active record query to get genre detail
		$getUserGenreDetailsQuery = $this->db->get_where('genre', array('userId' => $userId));

		// check for returned value
		if ($getUserGenreDetailsQuery->num_rows() > 0) {

			// sets value to GenreModel
			$fetchGenreDetails = $getUserGenreDetailsQuery->custom_result_object('GenreModel');

			return $fetchGenreDetails;
		}
	}

	/**
	 * Function to update favorite genres of a user
	 * @param $favoriteGenres
	 * @param $userId
	 * @return mixed
	 */
	public function updateGenreDetails($favoriteGenres, $userId)
	{
		// get genre details
		$fetchGenreDetails = $this->getUserGenreDetails($userId);

		$genreObj = $fetchGenreDetails[0];

		// update genre details
		$genreObj->updateGenreData($userId, $favoriteGenres);

		// active record query to update genre details
		$this->db->where('userId', $userId);
		return $this->db->update('genre', $genreObj);
	}

}
