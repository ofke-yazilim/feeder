<?php
namespace App\Services\Interfaces;

use App\Helpers\Response;
use App\Http\Requests\TwitUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\Twit;
use App\Models\User;
use Illuminate\Http\Request;

interface TwitListInterface
{
    /**
     * @param array $conditions
     */
    public function get_twit_model($conditions = [],$method='get',$parameter=['*']);

    /**
     * @param TwitUpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(TwitUpdateRequest $request,int $id);

}
