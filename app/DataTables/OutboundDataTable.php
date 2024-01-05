<?php

namespace App\DataTables;

use App\Models\Outbound;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Http\Services\OutboundService;

class OutboundDataTable extends DataTable
{ /**
    * Build the DataTable class.
    *
    * @param QueryBuilder $query Results from query() method.
    */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row) {
                return '<button class="btn btn-outline-info mb-2 editBtn" data-toggle="modal" data-target="#myLargeModalText" data-record-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline-danger mb-2 deleteBtn" data-toggle="modal"  data-record-id="' . $row->id . '" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>';
            })
            ->addColumn('trunk', function($row){
                return $row->trunk ? $row->trunk->tname : null;
            })
            
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Outbound $model)
    {
        $outboundService = new OutboundService;
        return $outboundService->getAllOutbounds()->with('trunk');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('outbound-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('prepend'),
            Column::make('prefix'),
            Column::make('match_pattern'),
            Column::computed('trunk'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Outbound_' . date('YmdHis');
    }
}
