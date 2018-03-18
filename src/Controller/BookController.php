<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
 
    
	/**
	 * @Route("/")
	 */
	public function redirAction()
	{
		return $this->redirect('/all');
	}

	
	/**
	 * @Route("/new")
	 */
	public function newAction()
	{
		return $this->render('/new.html.twig');
	}
	
	/**
     * @Route("/add", name="add")
     */
    public function addAction()
	{
		$entityManager = $this->getDoctrine()->getManager();
		
		$book = new Book();
		$book->setTitle($_POST["title"]);
		$book->setAuthor($_POST["author"]);
		$book->setGenre($_POST["genre"]);
		$book->setSection($_POST["section"]);
		$book->setStatus("returned");
		
		$entityManager->persist($book);
		
		$entityManager->flush();
		
		return $this->redirect('/all');
	}
	
	
	/**
	 * @Route("/edit/{id}")
	 */
	public function editAction($id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);

		if (!$book) {
			throw $this->createNotFoundException(
				'No book found for id '.$id
			);
		}
		
		return $this->render('/edit.html.twig', array(
			'book' => $book
		));
	}
	
	/**
	 * @Route("/update/{id}")
	 */
	public function updateAction($id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);

		if (!$book) {
			throw $this->createNotFoundException(
				'No book found for id '.$id
			);
		}

		$book->setTitle($_POST["title"]);
		$book->setAuthor($_POST["author"]);
		$book->setGenre($_POST["genre"]);
		$book->setSection($_POST["section"]);
		
		$entityManager->flush();
		return $this->redirect('/all');
	}
	
	
	/**
	 * @Route("/delete/{id}")
	 */
	public function deleteAction($id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);

		if (!$book) {
			throw $this->createNotFoundException(
				'No book found for id '.$id
			);
		}

		$entityManager->remove($book);
		$entityManager->flush();	

		return $this->redirect('/all');
	}
	
	
	
	/**
	 * @Route("/borrow-return/{id}")
	 */
	public function borrowReturnAction($id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$book = $entityManager->getRepository(Book::class)->find($id);

		if (!$book) {
			throw $this->createNotFoundException(
				'No book found for id '.$id
			);
		}
		
		if($book->getStatus() === "returned"){
			$book->setStatus("borrowed");
			$entityManager->flush();	
		} else {
			$book->setStatus("returned");
			$entityManager->flush();	
		}
		return $this->redirect('/all');

	}
	
	
	/**
	 * @Route("/all")
	 */
	public function allAction()
	{
		$entityManager = $this->getDoctrine()->getManager();
		$books = $entityManager->getRepository(Book::class)->findAll();

		return $this->render('/all.html.twig', array(
			'books' => $books
		));
	}
	
	
	
	/**
	 * @Route("/search")
	 */
	public function searchAction()
	{
		$entityManager = $this->getDoctrine()->getManager();
		$books = $entityManager->getRepository(Book::class)->findBy([$_POST["search_by"] => $_POST["search_query"], "status" => "returned"]);

		return $this->render('/all.html.twig', array(
			'books' => $books,
			'parameters' => $_POST["search_by"] . " : " . $_POST["search_query"]
		));
	}
	
}