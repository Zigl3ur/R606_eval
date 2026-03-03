  <?php
    try {
        $p = new PDO("mysql:host=localhost;dbname=ma_bdd;charset=utf8mb4", 'db_user', 'db_pwd');

        $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
        exit();
    }

    try {
        $d = $p->query("SELECT id,text FROM db_table")->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $p->prepare('CREATE TABLE IF NOT EXISTS db_table (id INT PRIMARY KEY AUTO_INCREMENT, text VARCHAR(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4')->execute();
        $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'azerty']);
        $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'abcdef']);
        $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => 'xyz']);
        $p->prepare('INSERT INTO db_table (text) VALUES (:text)')->execute([':text' => '123456789']);
        $d = $p->query('SELECT id,text FROM db_table')->fetchAll(PDO::FETCH_ASSOC);
    }
