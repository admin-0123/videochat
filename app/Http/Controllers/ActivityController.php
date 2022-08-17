<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $request;
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        Request $request,
        ActivityRepository $repo
    ) {
        $this->request = $request;
        $this->repo = $repo;
    }

    /**
     * Get Activity statistics
     */
    public function index()
    {
        return $this->repo->paginate($this->request->all());
    }
}
