<?php

namespace App\Enums;

enum State: string
{
    case PLANIFICATION = 'Planification';
    case EXECUTION = 'Execution';
    case FINISHED = 'Finished';
}
