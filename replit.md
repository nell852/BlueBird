# Blue Bird Express - Replit Migration

## Project Overview
Blue Bird Express is a PHP-based MVC application for managing a transportation/bus company. The application handles:
- Client authentication and registration
- Vehicle management
- Trip/voyage booking and reservations
- Payment processing
- GPS tracking
- Maintenance scheduling

## Recent Changes (2025-11-18)
- Migrated from Vercel to Replit
- Removed incorrect Next.js package.json (this is a pure PHP application)
- Converted SQL Server database schema to MySQL
- Updated Database.php to use PDO with MySQL and environment variables
- Created router.php for clean URLs with PHP built-in server
- Configured workflow to run on port 5000 with proper host binding

## Project Architecture
### Backend (PHP MVC)
- **Entry Point**: `index.php` - Main router handling all requests
- **Controllers**: Handle business logic
  - AuthController: User authentication
  - ClientController: Client management
  - ReservationController: Booking management
  - VehiculeController: Vehicle management
  - VoyageController: Trip management
- **Models**: Database interaction layer
  - BaseModel: Shared database functionality
  - ChauffeurModel, ClientModel, ReservationModel, VehiculeModel, VilleModel, VoyageModel
- **Views**: PHP templates organized by user type (admin/client)
- **Config**: Database connection singleton pattern

### Database
- MySQL database with schema in `database/bluebird_express_mysql.sql`
- Tables: Ville, Agence, Employe, Chauffeur, Mecanicien, Vehicule, Voyage, Client, Reservation, Colis, Paiement, Panne, Maintenance, Partenaire, Suivi_GPS

### Environment Variables Required
- `DB_HOST`: Database host (default: localhost)
- `DB_PORT`: Database port (default: 3306)
- `DB_NAME`: Database name (default: bluebird_express)
- `DB_USER`: Database username
- `DB_PASSWORD`: Database password

## Running the Application
1. Set up environment variables (copy `.env.example` to `.env` and configure)
2. Import the MySQL schema: `database/bluebird_express_mysql.sql`
3. The workflow "PHP Server" runs the application on port 5000
4. Access via the webview

## Security Notes
- Database credentials are managed via environment variables
- Passwords should be hashed (verify implementation in AuthController)
- Client/server separation maintained through MVC pattern
