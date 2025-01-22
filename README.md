# WP-exam
University Timetable Management System Report
1. Introduction

The University Timetable Management System is a web-based application designed to streamline the management of academic schedules for students and administrators. The system provides an intuitive platform for creating, editing, and managing timetables while ensuring a user-friendly experience.
This project was undertaken to replace traditional manual or semi-digital systems that are often inefficient and prone to errors. The platform integrates modern web technologies and ensures accessibility and ease of use for its intended audience.
2. Project Objectives

The main objectives of the project include:
Streamlining Schedule Management:
Provide a centralized platform for creating and managing academic timetables.
Enable real-time updates to ensure the accuracy of schedules.
Enhancing Accessibility:
Develop a responsive and user-friendly interface accessible from both desktop and mobile devices.
Role-Based Access:
Implement role-based access control to ensure secure and efficient management of schedules by administrators.
Efficiency and Automation:
Automate key processes such as filtering schedules by courses and ensuring real-time access to updated timetables.
3. Technologies Used

Frontend
HTML5 and CSS3:
Used for structuring and styling the website.
Bootstrap 5:
Provided a responsive and modern design for the interface.
FontAwesome Icons:
Used for adding intuitive and visually appealing icons across the platform.
Backend
PHP:
Used for server-side logic, handling form submissions, and database interactions.
MySQL:
A relational database system used to store and manage course schedules and related data.
Additional Tools
XAMPP:
A local server environment used for development and testing.
Session Management:
Implemented using PHP sessions to ensure secure role-based access.
4. Features Implemented

Admin Dashboard
Add Schedules:
Administrators can add new schedules with details such as course name, room, lecturer, date, and time.
Edit Schedules:
The system allows updating existing schedules.
Delete Schedules:
Unnecessary or outdated schedules can be removed.
Filtering:
Schedules can be filtered by courses for better management.
User Timetable Page
View Schedules:
Students can view schedules based on their course and year.
Dynamic Filtering:
Users can filter schedules by academic years (e.g., First Year, Second Year).
Responsive Design:
The timetable is accessible across all devices.
5. Database

Structure
The database consists of the following tables:
Users Table:
Stores information about users, including roles (e.g., admin).
Fields: id, username, password, role.
Courses Table:
Contains course details, such as course names and IDs.
Fields: id, name.
Schedules Table:
Stores the main timetable data.
Fields:
id: Unique identifier.
course_id: Links to the course.
name: Course name.
room: Room number.
lecturer: Lecturer name.
date: Scheduled date.
time: Scheduled time.
Sample Data
ID Course Name Room Lecturer Date Time Course
1 Web Programming Room 102 Armando Ruggeri 2025-01-24 13:00:00 Course 1
2 Physics Room 103 Andrea Mandanici 2025-01-15 15:00:00 Course 1
6. Conclusion

The University Timetable Management System successfully fulfills its objectives of providing a modern, efficient, and secure platform for managing academic schedules. The system offers seamless interaction for both administrators and students, with key features such as role-based access control, dynamic filtering, and responsive design.
Future Enhancements
Calendar Integration:
Sync schedules with external calendar systems like Google Calendar.
Notifications:
Implement email or SMS notifications for schedule updates.
Multilingual Support:
Provide support for multiple languages to cater to a diverse user base.
