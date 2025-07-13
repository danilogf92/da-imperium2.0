<?php

namespace App\Enums;

enum ClassificationOfInvestments: string
{
    case BUILDINGS = 'Buildings';
    case FURNITURE = 'Furniture';
    case GENERAL_INSTALL = 'General Install';
    case LAND = 'Land';
    case MACHINES_EQUIPM = 'Machines & Equipm';
    case OFFICE_HARDWARE_SOFTWARE = 'Office Hardware Software';
    case OTHER = 'Other';
    case VEHICLES = 'Vehicles';
    case VESSEL_FISHING_EQUIPMENT = 'Vessel & Fishing Equipment';
    case WARENHOUSE_DISTRIB = 'Warenhouse & Distrib';
}
