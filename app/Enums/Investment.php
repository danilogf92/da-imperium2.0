<?php

namespace App\Enums;

enum Investment: string
{
    case INNOVATION = 'Innovation';
    case EFFICIENCY_SAVING = 'Efficiency & Saving';
    case REPLACEMENT_RESTRUCTURING = 'Replacement & Restructuring';
    case QUALITY_HYGIENE = 'Quality & Hygiene';
    case HEALTH_SAFETY = 'Health & Safety';
    case ENVIRONMENT = 'Environment';
    case MAINTENANCE = 'Maintenance';
    case CAPACITY_INCREASE = 'Capacity Increase';
}
