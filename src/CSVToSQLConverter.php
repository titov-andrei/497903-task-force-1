<?php

namespace TaskForce;

use Exceptions\TaskForceException;

class CSVToSQLConverter
{
    public function createSQLFromCSV($file, $directory): void
    {
        if (!file_exists($file)) {
            throw new TaskForceException('Файл не существует');
        }

        if (!file_exists($directory)  && !mkdir($directory)) {
            throw new TaskForceException('Не удалось создать дуректорию');
            mkdir($directory);
        }

        try {
            $CSVFileObject = new \SplFileObject($file, 'r');
        } catch (TaskForceException $exception) {
            throw new TaskForceException('Не удалось открыть файл на чтение');
        }

        $CSVFileObject->setFlags(\SplFileObject::DROP_NEW_LINE | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::READ_CSV);

        $headerData = implode(', ', $this->getHeaderData());

        $values[] = sprintf("\t(%s)", implode(', ', array_map(function ($item) {
            return "'{$item}'";
        }, $CSVFileObject->fgetcsv(','))));

        $newFile = basename($file, '.csv');

        try {
            $SQLFileObject = new \SplFileObject("$directory/$newFile.sql", 'w');
        } catch (TaskForceException $exception) {
            throw new TaskForceException('Не удалось создать или записать в файл');
        }

        $SQLFileObject->fwrite("INSERT INTO $newFile ($headerData) VALUES $values;");
    }

    public function getHeaderData(): ?array
    {
        $this->CSVFileObject->rewind();
        $data = $this->CSVFileObject->fgetcsv();

        return $data;
    }
}
