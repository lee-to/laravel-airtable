<?php

namespace AirTableLaravel;


use AirTable\Client;

/**
 * Class AirTable
 * @package App\Sources\AirTableLaravel
 */
class AirTable
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * AirTable constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }


    /**
     * @param array $data
     * @return \AirTable\Models\Interfaces\RecordInterface
     */
    public function create(array $data)
    {
        return $this->getClient()->create($data);
    }

    /**
     * @param string $id
     * @param array $data
     * @return \AirTable\Models\Interfaces\RecordInterface
     */
    public function update(string $id, array $data)
    {
        return $this->getClient()->update($id, $data);
    }

    /**
     * @param string $id
     * @return \AirTable\Models\Interfaces\RecordInterface
     */
    public function find(string $id)
    {
        return $this->getClient()->retrieve($id);
    }

    /**
     * @param string $id
     * @return \AirTable\Models\Interfaces\RecordInterface
     */
    public function delete(string $id)
    {
        return $this->getClient()->delete($id);
    }

    /**
     * @return \AirTable\Models\Interfaces\RecordInterface[]|\AirTable\Models\Interfaces\TableInterface
     */
    public function get()
    {
        return $this->getClient()->list();
    }

    /**
     * @param array $data
     * @return \AirTable\Models\Interfaces\RecordInterface|mixed
     */
    public function firstOrCreate(array $data)
    {
        foreach ($data as $field => $value) {
            $this->where($field, "=", $value);
        }

        $records = $this->get();

        if($records->count()) {
            return array_first($records);
        } else {
            return $this->create($data);
        }
    }

    /**
     * @param array $data
     * @return \AirTable\Models\Interfaces\RecordInterface
     */
    public function updateOrCreate(array $data)
    {
        foreach ($data as $field => $value) {
            $this->where($field, "=", $value);
        }

        $records = $this->get();

        if ($records->count()) {
            $item = array_first($records);

            return $this->update($item->getId(), $data);
        } else {
            return $this->create($data);
        }
    }

    /**
     * @param array $columns
     * @return array
     */
    public function all(array $columns = [])
    {
        $all = [];
        $offset = false;

        if(!empty($columns)) {
            $this->client->fields($columns);
        }
        
        do {
            if ($offset) {
                $this->client->offset($offset);
            }

            $records = $this->client->list();

            if ($records->count()) {
                $all = array_merge($records->getRecords(), $all);
            }

            $offset = $records->getOffset();

        } while ($offset);

        return $all;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->getClient()->fields($fields);

        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param string $value
     * @return $this
     */
    public function where(string $column, string $operator, string $value)
    {
        $this->getClient()->filterByFormula($column, $operator, $value);

        return $this;
    }

    /**
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy(string $column, string $direction)
    {
        $this->getClient()->sort($column, $direction);

        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->getClient()->maxRecords($limit);

        return $this;
    }
}