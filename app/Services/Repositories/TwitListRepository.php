<?php
namespace App\Services\Repositories;

use App\Http\Requests\TwitUpdateRequest;
use App\Models\Twit;
use App\Services\Interfaces\TwitListInterface;

class TwitListRepository implements TwitListInterface {

    /**
     * @param array $conditions
     * @param string $method [first,get,paginate]
     *
     */
    public function get_twit_model($conditions = [],$method='get',$parameter=['*']){
        try {
            return Twit::where($conditions)->orderByDesc('created_at')->{$method}($parameter);
        } catch (\Exception $e){
            return $e;
        }
    }

    /**
     * @param TwitUpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(TwitUpdateRequest $request,int $id){
        return Twit::query()->find($id)->update($request->all());
    }
}
