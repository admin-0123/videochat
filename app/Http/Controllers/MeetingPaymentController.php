<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Repositories\MeetingPaymentRepository;
use App\Http\Resources\Transaction as TransactionResource;

class MeetingPaymentController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance.
     */
    public function __construct(
        MeetingPaymentRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Get meeting payment pre requisite
     * @get ("/api/meetings/{meeting}/payment/pre-requisite")
     * @return array
     */
    public function preRequisite(Meeting $meeting)
    {
        $meeting->isAccessible();

        return $this->ok($this->repo->getPreRequisite());
    }

    /**
     * Used to get meeting payments
     */
    public function index(Meeting $meeting)
    {
        $meeting->isAccessible(true);

        return $this->repo->paginate($meeting);
    }

    /**
     * Get meeting payment receipt
     * @get ("/api/meetings/{meeting}/payment/receipt")
     * @return TransactionResource
     */
    public function receipt(Meeting $meeting)
    {
        $meeting->isAccessible();

        return new TransactionResource($this->repo->receipt($meeting));
    }

    /**
     * Get meeting payment detail
     * @get ("/api/meetings/{meeting}/payment/{uuid}")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Payment unique id"),
     * })
     * @return TransactionResource
     */
    public function show(Meeting $meeting, $uuid)
    {
        $meeting->isAccessible(true);

        return new TransactionResource($this->repo->findOrFail($meeting, $uuid));
    }

    /**
     * Calculate payable amount
     * @post ("/api/meetings/{meeting}/calculate")
     * @return array
     */
    public function calculate(Meeting $meeting)
    {
        $meeting->isAccessible();

        return $this->ok($this->repo->calculate($meeting));
    }

    /**
     * Make payment of meeting
     * @post ("/api/meetings/{meeting}/payment")
     * @return array
     */
    public function payment(Meeting $meeting)
    {
        $meeting->isAccessible();

        $this->repo->payment($meeting);

        return $this->ok(['message' => __('meeting.payment.fee_paid')]);
    }
}
