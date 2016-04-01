<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fotos
 *
 * @ORM\Table(name="fotos")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\FotosRepository")
 * 
 */
class Fotos {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $arquivo;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $principal;

 
    function getProduto() {
        return $this->produto;
    }

    function setProduto($produto) {
        $this->produto = $produto;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set arquivo
     *
     * @param string $arquivo
     *
     * @return Fotos
     */
    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get arquivo
     *
     * @return string
     */
    public function getArquivo() {
        return $this->arquivo;
    }

    /**
     * Set principal
     *
     * @param boolean $principal
     *
     * @return Fotos
     */
    public function setPrincipal($principal) {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return bool
     */
    public function getPrincipal() {
        return $this->principal;
    }

}
