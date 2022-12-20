<?php

namespace App\Utils;

enum Constantes
{
    /**
     * Roles utilisateur
     */
    case ROLE_ADMIN;
    case ROLE_USER;
    case ROLE_MANAGER;

    /**
     * Types de transaction
     */
    case REVENU;
    case DEPENSE;
}
