alter TABLE Users
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userWho NVARCHAR(100),
    userWhere NVARCHAR(100),
    DateCreated DATETIME NOT NULL
);
CREATE UNIQUE INDEX Users_id_uindex ON Users (id);


CREATE TABLE Posts
(
    userId int not null,
    id INT PRIMARY KEY not null AUTO_INCREMENT,
    Title NVARCHAR(50) NOT NULL,
    Content NVARCHAR(1000) NOT NULL,
    DateCreated DATETIME NOT NULL
);
CREATE UNIQUE INDEX Posts_id_uindex ON Posts (id)
  
CREATE TABLE Comments
(
    postId int not null,
    userId int not null,
    id INT PRIMARY KEY not null AUTO_INCREMENT,
    Content NVARCHAR(1000) NOT NULL,
    DateCreated DATETIME NOT NULL
);
CREATE UNIQUE INDEX Comments_id_uindex ON Comments (id)
  