<?php

namespace Pterodactyl\Http\Controllers\auth;

use Pterodactyl\Contracts\Repository\LocationRepositoryInterface;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
	/**
	 * @var \Pterodactyl\Contracts\Repository\LocationRepositoryInterface
	 */
	protected $repository;

	/**
	 * LocationController constructor.
	 *
	 * @param \Pterodactyl\Contracts\Repository\LocationRepositoryInterface $repository
	 */
	public function __construct(
		LocationRepositoryInterface $repository
	) {
		$this->repository = $repository;
	}

	/**
	 * Return the Register overview page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('templates/auth.register', [
			'locations' => $this->repository->getAllWithDetails(),
		]);
	}

	public function register(Request $req)
	{
		$valid = $req->validate([
			'registration_email' => 'required|email|regex:/(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)+/|min:5|max:35',
			'registration_username' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:5|max:15',
			'registration_firstname' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:5|max:15',
			'registration_lastname' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:5|max:15'
		]);

		$path = base_path();
		$res = shell_exec("cd {$path}; php artisan p:user:make --email={$req->input('registration_email')} --username={$req->input('registration_username')} --name-first={$req->input('registration_firstname')} --name-last={$req->input('registration_lastname')} --admin=0 --no-password");
		return view('templates/auth.register', [
			'locations' => $this->repository->getAllWithDetails(),
			'post_res' => $res,
		]);
	}
}
