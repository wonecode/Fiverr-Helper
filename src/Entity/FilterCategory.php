<?php

namespace App\Entity;

class FilterCategory
{
    private ?Category $category = null;
    private ?string $active;
    private ?string $query;

    /**
     * Get the value of query
     */ 
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the value of query
     *
     * @return  self
     */ 
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the value of close
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of close
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
