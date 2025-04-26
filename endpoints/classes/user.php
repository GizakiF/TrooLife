<?php



class User
{
    private int $userId;
    private string $firstName;

    public function __construct(int $userId, string $firstName)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        //TODO: add the other attributes here
    }

    public static function createTable(mysqli $conn): void
    {
        $stmt = "
          CREATE TABLE Users (
            user_id int PRIMARY KEY,
            first_name varchar(255),
            last_name varchar(255),
            username varchar(255) UNIQUE NOT NULL,
            email varchar(255) UNIQUE NOT NULL,
            password varchar(255) NOT NULL,
            date_of_birth DATE,
            gender ENUM('male', 'female', 'undisclosed'),
            profile_image_path varchar(255),
            date_created TIMESTAMP,
            is_active boolean,
            last_login DATETIME,
            role_id int
          );
        ";
        mysqli_query($conn, $stmt);
    }
}
