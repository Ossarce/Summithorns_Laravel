<?php

namespace App\DataTables;

use App\Models\ClimbingRoute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClimbingRoutesDataTable extends DataTable
{
    protected $zoneId;

    public function __construct($zoneId = null)
    {
        $this->zoneId = $zoneId;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('setter_id', function(ClimbingRoute $climbingRoute) {
                return $climbingRoute->getSetterName();
            })
            ->addColumn('action', 'climbingroutes.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ClimbingRoute $model): QueryBuilder
    {
        return $model->newQuery()
        ->where('zone_id', $this->zoneId)
        ->with(['grade', 'setter'])
        ->leftJoin('route_grades', 'climbing_routes.grade_id', '=', 'route_grades.id')
        ->select('climbing_routes.*', 'route_grades.route_grade as grade_name');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('climbing_routes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('grade_name')->title('Grado')->orderSequence(['asc', 'desc'])->name('route_grades.route_grade'),
            Column::make('setter_id')->title('Abridor'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ClimbingRoutes_' . date('YmdHis');
    }
}
