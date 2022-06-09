<?php
namespace App\Repositories;


use App\Models\Coupon;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CouponContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\Models\CouponUsage;
/**
 * Class DealRepository
 *
 * @package \App\Repositories
 */
class CouponRepository extends BaseRepository implements CouponContract
{
    use UploadAble;

    /**
     * DealRepository constructor.
     * @param Coupon $model
     */
    public function __construct(Coupon $model)
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
    public function listCoupon(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCouponById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Deal|mixed
     */
    public function createCoupon(array $data)
    {
        try {

        $collectedData = collect($data);

        $newEntry = new Coupon;
        $newEntry->name = $collectedData['name'];
        $newEntry->coupon_code = $collectedData['coupon_code'];
        if (!empty($collectedData['type'])) {
            $newEntry->type = $collectedData['type'];
        }
        $newEntry->amount = $collectedData['amount'];
        $newEntry->max_time_of_use = $collectedData['max_time_of_use'];
        $newEntry->max_time_one_can_use = $collectedData['max_time_one_can_use'];
        $newEntry->start_date = $collectedData['start_date'];
        $newEntry->end_date = $collectedData['end_date'];

        $newEntry->save();

        return $newEntry;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCoupon($id, array $newDetails)
    {
        $updatedEntry = Coupon::findOrFail($id);
        $collectedData = collect($newDetails);
        // dd($newDetails);

        $updatedEntry->name = $collectedData['name'];
        $updatedEntry->coupon_code = $collectedData['coupon_code'];
        if (!empty($collectedData['type'])) {
            $updatedEntry->type = $collectedData['type'];
        }
        $updatedEntry->amount = $collectedData['amount'];
        $updatedEntry->max_time_of_use = $collectedData['max_time_of_use'];
        $updatedEntry->max_time_one_can_use = $collectedData['max_time_one_can_use'];
        $updatedEntry->start_date = $collectedData['start_date'];
        $updatedEntry->end_date = $collectedData['end_date'];

        $updatedEntry->save();

        return $updatedEntry;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCoupon($id)
    {
        $coupon = $this->findOneOrFail($id);
        $coupon->delete();
        return $coupon;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function toggle($id)
    {
        $updatedEntry = Coupon::findOrFail($id);

        $status = ($updatedEntry->status == 1) ? 0 : 1;
        $updatedEntry->status = $status;
        $updatedEntry->save();

        return $updatedEntry;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsCoupon($id)
    {
        $coupon = Coupon::where('id',$id)->get();

        return $coupon;
    }
    public function getSearchCoupons(string $term)
    {
        return Coupon::where([['name', 'LIKE', '%' . $term . '%']])->paginate(5);
    }

    public function usageById($id)
    {
        return CouponUsage::where('coupon_code_id', $id)->get();
    }

}
