-- Create Table  --

-- Create Departments Table
CREATE TABLE departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) UNIQUE NOT NULL
);

-- Create Faculty Table
CREATE TABLE faculty (
    faculty_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    department_id INT NOT NULL,
    FOREIGN KEY (department_id) REFERENCES departments(department_id) ON DELETE CASCADE
);

-- Create Students Table
CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

-- Create Courses Table
CREATE TABLE courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_code VARCHAR(20) UNIQUE NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    faculty_id INT NOT NULL,
    department_id INT NOT NULL,
    FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES departments(department_id) ON DELETE CASCADE
);

-- Create Enrollments Table
CREATE TABLE enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE NOT NULL DEFAULT (CURRENT_DATE),
    grade VARCHAR(5) DEFAULT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    UNIQUE (student_id, course_id)  -- Prevent duplicate enrollments
);


-- Insert Data -- 

-- Insert Data into Departments
INSERT INTO departments (department_name) VALUES 
('Computer Science'),
('Mathematics'),
('Physics');

-- Insert Data into Faculty
INSERT INTO faculty (first_name, last_name, email, department_id) VALUES 
('John', 'Doe', 'johndoe@example.com', 1),  
('Jane', 'Smith', 'janesmith@example.com', 2),  
('Robert', 'Brown', 'robertbrown@example.com', 3);

-- Insert Data into Students
INSERT INTO students (first_name, last_name, date_of_birth, email) VALUES  
('Alice', 'Johnson', '2001-06-15', 'alice@example.com'),  
('Bob', 'Williams', '2002-09-22', 'bob@example.com'),  
('Charlie', 'Davis', '2000-12-03', 'charlie@example.com');

-- Insert Data into Courses
INSERT INTO courses (course_code, course_name, faculty_id, department_id) VALUES  
('CS101', 'Introduction to Programming', 1, 1),  
('MATH201', 'Calculus I', 2, 2),  
('PHYS301', 'Classical Mechanics', 3, 3);

-- Insert Data into Enrollments
INSERT INTO enrollments (student_id, course_id, enrollment_date, grade) VALUES  
(1, 1, '2024-03-28', 'A'),  
(2, 2, '2024-03-28', 'B+'),  
(3, 3, '2024-03-28', 'A-'),  
(1, 2, '2024-03-28', 'B'),  
(2, 3, '2024-03-28', 'A');

-- Verify Data

SELECT * FROM departments;
SELECT * FROM faculty;
SELECT * FROM students;
SELECT * FROM courses;
SELECT * FROM enrollments;
