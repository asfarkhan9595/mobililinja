<?php

namespace App\DataTables;

use App\Http\Services\InvoiceService;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
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
            <button class="btn btn-outline-danger deleteBtn mb-2" data-toggle="modal" data-record-id="'.$row->id.'" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>';
        })
        ->addColumn('amount', function($row){
            return '$'.number_format($row->amount,2,'.',',');
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
    public function query(Invoice $model): QueryBuilder
    {
        $invoiceService = new InvoiceService();
        return $invoiceService->getAllInvoices()->with('customer');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('invoice-table')
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

            Column::make('id'),
            Column::make('number')->title('Invoice Number'),
            Column::make('customer')->title('Client'),
            Column::make('date')->title('Date'),
            Column::make('payment_mode'),
            Column::make('status'),
            Column::make('amount'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Invoice_' . date('YmdHis');
    }
}
