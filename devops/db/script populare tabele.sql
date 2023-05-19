-- Populare tabelul users
INSERT INTO users (username, password, fname, lname, email) VALUES
('john.doe', '$2y$10$ZYRJ.DJMZ4UcC...', 'John', 'Doe', 'john.doe@example.com'),
('jane.doe', '$2y$10$uJwq3V7vj...', 'Jane', 'Doe', 'jane.doe@example.com'),
('alice', '$2y$10$wJyq7V6lK...', 'Alice', 'Smith', 'alice@example.com'),
('bob', '$2y$10$pKwz1V5mB...', 'Bob', 'Johnson', 'bob@example.com'),
('ana.maria', '$2y$10$tKwz2V5mB...', 'Ana Maria', 'Popescu', 'ana.maria@example.com'),
('daniel.b', '$2y$10$rFZK.DJMZ4UcC...', 'Daniel', 'Balan', 'daniel.b@example.com'),
('cristina.p', '$2y$10$gFZK.DJMZ4UcC...', 'Cristina', 'Popa', 'cristina.p@example.com'),
('alex.m', '$2y$10$hFZK.DJMZ4UcC...', 'Alex', 'Mihai', 'alex.m@example.com');

-- Populare tabelul inmates
INSERT INTO inmates (person_id, sentence_start_date, sentence_duration, sentence_category) VALUES
(4, '2022-01-01', 365, 'Minor Offense'),
(5, '2022-05-01', 365, 'Drug-related offense'),
(6, '2022-03-01', 730, 'Violent crime'),
(7, '2022-04-01', 365, 'White-collar crime'),
(8, '2022-01-01', 1095, 'Sexual assault');

-- Populare tabelul visitors
INSERT INTO visitors (person_id, relationship, inmate_id) VALUES
(1, 'Friend', 1),
(2, 'Step sister', 5),
(2, 'Family', 2),
(3, 'Lawyer', 3),
(3, 'Lawyer', 4),
(3, 'Lawyer', 5);

-- Populare tabelul visits
INSERT INTO visits (visitor_id, inmate_id, visit_date, visit_type, visit_duration, items_provided, discussions, health_status, mood_status) VALUES
(1, 1, '2023-01-01', 'Regular', '1 hour', 'None', 'Catch up', 'Good', 'Happy'),
(2, 5, '2023-01-02', 'Regular', '1 hour', 'None', 'Catch up', 'Good', 'Happy'),
(3, 2, '2023-01-03', 'Legal', '2 hours', 'Legal documents', 'Discuss case', 'Good', 'Serious'),
(3, 4, '2023-05-09', 'Legal', '2 hours', 'Legal documents', 'Discuss case', 'Good', 'Serious');

-- Populare tabelul witnesses
INSERT INTO witnesses (person_id, visit_id) VALUES
(2, 1),
(3, 1),
(2, 2),
(1, 2),
(1, 3),
(3, 4);