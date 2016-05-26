<?php

namespace Alcodo\Crud\Controllers;


trait ModelTrait
{

    /**
     * Return a entry
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntry($id)
    {
        $model = $this->getModelClass();
        $entry = $model::findOrFail($id);
        return $entry;
    }

    /**
     * Returns a collections of entries
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEntries()
    {
        $model = $this->getModelClass();
        $entries = $model::all();
        return $entries;
    }

    /**
     * Create a entry and return it
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEntry(array $data)
    {
        $model = $this->getModelClass();
        $entry = $model::create($data);
        return $entry;
    }

    /**
     * Updates a entry
     *
     * @param $id
     * @param array $data
     * @return bool|int
     */
    public function updateEntry($id, array $data)
    {
        $entry = $this->getEntry($id);
        $status = $entry->update($data);
        return $status;
    }

    /**
     * Destryo a entry
     *
     * @param $id
     * @return bool|int
     */
    public function destroyEntry($id)
    {
        $model = $this->getModelClass();
        $status = $model::destroy($id);
        return $status;
    }

}