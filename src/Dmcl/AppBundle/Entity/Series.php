<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="series", indexes={@ORM\Index(name="last_modified", columns={"last_modified"}), @ORM\Index(name="tmdb_id", columns={"tmdb_id"})})
 * @ORM\Entity
 */
class Series
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=false)
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(name="cover_big", type="string", length=255, nullable=false)
     */
    private $coverBig;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="plot", type="text", length=65535, nullable=false)
     */
    private $plot;

    /**
     * @var string
     *
     * @ORM\Column(name="cast", type="text", length=65535, nullable=false)
     */
    private $cast;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=255, nullable=false)
     */
    private $director;

    /**
     * @var string
     *
     * @ORM\Column(name="releaseDate", type="string", length=255, nullable=false)
     */
    private $releasedate;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_modified", type="integer", nullable=false)
     */
    private $lastModified;

    /**
     * @var integer
     *
     * @ORM\Column(name="tmdb_id", type="integer", nullable=false)
     */
    private $tmdbId;

    /**
     * @var string
     *
     * @ORM\Column(name="seasons", type="text", length=16777215, nullable=false)
     */
    private $seasons;

    /**
     * @var integer
     *
     * @ORM\Column(name="episode_run_time", type="integer", nullable=false)
     */
    private $episodeRunTime = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="backdrop_path", type="text", length=65535, nullable=false)
     */
    private $backdropPath;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_trailer", type="text", length=65535, nullable=false)
     */
    private $youtubeTrailer;



    /**
     * Get id
     *
     * @return integer
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
     * @return Series
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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Series
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Series
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set coverBig
     *
     * @param string $coverBig
     *
     * @return Series
     */
    public function setCoverBig($coverBig)
    {
        $this->coverBig = $coverBig;

        return $this;
    }

    /**
     * Get coverBig
     *
     * @return string
     */
    public function getCoverBig()
    {
        return $this->coverBig;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Series
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set plot
     *
     * @param string $plot
     *
     * @return Series
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * Get plot
     *
     * @return string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Set cast
     *
     * @param string $cast
     *
     * @return Series
     */
    public function setCast($cast)
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * Get cast
     *
     * @return string
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Series
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set director
     *
     * @param string $director
     *
     * @return Series
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set releasedate
     *
     * @param string $releasedate
     *
     * @return Series
     */
    public function setReleasedate($releasedate)
    {
        $this->releasedate = $releasedate;

        return $this;
    }

    /**
     * Get releasedate
     *
     * @return string
     */
    public function getReleasedate()
    {
        return $this->releasedate;
    }

    /**
     * Set lastModified
     *
     * @param integer $lastModified
     *
     * @return Series
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return integer
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set tmdbId
     *
     * @param integer $tmdbId
     *
     * @return Series
     */
    public function setTmdbId($tmdbId)
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }

    /**
     * Get tmdbId
     *
     * @return integer
     */
    public function getTmdbId()
    {
        return $this->tmdbId;
    }

    /**
     * Set seasons
     *
     * @param string $seasons
     *
     * @return Series
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;

        return $this;
    }

    /**
     * Get seasons
     *
     * @return string
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * Set episodeRunTime
     *
     * @param integer $episodeRunTime
     *
     * @return Series
     */
    public function setEpisodeRunTime($episodeRunTime)
    {
        $this->episodeRunTime = $episodeRunTime;

        return $this;
    }

    /**
     * Get episodeRunTime
     *
     * @return integer
     */
    public function getEpisodeRunTime()
    {
        return $this->episodeRunTime;
    }

    /**
     * Set backdropPath
     *
     * @param string $backdropPath
     *
     * @return Series
     */
    public function setBackdropPath($backdropPath)
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    /**
     * Get backdropPath
     *
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * Set youtubeTrailer
     *
     * @param string $youtubeTrailer
     *
     * @return Series
     */
    public function setYoutubeTrailer($youtubeTrailer)
    {
        $this->youtubeTrailer = $youtubeTrailer;

        return $this;
    }

    /**
     * Get youtubeTrailer
     *
     * @return string
     */
    public function getYoutubeTrailer()
    {
        return $this->youtubeTrailer;
    }
}
