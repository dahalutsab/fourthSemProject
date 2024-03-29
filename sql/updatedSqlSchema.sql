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
                       full_name VARCHAR(255) NOT NULL,
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
                                               ('StandUp Comedians', 'Category for standUp comedians.'),
                                               ('Storytellers', 'Category for storytellers.'),
                                               ('Poetry Slammers', 'Category for poetry slammers.');

CREATE TABLE artist_details (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              user_id INT NOT NULL,
                              stage_name VARCHAR(255) NOT NULL,
                              phone VARCHAR(20) NOT NULL,
                              address VARCHAR(255) NOT NULL,
                              category_id INT NOT NULL,
                              bio TEXT,
                              description TEXT,
                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              FOREIGN KEY (user_id) REFERENCES users(id),
                              FOREIGN KEY (category_id) REFERENCES categories(id)
);





--
    -- Table structure for table `Comments and Replies`
--
-- Create the comments table
CREATE TABLE comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          user_id INT NOT NULL,
                          artist_id INT NOT NULL,
                          content TEXT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                          FOREIGN KEY (user_id) REFERENCES users(id),
                          FOREIGN KEY (artist_id) REFERENCES artists(id)
);

-- Create the replies table
CREATE TABLE replies (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         comment_id INT NOT NULL,
                         user_id INT NOT NULL,
                         content TEXT NOT NULL,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         FOREIGN KEY (comment_id) REFERENCES comments(id),
                         FOREIGN KEY (user_id) REFERENCES users(id)
);

# query to get comments and replies
SELECT
    c.id AS comment_id,
    c.content AS comment_content,
    c.created_at AS comment_created_at,
    u.name AS comment_author_name,
    a.name AS artist_name,
    r.id AS reply_id,
    r.content AS reply_content,
    r.created_at AS reply_created_at,
    ru.name AS reply_author_name
FROM
    comments c
        JOIN
    users u ON c.user_id = u.id
        JOIN
    artists a ON c.artist_id = a.id
        LEFT JOIN
    replies r ON c.id = r.comment_id
        LEFT JOIN
    users ru ON r.user_id = ru.id
WHERE
                c.artist_id = <artist_id>
ORDER BY
    c.created_at DESC,
    r.created_at ASC;