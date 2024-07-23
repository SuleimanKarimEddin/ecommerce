<?php

namespace Modules\Base\Services;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseCrudService
{
    protected Model $model;

    protected array $relations = [];

    public array $filterable;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->filterable = [
            'custom' => function (Builder $query): void {},
        ];
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return (bool) $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {

        $isDeleted = $this->model->where('id', $id)->delete();
        if ((bool) $isDeleted) {
            return true;
        }
        throw new Exception('not_Found');
    }

    public function getAll(bool $is_pagination = true, int $perPage = 8, bool $returnQuery = false): LengthAwarePaginator|Collection|Builder
    {
        $query = $this->applyFilters()->with($this->relations);

        if ($returnQuery) {
            return $query;
        }

        return $is_pagination ? $query->paginate($perPage) : $query->get();
    }

    public function findByID($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function findByIDWithRelation(int $id): ?Model
    {
        return $this->model->with($this->relations)->find($id);
    }

    protected function applyFilters(): Builder
    {
        $query = $this->model->newQuery();

        if (array_key_exists('custom', $this->filterable)) {
            $this->applyCustom($query);
        }

        return $query;
    }

    protected function applyCustom(Builder $query): void
    {
        if (is_callable($this->filterable['custom'])) {
            $this->filterable['custom']($query);
        }
    }
}
