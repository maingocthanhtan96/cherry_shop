<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Carbon\Carbon;

class QueryService extends BaseService
{
    /**
     * Eloquent model
     * @var $_model
     */
    protected $_model;

    /**
     * Order column
     * @var array
     */
    public $order = [];
    /**
     * Order relationship ship
     * @var array
     */
    public $orderRelationship = [];
    /**
     * Column to search using whereLike
     * @var array
     */
    public $columnSearch = [];
    /**
     * Relationship with other tables
     * @var array
     */
    public $withRelationship = [];
    /**
     * Paragraph search in column
     * @var string
     */
    public $search = '';
    /**
     * Start date - End date
     * @var array
     */
    public $betweenDate = [];
    /**
     * Limit record
     * @var int
     */
    public $limit = 25;
    /**
     * ascending = 0, descending = 1
     * @var int
     */
    public $ascending = 0;
    /**
     * Column to order
     * @var string
     */
    public $orderBy = 'created_at';
    /**
     * Always order this column
     * @var string
     */
    public $defaultOrderBy = 'created_at';
    /**
     * Always order
     * @var string
     */
    public $defaultDescending = 'desc';

    /**
     * QueryService constructor.
     * @param $model
     * @author tanmnt
     */
    public function __construct($model)
    {
        $this->_model = $model;
    }

    /**
     * Query table
     * @return mixed
     * @author tanmnt
     */
    public function queryTable()
    {
        $this->ascending = +$this->ascending === 0 ? 'asc' : 'desc';

        $query = $this->_model::query();
        if (count(Arr::wrap($this->withRelationship)) > 0) {
            $query = $query->with(Arr::wrap($this->withRelationship));
        }

        foreach (Arr::wrap($this->order) as $col) {
            $query->when($col === $this->orderBy, function ($q) use ($col) {
                $q->orderBy($col, $this->ascending);
            });
        }

        foreach (Arr::wrap($this->orderRelationship) as $value => $col) {
            $query->when($value === $this->orderBy, function ($q) use ($col) {
                $q->orderBy($col, $this->ascending);
            });
        }

        $query->when($this->search, function ($q) {
            $q->whereLike($this->columnSearch, $this->search);
        });

        $query->when(isset($this->betweenDate[0]) && isset($this->betweenDate[1]), function ($q) {
            $startDate = Carbon::parse($this->betweenDate[0])->startOfDay();
            $endDate = Carbon::parse($this->betweenDate[1])->endOfDay();
            $q->whereBetween('updated_at', [$startDate, $endDate]);
        });

        $query->when($this->defaultOrderBy && $this->defaultDescending, function ($q) {
            $q->orderBy($this->defaultOrderBy, $this->defaultDescending);
        });

        return $query;
    }
}
