# Tree
CREATE TABLE users_binary (
        id INT  PRIMARY KEY,
        tag VARCHAR(255),
        parent INT(100),
        `left` INT(100),
        `right` INT(100),
        position VARCHAR(255),
        directowner INT,
        value INT
    )

# Insert 

INSERT INTO users_binary (tag, parent, `left`, `right`, position, value)
                     VALUES ('root', NULL, 2, 3, 'root', 500)



INSERT INTO users_binary (tag, parent, `left`, `right`, position, value)
                     VALUES ('user2', 1, null, null, 'left', 500)


INSERT INTO users_binary (tag, parent, `left`, `right`, position, value)
                     VALUES ('user3', 1, null, null, 'right', 500)