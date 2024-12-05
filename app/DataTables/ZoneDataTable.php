<?php

namespace App\DataTables;

use App\Models\Spot;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ZoneDataTable extends DataTable
{
    protected $spotId;

    public function __construct($spotId = null)
    {
        $this->spotId = $spotId;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function(Zone $zone) {
                $zoneLink = "<a href='".route('public.zone', ['spot' => $zone->spot_id, 'zone' => $zone->id])."' class='dt-action-link'>".$zone->name."</a>";
                return $zoneLink;
            })
            ->filterColumn('climbing_routes_count', function($query, $keyword) {
                $query->whereRaw('(SELECT COUNT(*) FROM climbing_routes WHERE climbing_routes.zone_id = zones.id) LIKE ?', ["%{$keyword}%"]);
            })
            ->filterColumn('boulders_count', function($query, $keyword) {
                $query->whereRaw('(SELECT COUNT(*) FROM boulders WHERE boulders.zone_id = zones.id) LIKE ?', ["%{$keyword}%"]);
            })
            ->rawColumns(['name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Zone $model): QueryBuilder
    {
        return $model->newQuery()
        ->where('spot_id', $this->spotId)
        ->select(['zones.*', DB::raw('(SELECT COUNT(*) FROM climbing_routes WHERE climbing_routes.zone_id = zones.id) as climbing_routes_count'),
        DB::raw('(SELECT COUNT(*) FROM boulders WHERE boulders.zone_id = zones.id) as boulders_count')]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('zones-table')
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
        $columns = [
            Column::make('name')->addClass('text-center')->title('Zona')->addClass('text-center'),
        ];

        $spot = Spot::find($this->spotId);
        $climbingType = $spot->climbingType->name;

        if($climbingType === 'Deportiva') {
            $columns[] = Column::make('climbing_routes_count')->addClass('text-center')->title('Vías')->orderSequence(['asc', 'desc']);
        }
        if($climbingType === 'Boulder') {
            $columns[] = Column::make('boulders_count')->addClass('text-center')->title('Boulders')->orderSequence(['asc', 'desc']);
        }

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Zone_' . date('YmdHis');
    }
}
