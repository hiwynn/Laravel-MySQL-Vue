<?php
/**
 * Created by PhpStorm.
 * User: WangYN
 * Date: 2018/4/12
 * Time: 17:54
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    public function getAllMessages()
    {
        return Message::where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with([
                'fromUser' => function ($query) {
                    return $query->select(['id', 'name', 'avatar']);
                },
                'toUser'   => function ($query) {
                    return $query->select(['id', 'name', 'avatar']);
                }
            ])->latest()->get();
    }

    public function getDialogMessagesByDialogId($dialogId)
    {
        return Message::where('dialog_id', $dialogId)->with([
            'fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            },
            'toUser'   => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }
        ])->latest()->get();
    }

    public function getSingleMessgeBy($dialogId)
    {
        return Message::where('dialog_id', $dialogId)->first();;
    }
}