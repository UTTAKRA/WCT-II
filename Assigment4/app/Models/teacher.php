<?php

namespace App\Models;

class Teacher
{
    protected static $data = [
        ['id' => 1, 'name' => 'Mr. Naruto', 'subject' => 'Network', 'age' => 35, 'yearsOfExperience' => 30],
        ['id' => 2, 'name' => 'Ms. Sakura Haruno', 'subject' => 'English', 'age' => 30, 'yearsOfExperience' => 25],
    ];

    public static function all()
    {
        return self::$data;
    }

    public static function find($id)
    {
        foreach (self::$data as $teacher) {
            if ($teacher['id'] == $id) {
                return $teacher;
            }
        }
        return null;
    }

    public static function create($teacherData)
    {
        $newId = empty(self::$data) ? 1 : max(array_column(self::$data, 'id')) + 1;
        $teacher = ['id' => $newId, ...$teacherData];
        self::$data[] = $teacher;
        return $teacher;
    }

    public static function delete($id)
    {
        foreach (self::$data as $index => $teacher) {
            if ($teacher['id'] == $id) {
                unset(self::$data[$index]);
                self::$data = array_values(self::$data);
                return ['success' => true, 'message' => 'Teacher deleted'];
            }
        }
        return ['success' => false, 'message' => 'Teacher not found'];
    }

    public static function update($id, $newData)
    {
        foreach (self::$data as $index => $teacher) {
            if ($teacher['id'] == $id) {
                $allowedFields = ['name', 'subject', 'age', 'yearsOfExperience'];
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