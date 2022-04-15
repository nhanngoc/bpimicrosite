<?php

namespace App\Core\Support;

class PageTitle
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param bool $full
     * @return string
     */
    public function getTitle(bool $full = true)
    {
        if (empty($this->title)) {
            return setting('admin_title', config('core.base_name'));
        }

        if (!$full) {
            return $this->title;
        }

        return $this->title . ' | ' . setting('admin_title', config('core.base_name'));
    }
}
