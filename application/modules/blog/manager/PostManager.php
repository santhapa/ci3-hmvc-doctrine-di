<?php

namespace blog\manager;

use Doctrine\ORM\EntityManager;
use blog\models\Post;

class PostManager{

	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function createPost()
	{
		return new Post();
	}

	public function updatePost(Post $post, $flush=true)
	{
		$this->em->persist($post);
		if($flush)
		{
			$this->em->flush();
		}
	}

	public function removePost(Post $post)
	{
		$this->em->remove($post);
		$this->em->flush();

		return;
	}

	public function getPostById($id)
	{
		return $this->em->getRepository("\blog\models\Post")->findOneBy(array('id'=>$id));
	}

	public function getPosts()
	{
		return $this->em->getRepository("\blog\models\Post")->findAll();
	}
}