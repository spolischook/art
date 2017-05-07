<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArtWork
 *
 * @ORM\Table(name="art_work")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtWorkRepository")
 */
class ArtWork
{
    use ORMBehaviors\Timestampable\Timestampable;

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
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="materials", type="string", length=255)
     */
    private $materials;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var bool
     * @Assert\NotBlank()
     * @Assert\Type("bool")
     * @ORM\Column(name="in_stock", type="boolean")
     */
    private $inStock;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var array
     * @Assert\NotBlank()
     * @Assert\Type("array")
     * @ORM\Column(name="images", type="array")
     */
    private $images;

    public function __construct()
    {
        $this->images = array();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ArtWork
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ArtWork
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set materials
     *
     * @param string $materials
     *
     * @return ArtWork
     */
    public function setMaterials($materials)
    {
        $this->materials = $materials;

        return $this;
    }

    /**
     * Get materials
     *
     * @return string
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ArtWork
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return ArtWork
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return ArtWork
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ArtWork
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ArtWork
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set inStock
     *
     * @param boolean $inStock
     *
     * @return ArtWork
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get inStock
     *
     * @return bool
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return ArtWork
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add imades
     *
     * @param string $image
     *
     * @return ArtWork
     */
    public function addImade($image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Get images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
}

