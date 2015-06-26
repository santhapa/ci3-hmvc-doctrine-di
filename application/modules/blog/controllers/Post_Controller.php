<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use blog\models\Welcome;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Post_Controller extends MX_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$postManager = $this->container->get('blog.post_manager');
		$posts = $postManager->getPosts();
		
		$this->load->view('index', array('posts'=> $posts));
	}

	public function add(){

		$postManager = $this->container->get('blog.post_manager');

		if($this->input->post('addPost')){
			$title = $this->input->post('title');
			$post = $postManager->createPost();
			$post->setTitle($title);
			$postManager->updatePost($post);

			redirect('blog/post');
		}
		return $this->load->view('add');
	}

	public function edit($id)
	{
		$postManager = $this->container->get('blog.post_manager');
		$post = $postManager->getPostById($id);
		if(!$post)
			throw new Exception("Post not found", 1);

		if($this->input->post('editPost')){
			$title = $this->input->post('title');
			$post->setTitle($title);
			$postManager->updatePost($post);

			redirect('blog/post');
		}
		return $this->load->view('edit', array('post'=> $post));
	}

	public function delete($id)
	{
		$postManager = $this->container->get('blog.post_manager');
		$post = $postManager->getPostById($id);
		if(!$post)
			throw new Exception("Post not found", 1);

		$postManager->removePost($post);

		redirect('blog/post');
	}
}
