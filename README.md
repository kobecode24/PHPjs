# PHProject

## Overview
PHProject is a dynamic web application developed in PHP, showcasing a robust MVC architecture. This project includes key features such as user authentication, film management, and a sleek user interface.

## Features
- **User Authentication**: Secure login and sign-up functionalities.
- **Film Management**: Admin interface for managing film-related data.
- **Responsive Design**: A user-friendly interface with a responsive design.

## Directory Structure
- `controller/`: Contains controller files like `FilmController.php`, handling the business logic.
- `models/`: Model files (empty in the current structure, potentially for future database interactions).
- `views/`: View files like `filmsView.php`, `login.php`, handling the user interface.
- `public/`: Public assets including CSS (`dashboard.css`, `style.css`) and JavaScript (`main.js`).

## Getting Started

### Prerequisites
- PHP environment.
- MySQL (for database interactions).

### Installation
1. Clone the repository to your local machine.
2. Navigate to the project directory and install dependencies:
   ```
   composer install
   ```
3. Set up your `.env` file with appropriate database configurations.
4. Import the SQL schema located in the `sql/` directory to your database.
5. Run the application using a local server.

## Usage
Navigate to `index.php` to start the application. The application includes features for user login, sign-up, and film management (admin role).

## Contributing
Contributions to PHProject are welcome. Please ensure to update tests as appropriate.

## Authors
- Kobe - Initial work

## License
This project is licensed under the [MIT License](LICENSE.md).
