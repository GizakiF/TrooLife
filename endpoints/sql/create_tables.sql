CREATE TABLE Users (
  user_id INT PRIMARY KEY,
  first_name VARCHAR(255),
  last_name varchar(255),
  username varchar(255) UNIQUE NOT NULL,
  email varchar(255) UNIQUE NOT NULL,
  date_of_birth DATE,
  gender ENUM('male', 'female', 'undisclosed'),
  profile_image_path varchar(255),
  date_created TIMESTAMP,
  is_active boolean,
  last_login DATETIME,
  role_id int
);

