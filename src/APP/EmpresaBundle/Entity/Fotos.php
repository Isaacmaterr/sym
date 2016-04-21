<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fotos
 *
 * @ORM\Table(name="fotos")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\FotosRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="arquivo", type="string", length=255)
     */
    private $arquivo;

    /**
     * @var bool
     *
     * @ORM\Column(name="principal", type="boolean")
     */
    private $principal = 0 ;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Produtos", inversedBy="fotos")
     * @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     */
    private $produto;

    /**
     * @ORM\OneToOne(targetEntity="Empresar", inversedBy="logo")
     * @ORM\JoinColumn(name="empresar_id", referencedColumnName="id",nullable=true)
     */
    private $empresar;
    
    private $caminho= null;

    function getCaminho() {
        return $this->caminho;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    function getEmpresar() {
        return $this->empresar;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
    }

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

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    public function getAbsolutePath() {
        return null === $this->arquivo ? null : $this->getUploadRootDir() . '/' . $this->arquivo;
    }

    public function getWebPath() {
        return null === $this->arquivo ? null : $this->getUploadDir() . '/' . $this->arquivo;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return (null === $this->getCaminho())? 'uploads/produtos':$this->getCaminho();
    }

    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the
        // target filename to move to
        $filename = sha1(uniqid(mt_rand(), true));
        $this->getFile()->move(
                $this->getUploadRootDir(), $filename . '.' . $this->getFile()->getClientOriginalExtension()
        );

        // set the path property to the filename where you've saved the file
        $this->arquivo = $filename . '.' . $this->getFile()->getClientOriginalExtension();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
