<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UsersRepository;
use App\Models\Users;

/**
 * Class UsersRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class UsersRepositoryEloquent extends BaseRepository implements UsersRepository {
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function getModel() {
    return Users::class;
  } 
}
