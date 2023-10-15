<?php

class Run
{
    private ?PDO $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=mysql-mvc-blog;dbname=db", "root", "local");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function createMigrationTable(): void
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS migrations (
                    id int NOT NULL AUTO_INCREMENT, 
                    migration_name varchar(255),
                    PRIMARY KEY (id));');
    }

    private function isMigrationExecuted($migrationName): bool
    {
        $query = $this->pdo->prepare("SELECT migration_name FROM migrations WHERE migration_name = :migration_name");
        $query->execute(['migration_name' => $migrationName]);
        return $query->rowCount() > 0;
    }

    /**
     * Функция для выполнения миграций
     */
    function runMigrations(): void
    {
        $migrationFolderPath = __DIR__ . '/migrations/';

        $this->createMigrationTable();
        $migrationFiles = scandir($migrationFolderPath);


        foreach ($migrationFiles as $migrationFile) {
            if ($migrationFile == '.' || $migrationFile == '..') {
                continue;
            }

            // Получение имени миграции из имени файла
            $migrationName = pathinfo($migrationFile, PATHINFO_FILENAME);

            // Проверка, не выполнена ли миграция уже
            if ($this->isMigrationExecuted($migrationName)) {
                continue;
            }

            // Если не выполнена, миграция выполняется
            $migrationScript = file_get_contents("$migrationFolderPath/$migrationFile");

            // Выполнение SQL-скрипта $migrationScript на базе данных
            $this->pdo->exec($migrationScript);

            // Запись в базу данных информации о выполненной миграции
            $insertQuery = "INSERT INTO migrations (migration_name) VALUES (:migration_name)";
            $query = $this->pdo->prepare($insertQuery);
            $query->execute([':migration_name' => $migrationName]);

            echo "Миграция $migrationName выполнена успешно \n";
        }
    }

    /**
     * Функция для выполнения seeds
     */
    function runSeeds(string $name): void
    {
        $migrationFolderPath = __DIR__ . '/seeds/';

            // Выполнение seed
            $seedScript = file_get_contents("$migrationFolderPath/$name.sql");

            // Выполнение SQL-скрипта $migrationScript на базе данных
            $this->pdo->exec($seedScript);

            echo "Seed $name выполнен успешно \n";
    }
}

$run = new Run();

if ($argv[1] === 'migrate') {
    $run->runMigrations();
} elseif ($argv[1] === 'seed') {
    $run->runSeeds($argv[2]);
} else {
    echo 'Команда не найдена';
}