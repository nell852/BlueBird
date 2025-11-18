<?php
/**
 * Vue: Suivi GPS en temps réel des véhicules
 */
?>

<div class="card">
    <div class="card-header">
        <h2>📍 Suivi GPS des Véhicules</h2>
        <button class="btn btn-primary btn-small" onclick="refreshMap()">🔄 Actualiser</button>
    </div>
    <div class="card-body">
        <!-- Carte Leaflet -->
        <div id="map" style="height: 600px; border-radius: 12px; overflow: hidden;"></div>
        
        <div style="margin-top: 24px;">
            <h3 style="margin-bottom: 16px;">Légende</h3>
            <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">🚌</span>
                    <span>Véhicules en service</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">📍</span>
                    <span>Villes desservies</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 30px; height: 4px; background: #667eea;"></div>
                    <span>Itinéraires</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stats-grid" style="margin-top: 24px;">
    <div class="stat-card">
        <h3>Véhicules Actifs</h3>
        <div class="value">12</div>
        <div class="change positive">
            ↑ 3 depuis hier
        </div>
    </div>
    
    <div class="stat-card">
        <h3>Voyages en Cours</h3>
        <div class="value">8</div>
        <div class="change positive">
            ↑ 2 aujourd'hui
        </div>
    </div>
    
    <div class="stat-card">
        <h3>Distance Parcourue</h3>
        <div class="value">1,245 km</div>
        <div class="change">
            Aujourd'hui
        </div>
    </div>
    
    <div class="stat-card">
        <h3>Villes Connectées</h3>
        <div class="value">10</div>
        <div class="change">
            Réseau complet
        </div>
    </div>
</div>

<script>
// Initialisation de la carte
let trackingMap;

document.addEventListener('DOMContentLoaded', function() {
    // Créer la carte centrée sur Dakar
    trackingMap = new BustrackingMap('map', [14.7167, -17.4677]);
    
    // Ajouter les principales villes du Sénégal
    const cities = [
        { name: 'Dakar', lat: 14.7167, lng: -17.4677 },
        { name: 'Thiès', lat: 14.7886, lng: -16.9260 },
        { name: 'Kaolack', lat: 14.1500, lng: -16.0833 },
        { name: 'Tambacounda', lat: 13.7667, lng: -13.6667 },
        { name: 'Ziguinchor', lat: 12.5833, lng: -16.2667 }
    ];
    
    cities.forEach(city => {
        trackingMap.addCityMarker(city.lat, city.lng, city.name);
    });
    
    // Exemple d'itinéraires
    const routes = [
        {
            points: [[14.7167, -17.4677], [14.7886, -16.9260]],
            info: { depart: 'Dakar', arrivee: 'Thiès', distance: '70 km' }
        },
        {
            points: [[14.7886, -16.9260], [14.1500, -16.0833]],
            info: { depart: 'Thiès', arrivee: 'Kaolack', distance: '120 km' }
        }
    ];
    
    routes.forEach(route => {
        trackingMap.addRoute(route.points, route.info);
    });
    
    // Exemple de bus en mouvement
    const buses = [
        {
            lat: 14.75,
            lng: -17.35,
            info: {
                immatriculation: 'DK-1234-AB',
                marque: 'Mercedes',
                modele: 'Sprinter',
                nombre_sieges: 45,
                statut: 'en_voyage'
            }
        },
        {
            lat: 14.65,
            lng: -17.00,
            info: {
                immatriculation: 'DK-5678-CD',
                marque: 'Volvo',
                modele: 'B11R',
                nombre_sieges: 52,
                statut: 'disponible'
            }
        }
    ];
    
    buses.forEach(bus => {
        trackingMap.addBusMarker(bus.lat, bus.lng, bus.info);
    });
});

function refreshMap() {
    // Simulation de rafraîchissement
    if (trackingMap) {
        trackingMap.clearMarkers();
        
        // Simuler des positions aléatoires autour de Dakar
        const randomBuses = Array.from({length: 5}, (_, i) => ({
            lat: 14.7167 + (Math.random() - 0.5) * 0.5,
            lng: -17.4677 + (Math.random() - 0.5) * 0.5,
            info: {
                immatriculation: `DK-${1000 + i}-XX`,
                marque: ['Mercedes', 'Volvo', 'Scania'][Math.floor(Math.random() * 3)],
                modele: 'Bus',
                nombre_sieges: 40 + Math.floor(Math.random() * 20),
                statut: Math.random() > 0.5 ? 'en_voyage' : 'disponible'
            }
        }));
        
        randomBuses.forEach(bus => {
            trackingMap.addBusMarker(bus.lat, bus.lng, bus.info);
        });
        
        // Notification
        alert('🔄 Carte mise à jour avec les dernières positions GPS!');
    }
}
</script>
