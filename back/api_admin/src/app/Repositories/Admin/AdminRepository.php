<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
    }
    public function count()
    {
        return DB::table('admins')->count();
    }

}
