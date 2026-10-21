# Ini adalah tabel database yang akan di gunakan di projek ini 

## users;
+------------+--------------+------+-----+-------------------+-------------------+
| Field      | Type         | Null | Key | Default           | Extra             |
+------------+--------------+------+-----+-------------------+-------------------+
| id         | int unsigned | NO   | PRI | NULL              | auto_increment    |
| name       | varchar(100) | NO   |     | NULL              |                   |
| username   | varchar(50)  | NO   | UNI | NULL              |                   |
| password   | varchar(255) | NO   |     | NULL              |                   |
| created_at | timestamp    | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
+------------+--------------+------+-----+-------------------+-------------------+
5 rows in set (0.04 sec)

## transactions;
+------------------+-------------------------------------------+------+-----+-------------------+-----------------------------------------------+
| Field            | Type                                      | Null | Key | Default           | Extra                                         |
+------------------+-------------------------------------------+------+-----+-------------------+-----------------------------------------------+
| id               | int unsigned                              | NO   | PRI | NULL              | auto_increment                                |
| transaction_code | varchar(30)                               | NO   | UNI | NULL              |                                               |
| donor_name       | varchar(100)                              | NO   |     | NULL              |                                               |
| donor_email      | varchar(100)                              | NO   |     | NULL              |                                               |
| donor_phone      | varchar(20)                               | NO   |     | NULL              |                                               |
| type             | enum('zakat','infak','shodaqoh','fidyah') | NO   |     | NULL              |                                               |
| zakat_type       | varchar(50)                               | YES  |     | NULL              |                                               |
| campaign_id      | int unsigned                              | YES  | MUL | NULL              |                                               |
| amount           | decimal(15,2)                             | NO   |     | NULL              |                                               |
| payment_method   | varchar(50)                               | NO   |     | NULL              |                                               |
| status           | enum('pending','success')                 | NO   |     | pending           |                                               |
| notes            | text                                      | YES  |     | NULL              |                                               |
| created_at       | timestamp                                 | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| updated_at       | timestamp                                 | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
| email_sent       | tinyint(1)                                | NO   |     | 0                 |                                               |
+------------------+-------------------------------------------+------+-----+-------------------+-----------------------------------------------+
15 rows in set (0.00 sec)

## campaigns;
+---------------+-------------------------------------+------+-----+-------------------+-----------------------------------------------+
| Field         | Type                                | Null | Key | Default           | Extra                                         |
+---------------+-------------------------------------+------+-----+-------------------+-----------------------------------------------+
| id            | int unsigned                        | NO   | PRI | NULL              | auto_increment                                |
| title         | varchar(150)                        | NO   |     | NULL              |                                               |
| category      | varchar(50)                         | NO   |     | umum              |                                               |
| description   | text                                | NO   |     | NULL              |                                               |
| target_amount | decimal(15,2)                       | NO   |     | NULL              |                                               |
| status        | enum('active','completed','closed') | NO   |     | active            |                                               |
| created_at    | timestamp                           | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED                             |
| updated_at    | timestamp                           | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED on update CURRENT_TIMESTAMP |
+---------------+-------------------------------------+------+-----+-------------------+-----------------------------------------------+
8 rows in set (0.00 sec)

## campaign_images;;
+-------------+--------------+------+-----+-------------------+-------------------+
| Field       | Type         | Null | Key | Default           | Extra             |
+-------------+--------------+------+-----+-------------------+-------------------+
| id          | int unsigned | NO   | PRI | NULL              | auto_increment    |
| campaign_id | int unsigned | NO   | MUL | NULL              |                   |
| image       | varchar(255) | NO   |     | NULL              |                   |
| created_at  | timestamp    | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
+-------------+--------------+------+-----+-------------------+-------------------+
4 rows in set (0.00 sec)