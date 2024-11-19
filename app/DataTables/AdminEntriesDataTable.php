<?php

namespace App\DataTables;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminEntriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Entry $entry) {
                return '<div class="admin-entry-actions">
                            <a href="'. route('entries.edit', $entry->id) .'" class="edit-btn">
                                <p>
                                    <i class="bx bxs-edit bx-border"></i>
                                </p>
                            </a>
                            <a href="#" class="delete-btn" data-entry-id='. $entry->id .'>
                                <p>
                                    <i class="bx bx-trash bx-border"></i>
                                </p>
                            </a>
                        </div>';
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at->format('d-m-y');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Entry $model): QueryBuilder
    {
        return $model->newQuery()
        ->with(['entryCategory', 'user'])
        ->leftJoin('entry_categories', 'entries.category_id', '=', 'entry_categories.id')
        ->leftJoin('users', 'entries.user_id', '=', 'users.id')
        ->select('entries.*', 'entry_categories.category_name as category_name', 'users.username as author');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('entries-table')
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
            Column::make('title')->title('Título'),
            Column::make('author')->title('Autor')->orderSequence(['asc', 'desc'])->name('users.username'),
            Column::make('category_name')->title('Categoría')->orderSequence(['asc', 'desc'])->name('entry_categories.category_name'),
            Column::make('created_at')->title('Fecha'),
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
        return 'AdminEntries_' . date('YmdHis');
    }
}
