<?php

namespace App\Enums;

enum UserType: string
{
    case SUPERADMIN = 'Super Admin';
    case EMPLOYEE = 'Employee';
    case CLIENT = 'Client';
    case MANAGER = 'Manager';
    case ACCOUNTANT = 'Accountant';
    case HR = 'HR';
}
