<?php

namespace App\Patterns\Repositories;

use App\Http\Resources\Tasks\TaskResource;
use App\Models\Task;

/**
 * Class UserRepository.
 *
 * @package namespace App\Repositories;
 */
class TaskRepository extends BaseRepository
{
    function __construct()
    {
        $this->makeModel();
        $this->skipPresenter(false);
        $this->setPresenter(TaskResource::class);
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }
}
