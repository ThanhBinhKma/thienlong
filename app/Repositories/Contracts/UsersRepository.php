<?php

namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

/**
 * Interface UsersRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface UsersRepository extends RepositoryInterface {

	public function createUser($request);

	public function activeUser($request);
	
	public function createSession($request);

	public function deleteSession($request);

	public function createResetPassword($request);

	public function updatePassword($id, $request);

	public function getUser($id);

	public function updateInfo($user, $request);
}
