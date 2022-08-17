<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait MeetingConfig
{
    public function getMeetingConfig($config)
    {
        return array(
            'rtc_library'                         => $this->fetchConfig($config, 'rtc_library', false),

            'can_toggle_audio'                    => $this->fetchConfig($config, 'can_toggle_audio'),
            'can_toggle_video'                    => $this->fetchConfig($config, 'can_toggle_video'),
            'can_share_files'                     => $this->fetchConfig($config, 'can_share_files'),
            'can_share_screen'                    => $this->fetchConfig($config, 'can_share_screen'),
            'can_share_link'                      => $this->fetchConfig($config, 'can_share_link'),
            'can_use_whiteboard'                  => $this->fetchConfig($config, 'can_use_whiteboard'),
            'can_use_hand_gesture'                => $this->fetchConfig($config, 'can_use_hand_gesture'),

            'enable_chat'                         => $this->fetchConfig($config, 'enable_chat'),
            'mute_participants_on_start'          => $this->fetchConfig($config, 'mute_participants_on_start'),
            'ask_host_before_joining'             => $this->fetchConfig($config, 'ask_host_before_joining'),
            'speech_detection'                    => $this->fetchConfig($config, 'speech_detection'),
            'enable_background_blur'              => $this->fetchConfig($config, 'enable_background_blur'),
            'layout'                              => $this->fetchConfig($config, 'layout', false),
            'max_participant_count'               => (int) $this->fetchConfig($config, 'max_participant_count', false),

            'can_record'                          => $this->fetchConfig($config, 'can_record'),
            'enable_auto_recording'               => $this->fetchConfig($config, 'enable_auto_recording'),
            'auto_upload_recording'               => $this->fetchConfig($config, 'auto_upload_recording'),
            'auto_upload_recorded'                => $this->fetchConfig($config, 'auto_upload_recorded'),
            'can_stop_auto_recording'             => $this->fetchConfig($config, 'can_stop_auto_recording'),

            'can_take_snapshot'                   => $this->fetchConfig($config, 'can_take_snapshot'),
            'anyone_can_take_snapshot'            => $this->fetchConfig($config, 'anyone_can_take_snapshot'),
            'enable_snapshot_alert'               => $this->fetchConfig($config, 'enable_snapshot_alert'),
            'snapshot_alert_to_user_only'         => $this->fetchConfig($config, 'snapshot_alert_to_user_only'),
            'snapshot_alert_to_moderators'        => $this->fetchConfig($config, 'snapshot_alert_to_moderators'),

            'auto_end_meeting'                    => $this->fetchConfig($config, 'auto_end_meeting'),
            'alert_before_auto_end'               => $this->fetchConfig($config, 'alert_before_auto_end'),
            'can_snooze_auto_end'                 => $this->fetchConfig($config, 'can_snooze_auto_end'),
            'can_cancel_auto_end'                 => $this->fetchConfig($config, 'can_cancel_auto_end'),
            'alert_before_auto_end_time'          => (int) $this->fetchConfig($config, 'alert_before_auto_end_time', false),


            'pam_open_join_as_guest_page'         => $this->fetchConfig($config, 'pam_open_join_as_guest_page'),
            'pam_can_share_screen_for_guest'      => $this->fetchConfig($config, 'pam_can_share_screen_for_guest'),
            'pam_can_share_link_for_guest'        => $this->fetchConfig($config, 'pam_can_share_link_for_guest'),
            'pam_can_use_whiteboard_for_guest'    => $this->fetchConfig($config, 'pam_can_use_whiteboard_for_guest'),
        );
    }

    private function fetchConfig($config, $key, $is_boolean = true)
    {
        $value = Arr::has($config, $key) ? Arr::get($config, $key) : config('config.meeting.' . $key);

        if ($is_boolean) {
            return $value ? true : false;
        }

        return $value;
    }
}
