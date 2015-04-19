<?php
/**
 * 
 */
namespace Fish\Bundle\Entity;
/**
 * 
 */
class EnqueteEntity
{
	public $id;
	public $titulo;
	public $perguntas;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
	}

	public function setPerguntas(Array $perguntas)
	{
		$this->perguntas = $perguntas;
	}
}
