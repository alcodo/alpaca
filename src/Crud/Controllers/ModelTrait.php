<?php

namespace Alpaca\Crud\Controllers;

trait ModelTrait
{
    /**
     * Return a entry.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntry($id)
    {
        $model = $this->getModelClass();
        $entry = $model::findOrFail($id);

        return $entry;
    }

    /**
     * Returns a collections of entries.
     *
     * @param null $parameters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEntries($parameters = null)
    {
        $model = $this->getModelClass();
        $entries = $model::orderBy(
            $this->getModelOrderColumn(), $this->getModelOrderDirection()
        )->get();

        return $entries;
    }

    /**
     * Create a entry and return it.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEntry(array $data)
    {
        $model = $this->getModelClass();
        $entry = $model::create($data);

        return $entry;
    }

    /**
     * Updates a entry.
     *
     * @param $id
     * @param array $data
     *
     * @return bool|int
     */
    public function updateEntry($id, array $data)
    {
        $entry = $this->getEntry($id);
        $status = $entry->update($data);

        return $status;
    }

    /**
     * Destryo a entry.
     *
     * @param $id
     *
     * @return bool|int
     */
    public function destroyEntry($id)
    {
        $model = $this->getModelClass();
        $status = $model::destroy($id);

        return $status;
    }

    /**
     * Return the order column.
     *
     * @return string
     */
    public function getModelOrderColumn()
    {
        return 'updated_at';
    }

    /**
     * Return the order direction.
     *
     * @return string
     */
    public function getModelOrderDirection()
    {
        return 'desc';
    }
}
