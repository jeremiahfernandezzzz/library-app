<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
	/**
     * @ORM\Column(type="string", length=100)
     */
    private $title;
	
	/**
     * @ORM\Column(type="string", length=100)
     */
    private $author;
	
	/**
     * @ORM\Column(type="string", length=20)
     */
    private $genre;
	
	
	/**
     * @ORM\Column(type="string", length=20)
     */
    private $section;
	
	
	/**
     * @ORM\Column(type="string", length=10)
     */
    private $status;
	
	//
	
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
	
    public function setTitle($title)
    {
        $this->title = $title;
    }
	//
	//
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }
	//
	//
    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
	//
	//
    public function getSection()
    {
        return $this->section;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }
	//
	//
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
