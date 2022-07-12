<?php require_once 'header.php' ?>

    <body>

	<?php require_once 'nav.php' ?>

    <div class="grid grid-cols-12 mt-20">

        <form class="space-y-6 col-start-4 col-span-6" action="new_post.php" method="POST">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
                <div class="mt-1">
                    <input id="title" name="title" type="text" placeholder="A title for your post"
                           required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Post body</label>
                <div class="mt-1">
                    <textarea rows="4" name="body" id="body" placeholder="Post content"
                              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Post
                </button>
            </div>
        </form>

    </div>

    </body>

<?php

require_once 'Repositories/PostRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\PostRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$body = $_POST['body'];
	$userId = $_SESSION['user_id'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$post = (new PostRepository())->savePost($title, $body, $authenticatedUser->id);
	if ($post) {
		header('Location: posts.php');
	} else {
		$_SESSION['error_message'] = 'Error creating post';
		header('Location: new_post.php');
	}
	exit(0);
}
