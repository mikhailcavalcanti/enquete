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
	public $pergunta;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
	}

	public function setPergunta($pergunta)
	{
		$this->pergunta = $pergunta;
	}
}
