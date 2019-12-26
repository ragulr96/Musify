<?php

class TimelinePostModel extends CI_Model
{
	public $id;
	public $userId;
	public $postTitle = '';
	public $postContent = '';
	public $slugValue = '';
	public $createdTime = '';

	/**
	 * gets postId
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * sets post Id
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * get the userId
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * set the userId
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * gets the postTitle
	 * @return string
	 */
	public function getPostTitle()
	{
		return $this->postTitle;
	}

	/**
	 * sets the postTitle
	 * @param string $postTitle
	 */
	public function setPostTitle($postTitle)
	{
		$this->postTitle = $postTitle;
	}

	/**
	 * gets the postContent and implode it to detect images and hyperlinks
	 * @return string
	 */
	public function getPostContent()
	{
		$imageRegex = '/https?:\/\/[^ ]+?(?:\.jpg|\.png|\.gif)/';
		$hyperlinkRegex = '~(?<!src=\')https?://\S+\b~';

		$result = $this->postContent;

		$result = preg_replace($imageRegex, "<img src='\\0'>", $result);
		$result = preg_replace($hyperlinkRegex, "<a href='\\0'>\\0</a>", $result);

		return $result;
	}

	/**
	 * get editable postContent
	 * @return string
	 */
	public function getPostContentForEdit()
	{
		return $this->postContent;
	}

	/**
	 * sets the postContent
	 * @param string $postContent
	 */
	public function setPostContent($postContent)
	{
		$this->postContent = $postContent;
	}

	/**
	 * gets the slugValue
	 * @return string
	 */
	public function getSlugValue()
	{
		return $this->slugValue;
	}

	/**
	 * sets the slugValue
	 * @param string $slugValue
	 */
	public function setSlugValue($slugValue)
	{
		$this->slugValue = $slugValue;
	}

	/**
	 * gets the post createdTime
	 * @return string
	 */
	public function getCreatedTime()
	{
		return $this->createdTime;
	}

	/**
	 * sets the post createdTime
	 * @param string $createdTime
	 */
	public function setCreatedTime($createdTime)
	{
		$this->createdTime = $createdTime;
	}

	/**
	 * Update edited post object
	 * @param $postTitle
	 * @param $postContent
	 */
	public function updateEditedTimeLinePostData($postTitle, $postContent)
	{
		$this->postTitle = $postTitle;
		$this->postContent = $postContent;
	}
}
