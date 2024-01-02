<?php
namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Http\Services\CustomerService;
use App\Models\Trunk;

class TrunkDataTable extends DataTable
{
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

    

    public function query(Trunk $model)
    {
        // Replace with your logic to get trunks
        return $model->select(['id', 'tname', 'description', 'secret', 'authentication', 'registration', 'sip_server', 'sip_secret_port', 'context', 'transport']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('trunk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
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
            Column::make('tname'),
            Column::make('description'),
            Column::make('secret'),
            Column::make('authentication'),
            Column::make('registration'),
            Column::make('sip_server')->title('SIP Server'),
            Column::make('sip_secret_port')->title('SIP Secret Port'),
            Column::make('context'),
            Column::make('transport'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Trunk_' . date('YmdHis');
    }
}
