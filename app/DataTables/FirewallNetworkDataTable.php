<?php

namespace App\DataTables;

use App\Http\Services\FirewallService;
use App\Models\FirewallNetwork;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FirewallNetworkDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row){
            return '<button class="btn btn-outline-info mb-2 editBtn" data-toggle="modal" data-target="#myLargeModalText" data-record-id="'.$row->id.'"><i class="fa fa-edit"></i></button>
            <button class="btn btn-outline-danger mb-2 deleteBtn" data-toggle="modal"  data-record-id="'.$row->id.'" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>';
        })
        ->addColumn('customer', function($row){
            return $row->customer->name;
        })
        ->setRowId('id')
        ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FirewallNetwork $model): QueryBuilder
    {
        $firewallService = new FirewallService;
        return $firewallService->getAllNetworks()->with('customer');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('firewallnetwork-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('network_host')->title('Network Host'),
            Column::make('assigned_zone')->title('Assigned Zone'),
            Column::make('customer')->title('Company'),
            Column::make('description')->title('Description'),
            Column::make('accepted_date')->title('Date'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FirewallNetwork_' . date('YmdHis');
    }
}
