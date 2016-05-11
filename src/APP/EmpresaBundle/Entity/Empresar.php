<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresar
 *
 * @ORM\Table(name="empresar")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\EmpresarRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Empresar {

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
     * @ORM\Column(name="nome", type="string", length=255,unique=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=20)
     */
    private $cnpj;

    /**
     * @ORM\OneToOne(targetEntity="Fotos", mappedBy="empresar")
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255,unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario", inversedBy="empresa")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id",nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Categoria", mappedBy="empresar")
     */
    private $categorias;

    /**
     * @ORM\OneToMany(targetEntity="Servicos", mappedBy="empresar")
     */
    private $servicos;
    
     /**
     * @ORM\OneToMany(targetEntity="Clientes", mappedBy="empresar")
     */
    private $clientes;
    
    
    function getClientes() {
        return $this->clientes;
    }

    function setClientes($clientes) {
        $this->clientes = $clientes;
    }

        
    
    function getServicos() {
        return $this->servicos;
    }

    function setServicos($servicos) {
        $this->servicos = $servicos;
    }

    
    /**
     * @ORM\OneToMany(targetEntity="Produtos", mappedBy="empresar")
     */
    private $produtos;

    /**
     * @ORM\OneToMany(targetEntity="Fotos", mappedBy="empresarbanner")
     */
    private $banners;

    /**
     * @ORM\OneToMany(targetEntity="Receita", mappedBy="empresa")
     */
    private $receitas;

    /**
     * @ORM\OneToMany(targetEntity="Parcelas", mappedBy="empresar")
     */
    private $parcelas;

    function getParcelas() {
        return $this->parcelas;
    }

    function setParcelas($parcelas) {
        $this->parcelas = $parcelas;
    }

    function getReceitas() {
        return $this->receitas;
    }

    function setReceitas($receitas) {
        $this->receitas = $receitas;
    }

    function getBanners() {
        return $this->banners;
    }

    function setBanners($banners) {
        $this->banners = $banners;
    }

    /** @ORM\PrePersist */
    public function preCadastro() {

        $this->slug = $this->nome;
    }

    function getProdutos() {
        return $this->produtos;
    }

    function setProdutos($produtos) {
        $this->produtos = $produtos;
    }

    function getCategorias() {
        return $this->categorias;
    }

    function setCategorias($categorias) {
        $this->categorias = $categorias;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
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
     * @return Empresar
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Empresar
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * Set cnpj
     *
     * @param string $cnpj
     *
     * @return Empresar
     */
    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string
     */
    public function getCnpj() {
        return $this->cnpj;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Empresar
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo() {
        return $this->logo;
    }

    public function __toString() {
        return $this->nome;
    }

}
