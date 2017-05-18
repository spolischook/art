<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\TranslationBundle\Model\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ArtWork.
 *
 * @ORM\Table(name="art_work")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtWorkRepository")
 * @UniqueEntity("slug")
 */
class ArtWork implements TranslatableInterface
{
    use ORMBehaviors\Timestampable\Timestampable;
    use ORMBehaviors\Translatable\Translatable;

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
     * @Assert\Type("string")
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"}, updatable=true)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

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
     *
     * @Assert\Type("float")
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="in_stock", type="boolean")
     */
    private $inStock;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="in_published", type="boolean")
     */
    private $isPublished;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="was_published", type="boolean")
     */
    private $wasPublished;

    /**
     * @var Media
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $picture;

    /**
     * @var ArrayCollection|Media[]
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="artWorks")
     */
    private $images;

    /**
     * @var ArrayCollection|Exhibition[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Exhibition", inversedBy="artWorks")
     */
    private $exhibitions;

    public function __construct()
    {
        $this->isPublished = false;
        $this->wasPublished = false;
        $this->images = new ArrayCollection();
        $this->exhibitions = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return ArtWork
     */
    public function setTitle($title)
    {
        $this->name = $title;
        $this->translate(null, false)->setTitle($title);

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->translate(null, false)->getTitle();
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return ArtWork
     */
    public function setDescription($description)
    {
        $this->translate(null, false)->setDescription($description);

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->translate(null, false)->getDescription();
    }

    /**
     * Set materials.
     *
     * @param string $materials
     *
     * @return ArtWork
     */
    public function setMaterials($materials)
    {
        $this->translate(null, false)->setMaterials($materials);

        return $this;
    }

    /**
     * Get materials.
     *
     * @return string
     */
    public function getMaterials()
    {
        return $this->translate(null, false)->getMaterials();
    }

    /**
     * Get slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return ArtWork
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set width.
     *
     * @param int $width
     *
     * @return ArtWork
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height.
     *
     * @param int $height
     *
     * @return ArtWork
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set date.
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
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price.
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
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set inStock.
     *
     * @param bool $inStock
     *
     * @return ArtWork
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get inStock.
     *
     * @return bool
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * Set isPublished.
     *
     * @param bool $isPublished
     *
     * @return ArtWork
     */
    public function setIsPublished($isPublished)
    {
        if ($isPublished) {
            $this->wasPublished = true;
        }
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get inPublished.
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Get wasPublished.
     *
     * @return bool
     */
    public function getWasPublished()
    {
        return $this->wasPublished;
    }

    /**
     * Set picture.
     *
     * @param Media $picture
     *
     * @return ArtWork
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add images.
     *
     * @param Media $image
     *
     * @return ArtWork
     */
    public function addImages($image)
    {
        if (!$image) {
            $this->images = new ArrayCollection();
        }

        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->addArtWork($this);
        }

        return $this;
    }

    /**
     * Remove image.
     *
     * @param Media $image
     *
     * @return ArtWork
     */
    public function removeImages($image)
    {
        $this->getImages()->removeElement($image);

        return $this;
    }

    /**
     * Get media.
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add exhibition.
     *
     * @param Exhibition $exhibition
     *
     * @return ArtWork
     */
    public function addExhibition($exhibition)
    {
        if (!$exhibition) {
            $this->exhibitions = new ArrayCollection();
        }

        if (!$this->exhibitions->contains($exhibition)) {
            $this->exhibitions->add($exhibition);
            $exhibition->addArtWork($this);
        }

        return $this;
    }

    /**
     * Remove exhibition.
     *
     * @param Exhibition $exhibition
     *
     * @return ArtWork
     */
    public function removeExhibition($exhibition)
    {
        $this->getExhibitions()->removeElement($exhibition);

        return $this;
    }

    /**
     * Get exhibitions.
     *
     * @return ArrayCollection
     */
    public function getExhibitions()
    {
        return $this->exhibitions;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->setCurrentLocale($locale);

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getCurrentLocale();
    }
}
