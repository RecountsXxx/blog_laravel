<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
    }


}
