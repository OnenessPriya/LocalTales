<?php

namespace App\Contracts;

/**
 * Interface TradeContract
 * @package App\Contracts
 */
interface TradeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTradeQuestion(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTradeQuestionById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTradeQuestion(array $params, $response);




    /**
     * @return mixed
     */
    public function getCategories();

    /**
     * @param $id
     * @return mixed
     */
    public function detailsTradeQuestion($id);


    /**
     * @return mixed
     */
    public function getPincode();

    public function getLocalTradeRequest();

    public function getSearchTrade(string $term);
}
