<?php

namespace App\Contracts;

/**
 * Interface DirectoryContract
 * @package App\Contracts
 */
interface DirectoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listDirectory(string $order = 'id', string $sort = 'asc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findDirectoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createDirectory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDirectory(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteDirectory($id);

     /**
     * @param $id
     * @return mixed
     */
    public function detailsDirectory($id);

    /**
     * @param $id
     * @return mixed
     */
    public function updateDirectoryStatus(array $params);


    public function latestdirectory();

    public function getDirectorycategories();
    public function searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$opening_hour);
    public function getDirectoryByPinCode(string $term);
    public function detailsBusiness($id);
    public function directorywisecollection($directoryId);
    public function getSearchDirectory(string $term);
    public function addReview(array $data);
    public function showreview($id);
}
