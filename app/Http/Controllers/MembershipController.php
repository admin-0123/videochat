<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Repositories\MembershipRepository;
use App\Http\Resources\Membership as MembershipResource;

class MembershipController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance.
     */
    public function __construct(
        MembershipRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Get membership pre requisite
     * @get ("/api/memberships/pre-requisite")
     * @return array
     */
    public function preRequisite()
    {
        return $this->ok($this->repo->getPreRequisite());
    }

    /**
     * Used to get memberships
     */
    public function index()
    {
        return $this->repo->paginate();
    }

    /**
     * Get membership detail
     * @get ("/api/memberships/{membership}")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Membership unique id"),
     * })
     * @return MembershipResource
     */
    public function show($uuid)
    {
        return new MembershipResource($this->repo->findOrFail($uuid));
    }

    /**
     * Calculate payable amount
     * @post ("/api/memberships/calculate")
     * @return array
     */
    public function calculate()
    {
        return $this->ok($this->repo->calculate());
    }

    /**
     * Make payment of membership
     * @post ("/api/memberships/payment")
     * @return array
     */
    public function payment()
    {
        $this->repo->payment();

        return $this->ok(['message' => __('global.updated', ['attribute' => __('membership.membership')])]);
    }
}
