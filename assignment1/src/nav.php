<?php

require_once 'Repositories/UserRepository.php';
require_once 'Models/User.php';

use src\Repositories\UserRepository;

ob_start();

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}


if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit(0);
}

$authenticatedUser = (new UserRepository())->getUserById($_SESSION['user_id']);
?>

<body>
	<nav class="navbar bg-[#1A1B25]">
		<div class="navbar-start">
			<div class="dropdown">
				<label tabindex="0" class="btn btn-ghost lg:hidden">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
				</label>
				<ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
					<li class="hidden md:ml-6 md:flex md:space-x-4"><a class="text-white px-3 py-2 rounded-md text-sm font-medium">Sign Up</a></li>
					<li class="hidden md:ml-6 md:flex md:space-x-4"><a class="text-white px-3 py-2 rounded-md text-sm font-medium">About Us</a></li>
					<li class="hidden md:ml-6 md:flex md:space-x-4">
							<a href="courses.php" class="text-white px-3 py-2 rounded-md text-sm font-medium">Courses</a>
					</li>
					<li class="hidden md:ml-6 md:flex md:space-x-4">
							<a href="addCourse.php" class="text-white px-3 py-2 rounded-md text-sm font-medium">New Course</a>
					</li>
				</ul>
			</div>
			<a href="/" class="btn btn-ghost normal-case text-xl">Course Manager✏️</a>
		</div>
		<div class="navbar-center hidden lg:flex">
			<ul class="menu menu-horizontal p-0">
			<li class="hidden md:ml-6 md:flex md:space-x-4"><a class="text-white px-3 py-2 rounded-md text-sm font-medium">Sign Up</a></li>
					<li class="hidden md:ml-6 md:flex md:space-x-4"><a class="text-white px-3 py-2 rounded-md text-sm font-medium">About Us</a></li>
					<li class="hidden md:ml-6 md:flex md:space-x-4">
							<a href="courses.php" class="text-white px-3 py-2 rounded-md text-sm font-medium">Courses</a>
					</li>
					<li class="hidden md:ml-6 md:flex md:space-x-4">
							<a href="addCourse.php" class="text-white px-3 py-2 rounded-md text-sm font-medium">New Course</a>
					</li>
			</ul>
		</div>
		
		<div class="flex items-center navbar-end m-2">
			<!-- display login user -->
			<div class="flex-shrink-0 text-white">
					<span>Welcome, <?= $authenticatedUser->name ?>!&nbsp;&nbsp;</span>
			</div>
			<!-- display login user end -->

			<!-- user logout icon -->
			<div>
				<form id="logout-form" action="logout.php" method="POST">
					<svg onclick="logout()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 clickable"
								fill="none"
								viewBox="0 0 24 24"
								stroke="white" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round"
									d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
					</svg>
				</form>
			</div>
			<!-- user logout icon end -->		
		</div>
	</nav>

<script>
    logout = () => {
        document.getElementById('logout-form').submit();
    }
</script>

<style>
    .clickable {
        cursor: pointer;
    }
</style>