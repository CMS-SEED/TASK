<?php

namespace Cms_Framework_Seed\Task\Repositories\Eloquent;

use Cms_Framework_Seed\Task\Interfaces\TaskRepositoryInterface;
use Cms_Framework_Seed\Repository\Eloquent\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
       
        
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('task.task.search');
        return config('task.task.model');
    }


    
}
