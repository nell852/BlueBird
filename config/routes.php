<?php
/**
 * Configuration centralisée des routes
 * Une seule source de vérité pour tous les mappings URL
 */

return [
    // Routes Client
    '/' => ['action' => 'client', 'subaction' => 'login'],
    '/client/login' => ['action' => 'client', 'subaction' => 'login'],
    '/client/register' => ['action' => 'client', 'subaction' => 'register'],
    '/client/voyages' => ['action' => 'client', 'subaction' => 'voyages'],
    '/client/reservations' => ['action' => 'client', 'subaction' => 'reservations'],
    
    // Routes avec paramètres - patterns regex
    '/client/reservation/confirm/{id}' => ['action' => 'client', 'subaction' => 'reservation-confirm'],
    '/client/reservation/create' => ['action' => 'client', 'subaction' => 'reservation-create'],
    '/client/reservation/cancel/{id}' => ['action' => 'client', 'subaction' => 'reservation-cancel'],
    
    // Route Logout
    '/logout' => ['action' => 'logout'],
    
    // Routes Admin
    '/admin' => ['action' => 'admin', 'subaction' => 'dashboard'],
    '/admin/dashboard' => ['action' => 'admin', 'subaction' => 'dashboard'],
    
    // Routes Admin - Clients
    '/admin/clients' => ['action' => 'admin', 'subaction' => 'clients'],
    '/admin/client/add' => ['action' => 'admin', 'subaction' => 'client-add'],
    '/admin/client/create' => ['action' => 'admin', 'subaction' => 'client-create'],
    '/admin/client/edit/{id}' => ['action' => 'admin', 'subaction' => 'client-edit'],
    '/admin/client/update/{id}' => ['action' => 'admin', 'subaction' => 'client-update'],
    '/admin/client/delete/{id}' => ['action' => 'admin', 'subaction' => 'client-delete'],
    
    // Routes Admin - Véhicules
    '/admin/vehicules' => ['action' => 'admin', 'subaction' => 'vehicules'],
    '/admin/vehicule/add' => ['action' => 'admin', 'subaction' => 'vehicule-add'],
    '/admin/vehicule/create' => ['action' => 'admin', 'subaction' => 'vehicule-create'],
    '/admin/vehicule/edit/{id}' => ['action' => 'admin', 'subaction' => 'vehicule-edit'],
    '/admin/vehicule/update/{id}' => ['action' => 'admin', 'subaction' => 'vehicule-update'],
    '/admin/vehicule/delete/{id}' => ['action' => 'admin', 'subaction' => 'vehicule-delete'],
    
    // Routes Admin - Voyages
    '/admin/voyages' => ['action' => 'admin', 'subaction' => 'voyages'],
    '/admin/voyage/add' => ['action' => 'admin', 'subaction' => 'voyage-add'],
    '/admin/voyage/create' => ['action' => 'admin', 'subaction' => 'voyage-create'],
    '/admin/voyage/delete/{id}' => ['action' => 'admin', 'subaction' => 'voyage-delete'],
    
    // Routes Admin - Réservations
    '/admin/reservations' => ['action' => 'admin', 'subaction' => 'reservations'],
];
