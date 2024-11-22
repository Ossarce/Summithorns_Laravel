<?php

namespace App\DataTables;

use App\Models\Spot;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class AdminSpotsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Spot $spot) {
                return '<div class="datatable-actions">
                            <a href="'. route('spots.edit', $spot->id) .'" class="edit-btn">
                                <p>
                                    <i class="bx bxs-edit bx-border"></i>
                                </p>
                            </a>
                            <a href="'. route('spots.destroy', $spot->id) .'" class="delete-item" data-id='. $spot->id .'>
                                <p>
                                    <i class="bx bx-trash bx-border"></i>
                                </p>
                            </a>
                        </div>
                        <div class="datatable-show-child">
                            <a href="'. route('zones.index', $spot->id) .'">Ver Zonas</a>
                        </div>';
            })
            ->filterColumn('climbing_type_name', function($query, $keyword) {
                $query->whereRaw('climbing_types.name LIKE ?', ["%{$keyword}%"]);
            })
            ->filterColumn('zones_count', function($query, $keyword) {
                $query->having('zones_count', 'LIKE', "%{$keyword}%");
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Spot $model): QueryBuilder
    {
        return $model->newQuery()
        ->with(['climbingType'])
        ->withCount('zones')
        ->leftJoin('climbing_types', 'spots.climbing_type_id', '=', 'climbing_types.id')
        ->select('spots.*', 'climbing_types.name as climbing_type_name', DB::raw('(SELECT COUNT(*) FROM zones WHERE zones.spot_id = spots.id) as zones_count'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('spots-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->language([
                        'processing' => 'Procesando...',
                        'search' => 'Buscar:',
                        'lengthMenu' => 'Mostrar _MENU_',
                        'info' => '',
                        'infoEmpty' => '',
                        'infoFiltered' => '(filtrado de un total de _MAX_ registros)',
                        'loadingRecords' => 'Cargando...',
                        'zeroRecords' => 'No se encontraron resultados',
                        'emptyTable' => 'Ningún dato disponible en esta tabla',
                        'paginate' => [
                            'first' => '<<',
                            'previous' => '<',
                            'next' => '>',
                            'last' => '>>'
                        ],
                        'aria' => [
                            'sortAscending' => ': Activar para ordenar la columna de manera ascendente',
                            'sortDescending' => ': Activar para ordenar la columna de manera descendente'
                        ]
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Nombre'),
            Column::make('climbing_type_name')->title('Tipo de Escalada')->orderSequence(['asc', 'desc']),
            Column::make('zones_count')->title('Zonas')->orderSequence(['asc', 'desc']),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->orderable(false)
            ->addClass('text-center')
            ->title(''),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AdminSpots_' . date('YmdHis');
    }
}
