<?php

namespace App\DataTables;

use App\Models\PhoneBook;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Http\Services\PhoneBookService;

class PhoneBookDataTable extends DataTable
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
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PhoneBook $model)
    {
        $phoneBookService = new PhoneBookService;
        return $phoneBookService->getAllPhoneBookEntries();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('phone-book-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        // Button::make('pdf')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('first_name')->title('First Name'),
            Column::make('last_name')->title('Last Name'),
            Column::make('phone_number')->title('Phone Number'),
            Column::make('mobile_number')->title('Mobile Number'),
            Column::make('company')->title('Company'),
            Column::make('position')->title('Position'),
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
        return 'PhoneBook_' . date('YmdHis');
    }
}
