<?php

namespace app\core\db;

use app\core\Application;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare(string $sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..')
                continue;

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $className();

            $this->log('');  // Line break
            $this->log("Applying migration: $migration");
            $instance->up();
            $this->log("Applied migration: $migration");
            $this->log('');  // Line break

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations))
            $this->saveMigrations($newMigrations);
        else
        {
            $this->log('');  // Line break
            $this->log("All migrations are applied");
            $this->log('');  // Line break
        }

        //var_dump($appliedMigrations);
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $migrations)
    {
        $migrations = implode(', ', array_map(fn($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES" . $migrations);
        $statement->execute();
    }

    protected function log($massage)
    {
        if ($massage === '')
            echo PHP_EOL;
        else
            echo '[' . date('Y-m-d H:i:s') . '] - ' . $massage . PHP_EOL;
    }
}