/**
 * Leaflet Map Integration for Blue Bird Express
 * Suivi GPS des véhicules en temps réel
 */

class BustrackingMap {
    constructor(mapId, center = [14.7167, -17.4677]) {
        this.mapId = mapId;
        this.center = center; // Dakar, Sénégal par défaut
        this.zoom = 13;
        this.map = null;
        this.markers = [];
        this.routes = [];
        
        this.init();
    }
    
    init() {
        // Initialiser la carte Leaflet
        this.map = L.map(this.mapId).setView(this.center, this.zoom);
        
        // Ajouter le tile layer OpenStreetMap (gratuit!)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(this.map);
    }
    
    addBusMarker(lat, lng, busInfo) {
        const busIcon = L.divIcon({
            className: 'custom-bus-marker',
            html: `<div class="bus-marker">
                <span class="bus-icon">🚌</span>
                <span class="bus-label">${busInfo.numero || ''}</span>
            </div>`,
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });
        
        const marker = L.marker([lat, lng], { icon: busIcon }).addTo(this.map);
        
        marker.bindPopup(`
            <div class="map-popup">
                <h3>🚌 ${busInfo.immatriculation}</h3>
                <p><strong>Marque:</strong> ${busInfo.marque} ${busInfo.modele || ''}</p>
                <p><strong>Sièges:</strong> ${busInfo.nombre_sieges}</p>
                <p><strong>Statut:</strong> <span class="badge badge-${busInfo.statut === 'disponible' ? 'success' : 'warning'}">${busInfo.statut}</span></p>
            </div>
        `);
        
        this.markers.push(marker);
        return marker;
    }
    
    addRoute(points, routeInfo) {
        const route = L.polyline(points, {
            color: '#667eea',
            weight: 4,
            opacity: 0.8,
            smoothFactor: 1
        }).addTo(this.map);
        
        route.bindPopup(`
            <div class="map-popup">
                <h3>📍 Itinéraire</h3>
                <p><strong>De:</strong> ${routeInfo.depart}</p>
                <p><strong>Vers:</strong> ${routeInfo.arrivee}</p>
                <p><strong>Distance:</strong> ${routeInfo.distance || 'N/A'}</p>
            </div>
        `);
        
        this.routes.push(route);
        
        // Ajuster la vue pour inclure tout l'itinéraire
        this.map.fitBounds(route.getBounds());
        
        return route;
    }
    
    addCityMarker(lat, lng, cityName) {
        const cityIcon = L.divIcon({
            className: 'custom-city-marker',
            html: `<div class="city-marker">
                <span class="city-icon">📍</span>
                <span class="city-label">${cityName}</span>
            </div>`,
            iconSize: [80, 30],
            iconAnchor: [40, 30]
        });
        
        const marker = L.marker([lat, lng], { icon: cityIcon }).addTo(this.map);
        marker.bindPopup(`<strong>${cityName}</strong>`);
        
        return marker;
    }
    
    clearMarkers() {
        this.markers.forEach(marker => this.map.removeLayer(marker));
        this.markers = [];
    }
    
    clearRoutes() {
        this.routes.forEach(route => this.map.removeLayer(route));
        this.routes = [];
    }
    
    centerOn(lat, lng, zoom = 15) {
        this.map.setView([lat, lng], zoom);
    }
}

// Coordonnées des villes sénégalaises principales
const SENEGAL_CITIES = {
    'Dakar': [14.7167, -17.4677],
    'Thiès': [14.7886, -16.9260],
    'Kaolack': [14.1500, -16.0833],
    'Tambacounda': [13.7667, -13.6667],
    'Ziguinchor': [12.5833, -16.2667],
    'Saint-Louis': [16.0333, -16.5000],
    'Diourbel': [14.6500, -16.2333],
    'Louga': [15.6167, -16.2167],
    'Matam': [15.6556, -13.2556],
    'Kolda': [12.8833, -14.9500]
};

// Fonction helper pour obtenir les coordonnées d'une ville
function getCityCoordinates(cityName) {
    return SENEGAL_CITIES[cityName] || [14.7167, -17.4677];
}
