<?php

namespace App\Actions\Task;

final class CreateTaskWithRelationResponse
{
    private $taskId;

    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }

    public function getRecordId(): string
    {
        return $this->taskId;
    }
}
