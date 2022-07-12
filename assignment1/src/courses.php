<?php require_once 'header.php'; ?>

<?php

require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

// session_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$courses = [];
if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
    $coursesRepository = new CourseRepository();
	$courses = $coursesRepository->getCoursesForUser($userId);
} else {
	header('Location: login.php');
}
?>

<body>

<?php require_once 'nav.php' ?>

<div class="grid grid-cols-12 mt-20">
    <ul role="list" class="divide-y divide-gray-200 space-y-6 col-start-4 col-span-6">
        <span class="font-extrabold"><?php echo count($courses) === 0 ? 'No courses yet.' : 'Your Courses:' ?></span>

		<?php foreach ($courses as $course): ?>
            <li class="py-4 flex">
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900"><?= $course->title ?></p>
                    <p class="text-sm text-gray-500"><?= $course->body ?></p>
                </div>
            </li>
		<?php endforeach; ?>

    </ul>
</div>

</body>
