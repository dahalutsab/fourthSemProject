CREATE TABLE roles (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(100) NOT NULL,
                       description TEXT
);
INSERT INTO roles (name, description) VALUES
                                          ('Admin', 'Administrator role with full access to the system'),
                                          ('Artist', 'Role for artists'),
                                          ('Singer', 'Role for singers');


CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       role_id INT NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                       FOREIGN KEY (role_id) REFERENCES roles(id)
);
INSERT INTO users (username, email, password, role_id) VALUES
    ('admin_user', 'admin@example.com', 'hashed_password_here', 1);



CREATE TABLE categories (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            description TEXT
);

INSERT INTO categories (name, description) VALUES
                                               ('Singers', 'Category for singers and vocalists.'),
                                               ('Standup Comedians', 'Category for standup comedians.'),
                                               ('Storytellers', 'Category for storytellers.'),
                                               ('Poetry Slammers', 'Category for poetry slammers.');

CREATE TABLE user_details (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              full_name VARCHAR(255) NOT NULL,
                              stage_name VARCHAR(255) NOT NULL,
                              phone VARCHAR(20) NOT NULL,
                              address VARCHAR(255) NOT NULL,
                              category_id INT NOT NULL,
                              bio TEXT,
                              description TEXT,
                              profile_picture VARCHAR(255),
                              social_media JSON,
                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              FOREIGN KEY (category_id) REFERENCES categories(id)
);


