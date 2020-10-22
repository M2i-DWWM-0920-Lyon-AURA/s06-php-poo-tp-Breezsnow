<?php

final class Game
{
    protected $id;
    protected $title;
    protected $release_date;
    protected $link;
    protected $developer_id;
    protected $platform_id;

    public function __construct(
        int $id = null,
        string $title = '',
        string $release_date = '',
        string $link = '',
        int $developer_id = 0,
        int $platform_id = 0
    )
    {
        $this->id=$id;
        $this->title=$title;
        $this->release_date=$release_date;
        $this->link=$link;
        $this->developer_id=$developer_id;
        $this->platform_id=$platform_id;

    }



    protected function create()
    {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO `game` (`title`, `release_date`, `link`, `developer_id`, `platform_id`) VALUES (:title, :release_date, :link, :developer_id, :platform_id) ');
        $stmt->execute([':title'=>$this->title, ':release_date'=>$this->release_date, ':link'=>$this->link, ':developer_id'=>$this->developer_id,':platform_id'=>$this->platform_id]);



    }
    
    protected function update()
    {
        global $dbh;
        $stmt = $dbh->prepare('INSERT `game` SET `title`=:title, `release_date`=:release_date, `link`:link, `developer_id`=:developer_id, `platform_id`=:platform_id WHERE `id`=:id;');
        $stmt->execute([':id'=>$this->id, ':title'=>$this->title, ':release_date'=>$this->release_date, ':link'=>$this->link, ':developer_id'=>$this->developer_id, ':platform_id'=>$this->platform_id]);


    }

    public function delete()
    {
        global $dbh;

        $dbh->exec('DELETE FROM `game` WHERE `id` = ' . $this->id);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of developer_id
     */ 
    public function getDeveloper_id()
    {
        return $this->developer_id;
    }

    /**
     * Set the value of developer_id
     *
     * @return  self
     */ 
    public function setDeveloper_id($developer_id)
    {
        $this->developer_id = $developer_id;

        return $this;
    }

    /**
     * Get the value of platform_id
     */ 
    public function getPlatform_id()
    {
        return $this->platform_id;
    }

    /**
     * Set the value of platform_id
     *
     * @return  self
     */ 
    public function setPlatform_id($platform_id)
    {
        $this->platform_id = $platform_id;

        return $this;
    }

    public function getDeveloper()
    {
        return fetchDeveloperById($this->developer_id);
    }

    public function setDevelopper( $developer) {
        $this->developer_id = $developer->getId();

        return $this;
    }
    public function getPlatform()
    {
        return fetchPlatformById($this->platform_id);
    }

    public function setPlatform( $platform) {
        $this->platform_id = $platform->getId();

        return $this;
    }
}

function createGame($id, $title, $release_date, $link, $developer_id, $platform_id) {
    return new Game($id, $title, $release_date, $link, $developer_id, $platform_id);
}

function fetchAllGames() {
    global $dbh;

    $stmt = $dbh->query('SELECT * FROM `game`');
    return $stmt->fetchAll(PDO::FETCH_FUNC, 'createGame');
}