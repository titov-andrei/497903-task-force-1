<?php

namespace TaskForce;

use Exceptions\TaskForceException;

class CSVToSQLConverter
{
    public $file;
    public $directory;
    public $CSVFileObject;

    public function __construct(string $file, string $directory)
    {
        $this->file = $file;
        $this->directory = $directory;
    }

    public function createSQLFromCSV(): void
    {
        if (!file_exists($this->file)) {
            throw new TaskForceException('Файл не существует');
        }

        if (!file_exists($this->directory)) {
            mkdir($this->directory);
        }

        try {
            $this->CSVFileObject = new \SplFileObject($this->file, 'r');
        } catch (TaskForceException $exception) {
            throw new TaskForceException('Не удалось открыть файл на чтение');
        }
        
        $this->CSVFileObject->setFlags(\SplFileObject::DROP_NEW_LINE | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::READ_CSV);

        $newFile = basename($this->file, '.csv');

        try {
            $SQLFileObject = new \SplFileObject("$this->directory/$newFile.sql", 'w');
        } catch (TaskForceException $exception) {
            throw new TaskForceException('Не удалось создать или записать в файл');
        }

        $headerData = implode(', ', $this->getHeaderData());

        $SQLFileObject->fwrite("INSERT INTO $newFile ($headerData) VALUES");
        $isFirstValues = true;

        foreach ($this->getNextLine() as $line) {
            $values = ",\n('" . implode("', '", $line) . "')";

            if ($isFirstValues) {
                $values = ltrim($values, ',');
                $isFirstValues = false;
            }

            $SQLFileObject->fwrite($values);
        }

        $SQLFileObject->fwrite(';');
    }

    public function getHeaderData(): ?array
    {
        $this->CSVFileObject->rewind();
        $data = $this->CSVFileObject->fgetcsv();

        return $data;
    }

    private function getNextLine(): ?iterable {
        $result = null;

        while (!$this->CSVFileObject->eof()) {
            yield $this->CSVFileObject->fgetcsv();
        }

        return $result;
    }
}
