<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\CategoriaRepository")
 */
class Categoria {

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
     * @ORM\Column(name="Nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status = 1;

    /**
     * @ORM\ManyToOne(targetEntity="empresar", inversedBy="categorias")
     *  @ORM\JoinColumn(name="empresar_id", referencedColumnName="id",nullable=false)
     */
    private $empresar;

    /**
     * @ORM\OneToMany(targetEntity="Categoria", mappedBy="pai")
     */
    private $filhas;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="filhas")
     * @ORM\JoinColumn(name="categoriaPai_id", referencedColumnName="id",nullable=true)
     *
     */
    private $pai;

    /**
     * @ORM\OneToMany(targetEntity="Produtos", mappedBy="categoria")
     */
    private $produtos;

    function getProdutos() {
        return $this->produtos;
    }

    function setProdutos($produtos) {
        $this->produtos = $produtos;
    }

    function getFilhas() {
        return $this->filhas;
    }

    function getPai() {
        return $this->pai;
    }

    function setFilhas($filhas) {
        $this->filhas = $filhas;
    }

    function setPai($pai) {
        $this->pai = $pai;
    }

    function getEmpresar() {
        return $this->empresar;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Categoria
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Categoria
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus() {
        return $this->status;
    }
  public function __toString() {
        return $this->nome;
    }
}
