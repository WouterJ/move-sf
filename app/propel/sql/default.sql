
-----------------------------------------------------------------------
-- cars
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cars];

CREATE TABLE [cars]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [type] VARCHAR(100),
    [price] DECIMAL,
    [description] MEDIUMTEXT
);

-----------------------------------------------------------------------
-- reviews
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [reviews];

CREATE TABLE [reviews]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [author] VARCHAR(100),
    [content] MEDIUMTEXT,
    [created_at] TIMESTAMP
);
