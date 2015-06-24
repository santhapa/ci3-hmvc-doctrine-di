<?php
namespace welcome\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ci_welcome")
 */
class Welcome
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
     */
    private $id;

	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text;

    public function getId(){
    	return $this->id;
    }

    public function setText($txt){
    	$this->text = $txt;
    }

    public function getText()
    {
    	return $this->text;
    }
}