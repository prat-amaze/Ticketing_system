# Task Management Portal - README
This project is a Task Management Portal that allows users to create, view, and manage tasks and tickets. It includes functionalities for user registration, login, forgot password, task creation, and ticket management.

**Table of Contents**

Features

Setup

Usage

File Structure

Dependencies

Authors

License


**Features**

Login Page (index.php):

Users can log in using their registered email address and password.

Users who forgot their password can click on "Forgot password" and enter their email address to receive an OTP for password reset.


**Verification Page (verification.php):**

Users can enter their email address and verify their identity using the OTP sent to their email for password reset.

Upon successful verification, a pop-up will display the user's password.


**Signup Page (signup.php):**

New users can register by providing their general details like name, email address, etc.

The interface prompts the user if the email address or name is already in use by another user.


**Home Page (home.php):**

Each user has a unique dashboard displaying their 5 most recent tasks with relevant details.

Users can log out by clicking on the "Log Out" button.

Users can create new tickets, view all their tasks, and view all their tickets from this page.


**Create Ticket Page (create.php):**

Users can create a new ticket by providing a title, description, assigned user, due date, and an optional reference file.

Upon creating a ticket, an email notification is sent to the assigned user.


**Tasks Page (tasks.php):**

Users can view all the tasks assigned to them, sorted with the latest task displayed first.

A search option is available for users to find specific tickets.


**Tickets Page (tickets.php):**

Users can view all the tickets they have created, with the latest ticket displayed first.


**View Ticket Page (view.php):**

Users can view the details of a specific ticket.

Users can change the status of the ticket by clicking on the appropriate buttons.

Users can leave comments and discuss the progress and queries related to the ticket.


**Note:**

Create a folder named "uploads" in the same directory as the project files. This folder will be used to upload files when creating tickets.

Set up a MySQL database and update the database credentials in the connect_mysql function located in functions.php.

Ensure that the necessary dependencies (described in the next section) are installed.

**Usage**

Open the "index.php" page in your web browser to access the login page.

Existing users can log in using their email address and password.

New users can click on the "Sign Up" button on the login page to register.

Users who forgot their password can click on "Forgot password" and follow the steps to reset their password.

After logging in, users will be redirected to the "home.php" page displaying their dashboard.

From the dashboard, users can create new tickets, view their tasks, and view their tickets.

Users can navigate to different pages using the navigation bar located at the top of each page.

**File Structure**

index.php: Login page for existing users.

verification.php: Page for verifying the email address for password reset.

signup.php: Registration page for new users.

home.php: Dashboard displaying the user's recent tasks and navigation options.

create.php: Page for creating new tickets.

tasks.php: Page displaying all tasks assigned to the user.

tickets.php: Page displaying all tickets created by the user.

view.php: Page for viewing a specific ticket's details and comments.

uploads/: Folder for storing uploaded files for the tickets.

functions.php: Contains the connect_mysql function and template header and footer functions.


**Dependencies**

PHPMailer: For sending email notifications.

Composer: For installing PHPMailer and managing dependencies.


**Authors**

Pratyush Khengle


**License**
MIT License
