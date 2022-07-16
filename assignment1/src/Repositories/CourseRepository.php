<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Course.php';

use src\Models\Course;

class CourseRepository extends Repository {

	/**
	 * @param int $user_id
	 * @return array
	 */
	public function getCoursesForUser(int $user_id): array {
		$sqlStatement = $this->mysqlConnection->prepare("SELECT * FROM courses WHERE author_id = ?");
		$sqlStatement->bind_param('i', $user_id);
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();

		$courses = [];
		while ($row = $resultSet->fetch_assoc()) {
			$courses[] = new Course($row);
		}

		return $courses;
	}

	/**
	 * @param string $title
	 * @param bool $is_completed
	 * @param int $user_id
	 * @return bool
	 */
	public function saveCourse(string $title, bool $is_completed, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("INSERT INTO courses VALUES(NULL, ?, ?, ?)");
		$sqlStatement->bind_param('sii', $title, $is_completed, $user_id);
		return $sqlStatement->execute();
	}

	public function deleteCourse(string $title, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("DELETE FROM courses WHERE title= ? ");
		$sqlStatement->bind_param('s', $title);
		return $sqlStatement->execute();
	}

	public function completed(int $is_completed, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("UPDATE courses SET is_completed= ? WHERE is_completed = ?");
		$sqlStatement->bind_param('ii', $is_completed, $is_completed);
		return $sqlStatement->execute();
	}

	public function updateTitle(string $title, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("UPDATE courses SET title=? WHERE title != ? ");
		$sqlStatement->bind_param('ss', $title, $title);
		return $sqlStatement->execute();
	}

}
