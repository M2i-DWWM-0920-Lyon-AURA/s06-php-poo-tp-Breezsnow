<?php

final class Developer
{
    protected $id;
    protected $name;
    protected $link;

    public function __construct(
        int $id = null,
        string $name = '',
        string $link = ''
    )
    {
        $this->id=$id;
        $this->name=$name;
        $this->link=$link;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

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
}

function createDeveloper($id, $name, $link) 
{
    return new Developer($id, $name, $link);
}

function fetchAllDevelopers() 
{
    global $dbh;
    $stmt = $dbh->query('SELECT * FROM `developer`');
    return $stmt->fetchAll(PDO::FETCH_FUNC, 'createDeveloper');
}

function fetchDeveloperById($id) 
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM `developer` WHERE `id` = :id');
    $stmt->execute([':id' => $id]);
    $result=$stmt->fetchAll(PDO::FETCH_FUNC, 'createDeveloper');
    return $result[0];
}