<?php
namespace App\Repositories;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\LocalTradeQuestions;
use App\Models\LocalTradeQueryRequest;
use App\Models\PinCode;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\TradeContract;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class LoopRepository
 *
 * @package \App\Repositories
 */
class TradeRepository extends BaseRepository implements TradeContract
{
    use UploadAble;

    /**
     * LoopRepository constructor.
     * @param LocalTradeQuestions $model
     */
    public function __construct(LocalTradeQuestions $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTradeQuestion(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTradeQuestionById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Loop|mixed
     */
    public function createTradeQuestion(array $param, $response)
    {
        try {
            dd($param);
            $collection = collect($param);
            $queryRFQ = new LocalTradeQueryRequest();
            $queryRFQ->ip = $_SERVER['REMOTE_ADDR'];
            // if (Auth::user()) {
            //     $queryRFQ->user_id = Auth::user()->id;
            // }
            $queryRFQ->user_id = $response->user_id;
            $queryRFQ->postcode = $response->postcode;
            $queryRFQ->time_frame = $response->time_frame;
            $queryRFQ->job_details = $response->job_details ?? null;
            $queryRFQ->budget = $response->budget;
            $queryRFQ->category = $response->category;
            $queryRFQ->total_payload = json_encode($response->all());
            $queryRFQ->save();
            return $queryRFQ;
        } catch (\Throwable $th) {
            throw $th;
        }
    }





    /**
     * @return mixed
     */
    public function getCategories(){
        $cat = BusinessCategory::all();

        return $cat;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsTradeQuestion($id)
    {
        $loops = LocalTradeQuestions::with('category')->with('comments')->with('likes')->where('id',$id)->get();

        return $loops;
    }


    public function getPincode(){
        $pin = PinCode::get();

        return $pin;
    }
    /**
     * @return mixed
     */
    public function getLocalTradeRequest(){
        $cat = LocalTradeQueryRequest::with('user')->paginate(5);

        return $cat;
    }


    /**
     * @return mixed
     */
    public function getSearchTrade(string $term)
    {
        return LocalTradeQueryRequest::where([['postcode', 'LIKE', '%' . $term . '%']])
        ->orWhere('category', 'LIKE', '%' . $term . '%')
        ->orWhere('time_frame', 'LIKE', '%' . $term . '%')
        ->orWhere('budget', 'LIKE', '%' . $term . '%')
        ->get();
    }


}
