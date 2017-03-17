<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PostModel;

/**
* 
*/
class PostController extends Controller
{
	/**
	* 
	*/
	public function getAdd($request, $response)
	{
		return $this->view->render($response, 'admin/post-add.twig');
	}
	
	/**
	*
	*/
	public function postAdd($request, $response)
	{
		$request = $request->getParsedBody();

		$this->validator->rule('required', ['title', 'content']);

		if ($this->validator->validate()) {
			$article = new PostModel;
			$article->title 	= $request['title'];
			$article->content 	= $request['content'];
			$article->save();

			return $response->withRedirect($this->router->pathFor('post.add'));
		} else {
			$_SESSION['errors'] = $this->validator->errors();
			$_SESSION['old']	= $request;

			return $response->withRedirect($this->router->pathFor('post.add'));
		}
	}

	/**
	*
	*/
	public static function getList()
	{
		return PostModel::orderBy('id', 'DESC')->where('deleted', 0)->get();
	}

	/**
	*
	*/
	public function getListAdmin($request, $response)
	{
		$article = self::getList();

		return $this->view->render($response, 'admin/post-list.twig', ['article' => $article]);
	}

	/**
	*
	*/
	public function getEdit($request, $response, $args)
	{
		$article = PostModel::where('id', $args(['id'])->first());

		return $this->view->render($response);
	}

	/**
	*
	*/
	public function postEdit($request, $response, $args)
	{
		$request = $request->getParsedBody();

		$this->validator->rule('required', ['title', 'content']);

		if ($this->validator->validate()) {
			$article = ArticleModel::where('id', $args['id'])->first();
			$article->title 	= $request['title'];
			$article->content 	= $request['content'];
			$article->update();

			return $response->withRedirect($this->router->pathFor());
		} else {
			$_SESSION['errors'] = $this->validator->errors();
			$_SESSION['old']	= $request;

			return $response->withRedirect($this->router->pathFor());
		}
	}

	/**
	*
	*/
	public function getTrashList($request, $response)
	{
		$data['trash'] = PostModel::orderBy('id', 'DESC')->where('deleted', 0)->get();

		return $this->view->render($response);
	}

	/**
	*
	*/
	public function setSoftdDelete($request, $response, $args)
	{
		$article = PostModel::find($args['id']);
		$article->deleted = 1;
		$article->update();

		return $response->withRedirect($this->router->pathFor('post.list'));
	}

	/**
	*
	*/
	public function setHardDelete($request, $response, $args)
	{
		$article = PostModel::find($args['id']);
		$article->delete();

		return $response->withRedirect($this->router->pathFor());
	}


	/**
	*
	*/
	public function setRestore($request, $response, $args)
	{
		$article = PostModel::find($args['id']);
		$article->deleted = 0;
		$article->update();

		return $response->withRedirect($this->router->pathFor());
	}
}