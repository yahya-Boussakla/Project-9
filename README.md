# User Management System (PHP + JSON)  

## Description  
This is a simple user management system built with PHP. It includes authentication (login and register), a user profile page, and an admin dashboard where administrators can view all registered users. User data is stored in a JSON file instead of a traditional database.  

## Technologies Used  
- **Backend**: PHP (Sessions, File Handling)  
- **Frontend**: HTML, CSS  
- **Data Storage**: JSON File  

## Features  
### 🔐 Authentication  
- User registration with name, email, username, and password  
- Secure login system using PHP sessions  
- Logout functionality  

### 👤 User Dashboard  
- View personal profile information (name, email, birthday, signup date)  
- Logout option  

### 🛠️ Admin Dashboard  
- View a list of all registered users  
- Display user details such as name, email, and last login time  

## Installation  
1. **Clone the repository**  
   ```sh
   git clone https://github.com/your-profile/user-management-json.git
   ```  
2. **Start a local server** (Apache with PHP enabled)  
   ```sh
   php -S localhost:8000
   ```  
3. **Access the project** in your browser  
   ```
   http://localhost:8000
   ```  
