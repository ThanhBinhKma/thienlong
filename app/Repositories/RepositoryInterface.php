<?php

namespace App\Repositories;

/**
 * Description of RepositoryInterface
 *
 * @author BaoDo
 */
interface RepositoryInterface {

    /**
     * Get all column
     * @param array $columns
     */
    public function all($columns = array('*'));

    /**
     * paginate data
     * @param integer $perPage
     * @param array $columns
     */
    public function first($columns = array('*'));

    /**
     * paginate data
     * @param integer $perPage
     * @param array $columns
     */

    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * create data
     * @param array $data
     */
    public function create(array $data);

    /**
     * update data
     * @param array $data
     * @param integer $id
     */
    public function update(array $data, $id);

    /**
     * Update or Create an entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * delete data
     * @param integer $id
     */
    public function delete($id);

    /**
     * deleteWhere
     * @param array $where
     */
    public function deleteWhere(array $where);

    /**
     * find data
     * @param integer $id
     * @param array $columns
     */
    public function find($id, $columns = array('*'));

    /**
     * orderBy
     * @param string $direction
     * @param array $columns
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * findBy column
     * @param string $field
     * @param string $value
     * @param array $columns
     */
    public function findBy($field, $value, $columns = array('*'));

    /**
     * Get by id
     * @param integer $id
     */
    public function getById($id);

    /**
     * findByField
     * @param string $field
     * @param string $value
     */
    public function findByField($field, $value, $columns = ['*']);

    /**
     * findWhere
     * @param array $where
     */
    public function findWhere(array $where, $columns = ['*']);

    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']);

    /**
     * Find data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereNotIn($field, array $values, $columns = ['*']);

    /**
     * findByMultiConditions
     * @param string $tableName
     * @param array $whereData
     */
    public function findByMultiConditions($tableName, $whereData = array());

    /**
     * paging With Multi Conditions
     * @param string $tableName
     * @param array $whereData
     * @param integer $perPage
     * @param array $columns
     */
    public function pagingWithMultiConditions($tableName, $whereData = array(), $perPage = 15, $columns = array('*'));

    /**
     * del By Multi Conditions
     * @param string $tableName
     * @param array $whereData
     */
    public function delByMultiConditions($tableName, $whereData = array());
}
