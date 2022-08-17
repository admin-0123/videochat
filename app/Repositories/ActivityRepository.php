<?php

namespace App\Repositories;

use App\Helpers\ArrHelper;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityCollection;
use App\Traits\CustomModelOption;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ActivityRepository
{
    use CustomModelOption;

    protected $activity;

    public function __construct(
        Activity $activity
    ) {
        $this->activity = $activity;
    }

    /**
     * Get all activities
     *
     * @return array
     */
    public function getAll($options = array())
    {
        return new ActivityCollection($this->activity->orderBy('created_at','asc')->get());
    }

    /**
     * Find activity with given id.
     *
     * @param  integer  $id
     * @return Member
     */
    public function find($id)
    {
        return $this->activity->filterById($id)->first();
    }

    /**
     * Find activity with given id or throw an error.
     *
     * @param  integer  $id
     * @return Activity
     */
    public function findOrFail($id, $field = 'message')
    {
        $activity = $this->find($id);

        if (! $activity) {
            throw ValidationException::withMessages([$field => __('global.could_not_find', ['attribute' => __('activity.activity')])]);
        }

        return $activity;
    }

    /**
     * Find activity with given uuid.
     *
     * @param  uuid  $uuid
     * @return Member
     */
    public function findByUuid($uuid)
    {
        return new ActivityCollection($this->activity->filterByUserId(auth()->user()->id)->filterByDueDate(request('date'))->get());
    }

    /**
     * Find activity with given uuid or throw an error.
     *
     * @param  uuid  $uuid
     * @return Activity
     */
    public function findByUuidOrFail($uuid, $field = 'message')
    {
        $activity = $this->findByUuid($uuid);

        if (! $activity) {
            throw ValidationException::withMessages([$field => __('global.could_not_find', ['attribute' => __('activity.activity')])]);
        }

        return $activity;
    }

    /**
     * Get all filtered data
     *
     * @param  array  $params
     * @return Member
     */
    public function getData($params)
    {
        $sort_by      = $this->getSortBy(['created_at'], 'created_at');
        $order        = $this->getOrder('desc');

        $start_date  = request()->query('start_date');
        $end_date    = request()->query('end_date');

        $query = $this->activity->query();

        if ($start_date && $end_date && $start_date <= $end_date) {
            $query->where('created_at', '>=', Carbon::parse($start_date)->startOfDay())->where('created_at', '<=', Carbon::parse($end_date)->startOfDay());
        }

        return $query->orderBy($sort_by, $order);
    }

    /**
     * Paginate all activities using given params.
     *
     * @param  array  $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function paginate($params)
    {
        $per_page     = $this->getPerPage();
        $current_page = $this->getCurrentPage();

        if (request('type') == 'list') {
            return new ActivityCollection($this->getData($params)->get());
        }

        return new ActivityCollection($this->getData($params)->paginate((int) $per_page, ['*'], 'current_page'));
    }

    /**
     * Delete activity.
     *
     * @param  integer  $id
     * @return void
     */
    public function delete(Activity $activity)
    {
        return $activity->delete();
    }
}
