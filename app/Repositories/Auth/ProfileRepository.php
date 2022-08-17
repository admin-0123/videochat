<?php

namespace App\Repositories\Auth;

use App\Helpers\ArrHelper;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class ProfileRepository
{
    /**
     * Update profile
     */
    public function update() : void
    {
        $user = \Auth::user();

        $gender = Arr::get(request('gender', []), 'uuid');

        if ($gender && ! in_array($gender, ArrHelper::getList('genders'))) {
            throw ValidationException::withMessages(['message' => trans('global.could_not_find', ['attribute' => trans('user.props.gender')])]);
        }

        $user->name = request('name');
        $user->birth_date = request('birth_date') ? : null;
        $user->gender = $gender;
        $user->save();
    }

    /**
     * Upload avatar
     */
    public function uploadAvatar() : User
    {
        request()->validate([
            'file' => 'required|image'
        ]);

        $user = \Auth::user();

        if (request('type') == 'cover') {
            return $this->updateCoverImage($user);
        }

        return $this->updateAvatarImage($user);
    }

    private function updateCoverImage(User $user)
    {
        $cover_image = str_replace('/storage/', '', $user->getMeta('cover_image'));

        if ($cover_image && \Storage::disk('public')->exists($cover_image)) {
            \Storage::disk('public')->delete($cover_image);
        }

        $file = \Storage::disk('public')->putFile('cover-image', request()->file('file'));
        $meta = $user->meta;
        $meta['cover_image'] = '/storage/'.$file;
        $user->meta = $meta;
        $user->save();

        return $user;
    }

    private function updateAvatarImage(User $user)
    {
        $avatar = str_replace('/storage/', '', $user->avatar);

        if ($avatar && \Storage::disk('public')->exists($avatar)) {
            \Storage::disk('public')->delete($avatar);
        }

        $file = \Storage::disk('public')->putFile('avatar', request()->file('file'));
        $user->avatar = '/storage/'.$file;
        $user->save();

        return $user;
    }

    /**
     * Remomve avatar
     */
    public function removeAvatar() : void
    {
        $user = \Auth::user();

        if (request('type') == 'cover') {
            $this->removeCoverImage($user);
        } else {
            $this->removeAvatarImage($user);
        }
    }

    private function removeCoverImage(User $user)
    {
        if (! $user->getMeta('cover_image')) {
            return;
        }

        $cover_image = str_replace('/storage/', '', $user->getMeta('cover_image'));

        if (\Storage::disk('public')->exists($cover_image)) {
            \Storage::disk('public')->delete($cover_image);
        }

        $meta = $user->meta;
        $meta['cover_image'] = null;
        $user->meta = $meta;
        $user->save();
    }

    private function removeAvatarImage(User $user)
    {
        if (! $user->avatar) {
            return;
        }

        $avatar = str_replace('/storage/', '', $user->avatar);

        if (\Storage::disk('public')->exists($avatar)) {
            \Storage::disk('public')->delete($avatar);
        }

        $user->avatar = null;
        $user->save();
    }
}
