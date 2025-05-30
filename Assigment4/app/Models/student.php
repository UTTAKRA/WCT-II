<?php

namespace App\Models;

class Student
{
    protected static $data = [
        ['id' => 1, 'name' => 'Ly Uttakra', 'age' => 21, 'grade' => 'A', 'subjects' => ['Math', 'Science']],
        ['id' => 2, 'name' => 'Ly Mithona', 'age' => 22, 'grade' => 'B', 'subjects' => ['History']],
    ];

    public static function all()
    {
        return self::$data;
    }

    public static function find($id)
    {
        foreach (self::$data as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }
        return null;
    }

    public static function create($studentData)
    {
        $newId = empty(self::$data) ? 1 : max(array_column(self::$data, 'id')) + 1;
        $student = ['id' => $newId, ...$studentData];
        self::$data[] = $student;
        return $student;
    }

    public static function delete($id)
    {
        foreach (self::$data as $index => $student) {
            if ($student['id'] == $id) {
                unset(self::$data[$index]);
                self::$data = array_values(self::$data);
                return ['success' => true, 'message' => 'Student deleted'];
            }
        }
        return ['success' => false, 'message' => 'Student not found'];
    }

    public static function update($id, $newData)
    {
        foreach (self::$data as $index => $student) {
            if ($student['id'] == $id) {
                $allowedFields = ['name', 'age', 'grade', 'subjects'];
                foreach ($allowedFields as $field) {
                    if (isset($newData[$field])) {
                        self::$data[$index][$field] = $newData[$field];
                    }
                }
                return self::$data[$index];
            }
        }
        return null;
    }
}